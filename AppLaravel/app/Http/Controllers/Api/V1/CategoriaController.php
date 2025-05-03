<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Categorias baseadas nas tags principais existentes
        $categorias = [
            [
                'id' => 'escalando',
                'nome' => 'Escalando',
                'contador' => Anuncio::where('tag_principal', 'ESCALANDO')->count(),
                'gradientClass' => 'bg-gradient-to-r from-amber-500 to-orange-500',
                'shadowClass' => 'shadow-amber-500/30',
            ],
            [
                'id' => 'low-ticket',
                'nome' => 'Low ticket',
                'contador' => Anuncio::where('tag_principal', 'TESTE')->count(),
                'gradientClass' => 'bg-gradient-to-r from-emerald-500 to-teal-500',
                'shadowClass' => 'shadow-emerald-500/30',
            ],
            [
                'id' => 'destaque',
                'nome' => 'Em destaque',
                'contador' => Anuncio::where('destaque', true)->count(),
                'gradientClass' => 'bg-gradient-to-r from-violet-500 to-purple-500',
                'shadowClass' => 'shadow-violet-500/30',
            ],
        ];

        return response()->json(['data' => $categorias]);
    }
}
