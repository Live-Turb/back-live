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
        // Verificar a estrutura das colunas
        $columns = DB::select("SHOW FULL COLUMNS FROM anuncios WHERE Field IN ('variacao_diaria', 'variacao_semanal')");

        echo "\nEstrutura das colunas:\n";
        echo "--------------------\n";
        foreach ($columns as $column) {
            echo "Coluna: {$column->Field}\n";
            echo "Tipo: {$column->Type}\n";
            echo "Nulo: {$column->Null}\n";
            echo "Padrão: {$column->Default}\n";
            echo "Comentário: {$column->Comment}\n";
            echo "--------------------\n";
        }

        // Verificar alguns valores da tabela
        $valores = DB::select("SELECT id, variacao_diaria, variacao_semanal FROM anuncios ORDER BY id DESC LIMIT 5");

        echo "\nÚltimos 5 registros:\n";
        echo "--------------------\n";
        foreach ($valores as $valor) {
            echo "ID: {$valor->id}\n";
            echo "Variação Diária: " . var_export($valor->variacao_diaria, true) . "\n";
            echo "Variação Semanal: " . var_export($valor->variacao_semanal, true) . "\n";
            echo "--------------------\n";
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
