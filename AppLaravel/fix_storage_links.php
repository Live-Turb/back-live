<?php

// Script para verificar e corrigir links simbólicos de storage

// Caminho para o diretório público
$publicPath = __DIR__ . '/public';

// Caminho para o diretório de storage
$storagePath = __DIR__ . '/storage/app/public';

// Caminho para o link simbólico
$linkPath = $publicPath . '/storage';

echo "Verificando links simbólicos...\n";

// Verificar se o diretório de storage existe
if (!file_exists($storagePath)) {
    echo "Erro: O diretório de storage não existe: {$storagePath}\n";
    exit(1);
}

// Verificar se o diretório público existe
if (!file_exists($publicPath)) {
    echo "Erro: O diretório público não existe: {$publicPath}\n";
    exit(1);
}

// Verificar se o link simbólico já existe
if (file_exists($linkPath)) {
    echo "O link simbólico já existe: {$linkPath}\n";
    
    // Verificar se é um link simbólico válido
    if (is_link($linkPath)) {
        $target = readlink($linkPath);
        echo "O link aponta para: {$target}\n";
        
        // Verificar se o link aponta para o diretório correto
        if ($target === $storagePath) {
            echo "O link simbólico está configurado corretamente.\n";
        } else {
            echo "O link simbólico aponta para um diretório incorreto.\n";
            echo "Removendo link existente...\n";
            
            // Remover o link existente
            if (unlink($linkPath)) {
                echo "Link removido com sucesso.\n";
            } else {
                echo "Erro ao remover o link existente. Verifique as permissões.\n";
                exit(1);
            }
        }
    } else {
        echo "O caminho existe mas não é um link simbólico. Removendo...\n";
        
        // Se for um diretório, tentar remover
        if (is_dir($linkPath)) {
            // Remover o diretório recursivamente
            function removeDir($dir) {
                $files = array_diff(scandir($dir), array('.', '..'));
                foreach ($files as $file) {
                    $path = $dir . '/' . $file;
                    is_dir($path) ? removeDir($path) : unlink($path);
                }
                return rmdir($dir);
            }
            
            if (removeDir($linkPath)) {
                echo "Diretório removido com sucesso.\n";
            } else {
                echo "Erro ao remover o diretório. Verifique as permissões.\n";
                exit(1);
            }
        } else {
            // Se for um arquivo, tentar remover
            if (unlink($linkPath)) {
                echo "Arquivo removido com sucesso.\n";
            } else {
                echo "Erro ao remover o arquivo. Verifique as permissões.\n";
                exit(1);
            }
        }
    }
}

// Criar o link simbólico
echo "Criando link simbólico...\n";
if (symlink($storagePath, $linkPath)) {
    echo "Link simbólico criado com sucesso: {$linkPath} -> {$storagePath}\n";
} else {
    echo "Erro ao criar o link simbólico. Verifique as permissões.\n";
    exit(1);
}

// Verificar se o diretório de bandeiras existe
$flagsDir = $storagePath . '/bandeiras_mundo';
if (!file_exists($flagsDir)) {
    echo "Aviso: O diretório de bandeiras não existe: {$flagsDir}\n";
    echo "Criando diretório de bandeiras...\n";
    
    if (mkdir($flagsDir, 0755, true)) {
        echo "Diretório de bandeiras criado com sucesso.\n";
    } else {
        echo "Erro ao criar o diretório de bandeiras. Verifique as permissões.\n";
    }
}

echo "Verificação e correção de links simbólicos concluída.\n";
