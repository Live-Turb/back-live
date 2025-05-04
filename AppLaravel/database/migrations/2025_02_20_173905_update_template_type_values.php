<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Atualiza registros que não têm template_type definido
        DB::table('video_details')->whereNull('template_type')->update([
            'template_type' => 'youtube'
        ]);

        // Garante que a coluna não aceita null e tem valor padrão usando SQL bruto
        DB::statement("ALTER TABLE `video_details` MODIFY `template_type` ENUM('youtube', 'instagram') NOT NULL DEFAULT 'youtube'");
    }

    public function down()
    {
        // Reverte para permitir valores null usando SQL bruto
        DB::statement("ALTER TABLE `video_details` MODIFY `template_type` ENUM('youtube', 'instagram') NULL DEFAULT NULL");
    }
};
