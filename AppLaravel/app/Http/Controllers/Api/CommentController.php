<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VideoDetail;
use App\Models\VideoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function index(Request $request, $videoUuid)
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        // Usar cache com tags para melhor controle
        $cacheKey = "video_comments:{$videoUuid}:page:{$page}:size:{$perPage}";
        
        return Cache::tags(['video_comments'])->remember($cacheKey, now()->addMinutes(5), function () use ($videoUuid, $perPage, $page) {
            $video = VideoDetail::where('uuid', $videoUuid)->firstOrFail();
            
            $comments = VideoComment::where('video_id', $video->id)
                ->orderBy('created_at')
                ->paginate($perPage);

            // Transformar os dados para reduzir payload
            $comments->through(function ($comment) {
                return [
                    'id' => $comment->id,
                    'text' => $comment->comment,
                    'time' => $comment->time
                ];
            });

            return response()->json([
                'data' => $comments->items(),
                'next_page_url' => $comments->nextPageUrl(),
                'total' => $comments->total()
            ]);
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required|array',
            'comments.*.id' => 'required|integer',
            'comments.*.text' => 'required|string',
            'comments.*.time' => 'required|string'
        ]);

        // Processar em lotes para melhor performance
        $comments = collect($request->input('comments'));
        
        // Usar transaction para garantir consistência
        \DB::transaction(function () use ($comments) {
            // Agrupar em lotes de 100 para processamento mais eficiente
            $comments->chunk(100)->each(function ($chunk) {
                $updates = [];
                foreach ($chunk as $comment) {
                    $updates[] = [
                        'id' => $comment['id'],
                        'comment' => $comment['text'],
                        'time' => $comment['time'],
                        'updated_at' => now()
                    ];
                }
                
                // Atualizar em lote
                VideoComment::upsert(
                    $updates,
                    ['id'],
                    ['comment', 'time', 'updated_at']
                );
            });
        });

        // Limpar o cache após atualização
        Cache::tags(['video_comments'])->flush();

        return response()->json([
            'message' => 'Comments updated successfully',
            'status' => 'success'
        ]);
    }
}
