<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ViewTrackingService;
use App\Models\VideoDetail;

class TrackTemplateViews
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Verifica se é uma visualização válida de vídeo
        $uuid = $request->route('uuid');
        if ($uuid) {
            $video = VideoDetail::where('uuid', $uuid)->first();
            
            if ($video) {
                // Registra a visualização usando o ID do proprietário do vídeo
                $this->viewTrackingService->recordView($video->id, $video->user_id, $request);
            }
        }

        return $response;
    }
}
