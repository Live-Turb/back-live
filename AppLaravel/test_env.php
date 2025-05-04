<?php

require __DIR__.'/vendor/autoload.php';

echo "Tentando carregar arquivo .env da raiz do projeto...\n";
$rootEnv = dirname(__DIR__);
if (file_exists($rootEnv . '/.env')) {
    echo "Arquivo .env encontrado na raiz: " . $rootEnv . "/.env\n";
} else {
    echo "Arquivo .env NÃO encontrado na raiz: " . $rootEnv . "/.env\n";
}

echo "\nTentando carregar arquivo .env da pasta AppLaravel...\n";
if (file_exists(__DIR__ . '/.env')) {
    echo "Arquivo .env encontrado em AppLaravel: " . __DIR__ . "/.env\n";
} else {
    echo "Arquivo .env NÃO encontrado em AppLaravel: " . __DIR__ . "/.env\n";
}

// Tentar carregar com Dotenv
echo "\nTentando carregar com Dotenv da raiz...\n";
try {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable($rootEnv);
    $dotenv->safeLoad();
    echo "Carregado com sucesso! APP_NAME: " . $_ENV['APP_NAME'] . "\n";
} catch (Exception $e) {
    echo "Erro ao carregar Dotenv da raiz: " . $e->getMessage() . "\n";
}

// Varificar variáveis de ambiente atuais
echo "\nVariáveis de ambiente atuais:\n";
$envVars = [
    'APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL',
    'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'
];

foreach ($envVars as $var) {
    echo $var . ': ' . (env($var) ?? 'não definido') . "\n";
}

function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return $value;
}
