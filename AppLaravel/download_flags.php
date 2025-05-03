<?php

// Lista de países para baixar as bandeiras
$countries = [
    'br' => 'Brasil',
    'us' => 'Estados Unidos',
    'pt' => 'Portugal',
    'es' => 'Espanha',
    'mx' => 'México',
    'co' => 'Colômbia',
    'ar' => 'Argentina',
    'cl' => 'Chile',
    'pe' => 'Peru',
    'fr' => 'França',
    'xx' => 'Desconhecido'
];

// Diretório onde serão salvas as bandeiras
$flagsDir = __DIR__ . '/../storage/app/public/bandeiras_mundo/';

// Verificar se o diretório existe, se não, criar
if (!file_exists($flagsDir)) {
    mkdir($flagsDir, 0755, true);
    echo "Diretório de bandeiras criado: {$flagsDir}\n";
}

// URL base para as bandeiras
$baseUrl = 'https://flagcdn.com/w80/';

// Função para baixar uma imagem
function downloadImage($url, $path) {
    $ch = curl_init($url);
    $fp = fopen($path, 'wb');
    
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $success = curl_exec($ch);
    $error = curl_error($ch);
    
    curl_close($ch);
    fclose($fp);
    
    return [
        'success' => $success,
        'error' => $error
    ];
}

// Baixar cada bandeira
foreach ($countries as $code => $name) {
    // Tratar o caso especial do país desconhecido
    if ($code === 'xx') {
        // Criar um placeholder para país desconhecido
        $image = imagecreatetruecolor(80, 60);
        $gray = imagecolorallocate($image, 200, 200, 200);
        $white = imagecolorallocate($image, 255, 255, 255);
        
        // Preencher com cinza
        imagefill($image, 0, 0, $gray);
        
        // Adicionar um '?' no centro
        imagestring($image, 5, 35, 20, '?', $white);
        
        // Salvar como PNG
        imagepng($image, $flagsDir . $code . '.png');
        imagedestroy($image);
        
        echo "Criada imagem placeholder para {$name} ({$code})\n";
        continue;
    }
    
    $url = $baseUrl . $code . '.png';
    $path = $flagsDir . $code . '.png';
    
    if (file_exists($path)) {
        echo "Bandeira de {$name} ({$code}) já existe. Pulando...\n";
        continue;
    }
    
    echo "Baixando bandeira de {$name} ({$code})...\n";
    $result = downloadImage($url, $path);
    
    if ($result['success']) {
        echo "Bandeira de {$name} ({$code}) baixada com sucesso!\n";
    } else {
        echo "Erro ao baixar bandeira de {$name} ({$code}): " . $result['error'] . "\n";
    }
}

echo "\nProcesso concluído. Verifique as bandeiras em {$flagsDir}\n";
