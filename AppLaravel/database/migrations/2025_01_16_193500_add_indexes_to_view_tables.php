<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddIndexesToViewTables extends Migration
{
    public function up()
    {
        // Verifica se os índices existem antes de criar
        $this->createIndexIfNotExists('view_statistics', 'user_id,created_at');
        $this->createIndexIfNotExists('view_statistics', 'template_id,viewer_ip,created_at');
        $this->createIndexIfNotExists('template_views', 'user_id,created_at');
        $this->createIndexIfNotExists('view_billing_records', 'user_id,status');
    }

    public function down()
    {
        // Remove os índices se existirem
        $this->dropIndexIfExists('view_statistics', 'user_id,created_at');
        $this->dropIndexIfExists('view_statistics', 'template_id,viewer_ip,created_at');
        $this->dropIndexIfExists('template_views', 'user_id,created_at');
        $this->dropIndexIfExists('view_billing_records', 'user_id,status');
    }

    protected function createIndexIfNotExists($table, $columns)
    {
        $indexName = $table . '_' . str_replace(',', '_', $columns) . '_index';
        
        // Verifica se o índice existe
        $indexExists = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        
        if (empty($indexExists)) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                $columns = explode(',', $columns);
                $table->index($columns);
            });
        }
    }

    protected function dropIndexIfExists($table, $columns)
    {
        $indexName = $table . '_' . str_replace(',', '_', $columns) . '_index';
        
        // Verifica se o índice existe
        $indexExists = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        
        if (!empty($indexExists)) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                $columns = explode(',', $columns);
                $table->dropIndex($columns);
            });
        }
    }
}
