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
        // Usamos SQL bruto para alterar o tipo enum, evitando problemas com o Schema Builder
        if (Schema::hasTable('criativos') && Schema::hasColumn('criativos', 'status')) {
            DB::statement("ALTER TABLE criativos MODIFY COLUMN status ENUM('escalando', 'teste', 'pausado')");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não fazemos alteração no down para preservar a integridade dos dados
        // A alteração para string poderia causar perda de dados
    }
};
