<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AnuncioController;
use App\Http\Controllers\Api\CriativoController;
use App\Http\Controllers\Api\V1\AnuncioController as AnuncioV1Controller;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\NichoController;
use App\Models\Anuncio;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rotas para gerenciamento de comentários
    Route::get('/comments/{videoUuid}', [CommentController::class, 'index']);
    Route::post('/comments/save', [CommentController::class, 'store']);

    // Rotas para Anúncios
    Route::apiResource('anuncios', AnuncioController::class);

    // Rotas para Criativos
    Route::apiResource('criativos', CriativoController::class);

    // Rota para obter criativos de um anúncio específico
    Route::get('anuncios/{anuncio_id}/criativos', [CriativoController::class, 'index']);
});

// Rotas públicas para a API V1
Route::prefix('v1')->group(function () {
    // Rotas de anúncios
    Route::get('/anuncios', [AnuncioV1Controller::class, 'index']);
    Route::get('/anuncios/{id}', [AnuncioV1Controller::class, 'show']);

    // Rotas de categorias
    Route::get('/categorias', [CategoriaController::class, 'index']);

    // Rotas de nichos
    Route::get('/nichos', [NichoController::class, 'index']);

    // Rota de teste para verificar o problema com numero_anuncios
    Route::get('/teste-numero-anuncios', function() {
        $anuncios = Anuncio::all()->take(5);

        $resultado = [];
        foreach ($anuncios as $anuncio) {
            $resultado[] = [
                'id' => $anuncio->id,
                'titulo' => $anuncio->titulo,
                'numero_anuncios_original' => $anuncio->getOriginal('numero_anuncios'),
                'numero_anuncios_atributo' => $anuncio->numero_anuncios,
                'numero_anuncios_array' => $anuncio->toArray()['numero_anuncios'] ?? null,
                'tipo_original' => gettype($anuncio->getOriginal('numero_anuncios')),
                'tipo_atributo' => gettype($anuncio->numero_anuncios),
                'tipo_array' => isset($anuncio->toArray()['numero_anuncios']) ? gettype($anuncio->toArray()['numero_anuncios']) : 'não existe'
            ];
        }

        return response()->json([
            'anuncios' => $resultado,
            'raw_sql' => "SELECT id, titulo, numero_anuncios FROM anuncios LIMIT 5",
            'raw_result' => \Illuminate\Support\Facades\DB::select("SELECT id, titulo, numero_anuncios FROM anuncios LIMIT 5")
        ]);
    });

    // Rota para atualizar diretamente o valor de numero_anuncios
    Route::get('/atualizar-numero-anuncios/{id}/{valor}', function($id, $valor) {
        try {
            $anuncio = Anuncio::findOrFail($id);

            // Valor original
            $valorOriginal = $anuncio->numero_anuncios;

            // Atualizar campo com o novo valor
            $anuncio->numero_anuncios = (int)$valor;
            $anuncio->save();

            // Verificar após a atualização
            $anuncioAtualizado = Anuncio::findOrFail($id);

            return response()->json([
                'status' => 'sucesso',
                'mensagem' => "Valor de numero_anuncios atualizado para o anúncio {$id}",
                'valor_original' => $valorOriginal,
                'novo_valor' => $valor,
                'valor_apos_atualizacao' => $anuncioAtualizado->numero_anuncios,
                'tipo_apos_atualizacao' => gettype($anuncioAtualizado->numero_anuncios)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    });
});
