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

        // Garante que a coluna não aceita null e tem valor padrão
        Schema::table('video_details', function (Blueprint $table) {
            $table->enum('template_type', ['youtube', 'instagram'])->nullable(false)->default('youtube')->change();
        });
    }

    public function down()
    {
        Schema::table('video_details', function (Blueprint $table) {
            $table->enum('template_type', ['youtube', 'instagram'])->nullable()->default(null)->change();
        });
    }
};
