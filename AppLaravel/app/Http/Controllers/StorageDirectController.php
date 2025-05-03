<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class StorageDirectController extends Controller
{
    /**
     * Servir arquivos diretamente da pasta storage
     *
     * @param Request $request
     * @param string $path
     * @return \Illuminate\Http\Response
     */
    public function serve(Request $request, $path)
    {
        // Bloquear acesso a diretórios superiores
        if (strpos($path, '..') !== false) {
            abort(403, 'Acesso negado');
        }

        // Caminho completo do arquivo no sistema de arquivos
        $filePath = storage_path($path);

        // Verificar se o arquivo existe
        if (!file_exists($filePath)) {
            Log::warning("Arquivo não encontrado: {$filePath}");
            abort(404, 'Arquivo não encontrado');
        }

        // Obter o tipo MIME do arquivo
        $mimeType = mime_content_type($filePath);

        // Log para depuração
        Log::debug('Servindo arquivo', [
            'path' => $path,
            'filePath' => $filePath,
            'mimeType' => $mimeType
        ]);

        // Servir o arquivo com o tipo MIME correto
        return Response::make(file_get_contents($filePath), 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            'Cache-Control' => 'public, max-age=86400', // Cache por 1 dia
        ]);
    }
}
