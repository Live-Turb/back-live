<?php

namespace App\Http\Controllers;

use App\Models\CommentFrequency;
use App\Models\VideoDetail;
use App\Services\ViewTrackingService;
use Illuminate\Http\Request;

class GenerateVideoController extends Controller
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function generate(Request $request, $uuid)
    {
        $video = VideoDetail::with('videoThumbnail', 'videoComment')->where('uuid', $uuid)->first();
        if (!$video) {
            abort(404);
        }

        try {
            // Tenta registrar a visualização usando o serviço
            $this->viewTrackingService->recordView($video->id, $video->user_id, $request);
            
            // Se chegou aqui, não houve bloqueio
            $commentfrequeny = CommentFrequency::where('video_details_id', $video->id)->first();
            
            // Define template_type como 'youtube' se não estiver definido
            if (empty($video->template_type)) {
                $video->template_type = 'youtube';
                $video->save();
            }
            
            // Escolhe qual view renderizar baseado no template_type
            $viewData = [
                'video' => $video,
                'commentfrequeny' => $commentfrequeny,
                'template_type' => $video->template_type
            ];
            
            // Se for template do Instagram, usa a view especial
            if ($video->template_type == 'instagram') {
                return view('instagram-generate-video', $viewData);
            }
            
            // Caso contrário, usa a view padrão do YouTube
            return view('generate-video', $viewData);

        } catch (\App\Exceptions\BillingException $e) {
            // Obtém os dados atualizados de billing
            $billingControl = \App\Models\UserBillingControl::where('user_id', $video->user_id)->first();
            
            // Obtém as estatísticas de visualização
            $stats = $this->viewTrackingService->getUserViewStatistics($video->user_id);
            
            // Retorna a view de bloqueio com os dados atualizados
            return response()->view('billing.blocked', [
                'pending_amount' => $billingControl->pending_amount,
                'block_reason' => $billingControl->block_reason,
                'current_views' => $stats['current'],
                'base_limit' => $stats['base_limit'],
                'extra_views' => $stats['extra_views'],
                'plan_name' => $stats['plan_name']
            ], 403);
        }
    }
}
