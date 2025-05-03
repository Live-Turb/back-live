#!/bin/bash

echo "Iniciando processo de migração..."

# Executar migrações
php artisan migrate

# Processar transcrições
php artisan transcricoes:processar

echo "Processo de migração concluído!"
