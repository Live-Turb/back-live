<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar a estrutura atual da tabela
        $columns = DB::select("SHOW FULL COLUMNS FROM anuncios");

        foreach ($columns as $column) {
            if (in_array($column->Field, ['variacao_diaria', 'variacao_semanal'])) {
                echo "Coluna: {$column->Field}\n";
                echo "Tipo: {$column->Type}\n";
                echo "Nulo: {$column->Null}\n";
                echo "Padrão: {$column->Default}\n";
                echo "Comentário: {$column->Comment}\n";
                echo "-------------------\n";
            }
        }

        // Verificar alguns valores da tabela
        $valores = DB::select("SELECT variacao_diaria, variacao_semanal FROM anuncios LIMIT 5");
        echo "\nPrimeiros 5 valores:\n";
        foreach ($valores as $valor) {
            echo "Variação Diária: {$valor->variacao_diaria}, Variação Semanal: {$valor->variacao_semanal}\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessário fazer nada aqui
    }
};
