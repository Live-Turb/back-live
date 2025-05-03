# Script para corrigir os links simbólicos do storage

# Definir os caminhos
$appStoragePath = "Z:\xampp\htdocs\liveturb\AppLaravel\storage\app\public"
$publicStoragePath = "Z:\xampp\htdocs\liveturb\AppLaravel\public\storage"
$rootStoragePath = "Z:\xampp\htdocs\liveturb\storage"

Write-Host "Iniciando correção dos links simbólicos..." -ForegroundColor Green

# 1. Remover os links simbólicos existentes
if (Test-Path $publicStoragePath) {
    Write-Host "Removendo link simbólico existente em public/storage..." -ForegroundColor Yellow
    Remove-Item -Path $publicStoragePath -Force -Recurse -ErrorAction SilentlyContinue
}

if (Test-Path $rootStoragePath) {
    Write-Host "Removendo link simbólico existente na raiz do projeto..." -ForegroundColor Yellow
    Remove-Item -Path $rootStoragePath -Force -Recurse -ErrorAction SilentlyContinue
}

# 2. Criar o link simbólico em public/storage
Write-Host "Criando link simbólico em public/storage..." -ForegroundColor Green
New-Item -ItemType SymbolicLink -Path $publicStoragePath -Target $appStoragePath -Force

# 3. Criar o link simbólico na raiz do projeto
Write-Host "Criando link simbólico na raiz do projeto..." -ForegroundColor Green
New-Item -ItemType SymbolicLink -Path $rootStoragePath -Target $appStoragePath -Force

# 4. Verificar se os links foram criados corretamente
Write-Host "`nVerificando links simbólicos criados:" -ForegroundColor Cyan
$publicStorageLink = Get-Item -Path $publicStoragePath -ErrorAction SilentlyContinue
$rootStorageLink = Get-Item -Path $rootStoragePath -ErrorAction SilentlyContinue

if ($publicStorageLink -and $publicStorageLink.LinkType -eq "SymbolicLink") {
    Write-Host "- public/storage: OK" -ForegroundColor Green
} else {
    Write-Host "- public/storage: FALHA" -ForegroundColor Red
}

if ($rootStorageLink -and $rootStorageLink.LinkType -eq "SymbolicLink") {
    Write-Host "- /storage: OK" -ForegroundColor Green
} else {
    Write-Host "- /storage: FALHA" -ForegroundColor Red
}

Write-Host "`nProcesso concluído!" -ForegroundColor Green
