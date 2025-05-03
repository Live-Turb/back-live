<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NichoController extends Controller
{
    public function index()
    {
        // Obter nichos únicos do banco de dados
        $nichos = Anuncio::select('nicho')
            ->distinct()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => strtolower(str_replace(' ', '-', $item->nicho)),
                    'nome' => $item->nicho
                ];
            });

        return response()->json(['data' => $nichos]);
    }
}
