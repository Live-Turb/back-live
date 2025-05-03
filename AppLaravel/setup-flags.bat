@echo off
echo Instalando dependencias...
composer require symfony/intl

echo Criando diretorios...
mkdir storage\app\public\bandeiras_mundo 2>nul

echo Configurando link simbolico...
php artisan storage:link

echo Baixando bandeiras...
php artisan setup:country-flags

echo Configuracao concluida!
