<?php

namespace App\Http\Controllers;

use App\Models\BroadCastComment;
use App\Models\CommentFrequency;
use App\Models\VideoDetail;
use App\Models\Subscription;
use App\Models\PayPalPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    // Definindo os limites de comentários por vídeo para cada plano
    const BASIC_PLAN_COMMENTS_LIMIT = 180;
    const STANDARD_PLAN_COMMENTS_LIMIT = 240;
    const PREMIUM_PLAN_COMMENTS_LIMIT = 370;

    public function store(Request $request, $uuid)
    {
        $videoDetails = VideoDetail::where('uuid', $uuid)->first();
        if (!$videoDetails) {
            return response()->json([
                'message' => "Video not found"
            ], 404);
        }

        $request->validate([
            'minSec' => 'required',
            'maxSec' => 'required',
            'commentarr' => 'required',
            'totalMinutes' => 'required'
        ]);

        // Define platform baseado no template_type do vídeo
        $platform = $videoDetails->template_type;
        if (!in_array($platform, ['youtube', 'instagram'])) {
            return response()->json([
                'message' => "Invalid template type"
            ], 400);
        }

        // Garantir que o totalMinutes seja um valor numérico
        $totalMinutes = intval($request->totalMinutes);
        if ($totalMinutes <= 0) {
            $totalMinutes = 60; // Valor padrão se inválido
        }

        // Verificar o limite de comentários baseado no plano do usuário
        $commentLimit = $this->getUserCommentLimit($videoDetails->user_id);
        $commentsCount = count($request->commentarr);

        // Verificar se o número de comentários excede o limite do plano
        if ($commentsCount > $commentLimit) {
            return response()->json([
                'message' => "O limite de comentários para o seu plano é de {$commentLimit} comentários por vídeo.",
                'limit' => $commentLimit,
                'submitted' => $commentsCount
            ], 422);
        }

        $commmentFrequest = CommentFrequency::updateOrCreate([
            'video_details_id' => $videoDetails->id
        ], [
            'min_Sec' => $request->minSec,
            'max_Sec' => $request->maxSec,
            'vsl_time_in_minutes' => $totalMinutes
        ]);

        $broadCastComment = BroadCastComment::where('video_details_id', $videoDetails->id)->delete();

        foreach ($request->commentarr as $key => $comment) {
            $newComment = BroadCastComment::create([
                'video_details_id' => $videoDetails->id,
                'comment' => $comment,
                'platform' => $platform
            ]);
        }

        return response()->json(['message' => 'Comment created successfully']);
    }

    public function comments($uuid)
    {
        $videoDetails = VideoDetail::where('uuid', $uuid)->first();
        if (!$videoDetails) {
            return response()->json([
                'message' => "Video not found"
            ], 404);
        }

        $broadCastComment = BroadCastComment::where('video_details_id', $videoDetails->id)->get();
        return response()->json(['comments' => $broadCastComment]);
    }

    /**
     * Obtém o limite de comentários por vídeo baseado no plano do usuário
     * 
     * @param int $userId ID do usuário
     * @return int Limite de comentários por vídeo
     */
    protected function getUserCommentLimit($userId)
    {
        try {
            // Obter a assinatura ativa mais recente do usuário
            $subscription = Subscription::where('user_id', $userId)
                ->where('status', 'ACTIVE')
                ->with('paypalPlan')
                ->orderBy('created_at', 'desc')
                ->first();
            
            // Se o usuário tem uma assinatura ativa com plano
            if ($subscription && $subscription->paypalPlan) {
                $planName = strtolower($subscription->paypalPlan->name);
                
                // Retornar o limite baseado no nome do plano
                return match($planName) {
                    'basic' => self::BASIC_PLAN_COMMENTS_LIMIT,
                    'standard' => self::STANDARD_PLAN_COMMENTS_LIMIT,
                    'premium' => self::PREMIUM_PLAN_COMMENTS_LIMIT,
                    default => self::BASIC_PLAN_COMMENTS_LIMIT
                };
            }
            
            // Se não encontrou assinatura ou plano válido, retorna o limite do plano básico
            return self::BASIC_PLAN_COMMENTS_LIMIT;
            
        } catch (\Exception $e) {
            // Registrar o erro e retornar o limite básico como fallback
            Log::error('Erro ao obter limite de comentários do usuário:', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            
            return self::BASIC_PLAN_COMMENTS_LIMIT;
        }
    }
}
