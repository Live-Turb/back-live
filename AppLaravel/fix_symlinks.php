<?php

/**
 * Script para corrigir os links simbólicos do storage
 * Este script remove os links simbólicos existentes e cria novos links
 * para todas as pastas dentro do diretório storage/app/public
 */

// Caminhos
$storagePublicPath = __DIR__ . '/storage/app/public';
$publicStoragePath = __DIR__ . '/public/storage';
$rootStoragePath = dirname(__DIR__) . '/storage';

echo "Iniciando correção dos links simbólicos...\n";

// 1. Remover o link simbólico existente em public/storage
if (file_exists($publicStoragePath)) {
    echo "Removendo link simbólico existente em public/storage...\n";
    
    if (is_dir($publicStoragePath)) {
        // No Windows, precisamos usar comandos específicos para remover links simbólicos
        if (PHP_OS_FAMILY === 'Windows') {
            exec('rmdir "' . $publicStoragePath . '"');
        } else {
            // No Linux/Unix podemos usar unlink
            unlink($publicStoragePath);
        }
    }
}

// 2. Remover o link simbólico existente na raiz do projeto
if (file_exists($rootStoragePath)) {
    echo "Removendo link simbólico existente na raiz do projeto...\n";
    
    if (is_dir($rootStoragePath)) {
        // No Windows, precisamos usar comandos específicos para remover links simbólicos
        if (PHP_OS_FAMILY === 'Windows') {
            exec('rmdir "' . $rootStoragePath . '"');
        } else {
            // No Linux/Unix podemos usar unlink
            unlink($rootStoragePath);
        }
    }
}

// 3. Criar o link simbólico em public/storage
echo "Criando link simbólico em public/storage...\n";
if (PHP_OS_FAMILY === 'Windows') {
    exec('mklink /D "' . $publicStoragePath . '" "' . $storagePublicPath . '"');
} else {
    symlink($storagePublicPath, $publicStoragePath);
}

// 4. Criar o link simbólico na raiz do projeto
echo "Criando link simbólico na raiz do projeto...\n";
if (PHP_OS_FAMILY === 'Windows') {
    exec('mklink /D "' . $rootStoragePath . '" "' . $storagePublicPath . '"');
} else {
    symlink($storagePublicPath, $rootStoragePath);
}

echo "Links simbólicos criados com sucesso!\n";

// 5. Verificar se os links foram criados corretamente
echo "\nVerificando links simbólicos criados:\n";
echo "- public/storage: " . (file_exists($publicStoragePath) ? "OK" : "FALHA") . "\n";
echo "- /storage: " . (file_exists($rootStoragePath) ? "OK" : "FALHA") . "\n";

echo "\nProcesso concluído!\n";
