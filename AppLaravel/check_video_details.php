<?php

require __DIR__ . '/vendor/autoload.php';

// Inicializar a aplicação Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Verificar se a tabela existe
if (!Schema::hasTable('video_details')) {
    echo "A tabela video_details não existe!\n";
    exit(1);
}

// Listar as colunas da tabela
$columns = Schema::getColumnListing('video_details');
echo "Colunas da tabela video_details:\n";
echo implode(", ", $columns) . "\n\n";

// Verificar se a coluna 'title' existe
if (in_array('title', $columns)) {
    echo "A coluna 'title' EXISTE na tabela video_details.\n";
} else {
    echo "A coluna 'title' NÃO EXISTE na tabela video_details!\n";

    // Verificar se existe uma coluna similar
    $potentialTitleColumns = array_filter($columns, function($column) {
        return stripos($column, 'title') !== false ||
               stripos($column, 'name') !== false ||
               stripos($column, 'nome') !== false;
    });

    if (!empty($potentialTitleColumns)) {
        echo "Possíveis colunas que podem conter o título:\n";
        echo implode(", ", $potentialTitleColumns) . "\n";
    }
}

// Mostrar alguns registros
$records = DB::table('video_details')->take(3)->get();
echo "\nExemplo de registros:\n";
foreach ($records as $record) {
    echo "ID: " . $record->id . ", UUID: " . $record->uuid . "\n";
    echo "Colunas e valores:\n";

    foreach ((array)$record as $key => $value) {
        if (is_null($value)) {
            $value = 'NULL';
        } elseif (is_string($value) && strlen($value) > 100) {
            $value = substr($value, 0, 97) . '...';
        }

        echo "  - {$key}: {$value}\n";
    }
    echo "\n";
}
