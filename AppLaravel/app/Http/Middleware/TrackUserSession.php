<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrackUserSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver autenticado, não precisa rastrear sessão
        if (!auth()->check()) {
            return $next($request);
        }

        try {
            $userId = auth()->id();
            $now = now();

            // Verifica se já existe uma sessão ativa para o usuário
            $session = DB::table('user_sessions')
                ->where('user_id', $userId)
                ->whereRaw('last_activity_at >= DATE_SUB(NOW(), INTERVAL 30 MINUTE)')
                ->first();

            if ($session) {
                // Atualiza a última atividade
                DB::table('user_sessions')
                    ->where('id', $session->id)
                    ->update([
                        'last_activity_at' => $now,
                        'updated_at' => $now
                    ]);

                // Log para debug
                Log::info("Sessão atualizada para o usuário {$userId}", [
                    'session_id' => $session->id,
                    'last_activity' => $now
                ]);
            } else {
                // Cria uma nova sessão
                $sessionId = DB::table('user_sessions')->insertGetId([
                    'user_id' => $userId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'created_at' => $now,
                    'last_activity_at' => $now,
                    'updated_at' => $now
                ]);

                // Log para debug
                Log::info("Nova sessão criada para o usuário {$userId}", [
                    'session_id' => $sessionId
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Erro ao rastrear sessão do usuário: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        return $next($request);
    }
}
