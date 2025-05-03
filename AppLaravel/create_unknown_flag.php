<?php

// Criar um arquivo vazio para o país desconhecido
$flagsDir = __DIR__ . '/../storage/app/public/bandeiras_mundo/';
$xxPath = $flagsDir . 'xx.png';

// Cópia de uma bandeira existente (usaremos a do Brasil como base)
if (file_exists($flagsDir . 'br.png')) {
    copy($flagsDir . 'br.png', $xxPath);
    echo "Arquivo para país desconhecido criado com sucesso!\n";
} else {
    // Caso não exista nenhuma bandeira, criar um arquivo vazio
    file_put_contents($xxPath, '');
    echo "Arquivo vazio para país desconhecido criado.\n";
}
