# Documentação de Implementação - API RESTful para Integração Laravel/Next.js

**Versão:** V.3.8.9.8  
**Data:** 27/03/2025  
**Desenvolvedor:** Suporte Técnico  

## Resumo da Alteração

Implementação de uma API RESTful no Laravel para integração com o frontend Next.js. Esta implementação permite que o frontend em Next.js consuma dados do backend Laravel, mantendo a estrutura de dados compatível entre os dois sistemas.

## Problema Solucionado

O sistema possui dois componentes principais:
1. Backend em Laravel com gerenciamento de anúncios (`/admin/anuncios`)
2. Frontend em Next.js (`/escalados`) que precisa consumir esses dados

Antes da implementação, não havia uma maneira padronizada de comunicação entre esses componentes. A integração desenvolvida permite:
- Consumo eficiente dos dados via API RESTful
- Transformação dos dados para o formato esperado pelo frontend
- Preservação das funcionalidades existentes
- Redirecionamento transparente entre os sistemas

## Arquivos Afetados

### Controladores (Novos)
1. `AppLaravel/app/Http/Controllers/Api/V1/AnuncioController.php`
2. `AppLaravel/app/Http/Controllers/Api/V1/CategoriaController.php`
3. `AppLaravel/app/Http/Controllers/Api/V1/NichoController.php`
4. `AppLaravel/app/Http/Controllers/NextJsController.php`

### Arquivos de Configuração (Modificados)
1. `AppLaravel/.env` - Adicionada configuração para URL do Next.js
2. `AppLaravel/config/app.php` - Adicionada configuração para integração com Next.js
3. `AppLaravel/config/cors.php` - Configurado CORS para permitir requisições do Next.js

### Arquivos de Rotas (Modificados)
1. `AppLaravel/routes/api.php` - Adicionadas rotas para a API V1
2. `AppLaravel/routes/web.php` - Adicionada rota para redirecionamento para o Next.js

### Configurações para o Next.js (Novos)
1. `ALTERACOES/next-js-config/next.config.mjs`
2. `ALTERACOES/next-js-config/.env.local`
3. `ALTERACOES/next-js-config/README.md`

## Detalhes da Implementação

### 1. API RESTful no Laravel

#### 1.1. AnuncioController
Este controlador implementa:
- **Método `index()`**: Lista anúncios com suporte para filtros e paginação
- **Método `show()`**: Exibe detalhes de um anúncio específico
- **Métodos auxiliares**: 
  - `transformarCriativos()`: Converte objetos de criativos para o formato esperado
  - `gerarEstatisticas()`: Cria dados de estatísticas para períodos de 7, 15 e 30 dias
  - `gerarPerformanceCriativos()`: Gera métricas de desempenho para criativos

Transformação de dados:
```php
// Exemplo da transformação de anúncios
$anunciosTransformados = [];
foreach ($anuncios->items() as $anuncio) {
    $anunciosTransformados[] = [
        'id' => $anuncio->id,
        'titulo' => $anuncio->titulo,
        'tag_principal' => $anuncio->tag_principal,
        // ... outros campos ...
        'links' => [
            'pagina_anuncio' => $anuncio->link_pagina_anuncio,
            // ... outros links ...
        ],
        'produto' => [
            'tipo' => $anuncio->produto_tipo,
            // ... outras propriedades do produto ...
        ],
        'criativos' => $this->transformarCriativos($anuncio->criativos),
        'estatisticas' => $this->gerarEstatisticas($anuncio),
        'creativesPerformance' => $this->gerarPerformanceCriativos($anuncio),
    ];
}
```

#### 1.2. CategoriaController
Fornece categorias baseadas nas tags principais:
```php
public function index()
{
    $categorias = [
        [
            'id' => 'escalando',
            'nome' => 'Escalando',
            'contador' => Anuncio::where('tag_principal', 'ESCALANDO')->count(),
            'gradientClass' => 'bg-gradient-to-r from-amber-500 to-orange-500',
            'shadowClass' => 'shadow-amber-500/30',
        ],
        // ... outras categorias ...
    ];

    return response()->json(['data' => $categorias]);
}
```

#### 1.3. NichoController
Recupera nichos únicos do banco de dados:
```php
public function index()
{
    $nichos = Anuncio::select('nicho')
        ->distinct()
        ->get()
        ->map(function ($item) {
            return [
                'id' => strtolower(str_replace(' ', '-', $item->nicho)),
                'nome' => $item->nicho
            ];
        });

    return response()->json(['data' => $nichos]);
}
```

### 2. Rotas API

Foram adicionadas as seguintes rotas à API:

```php
// Rotas públicas para a API V1
Route::prefix('v1')->group(function () {
    // Rotas de anúncios
    Route::get('/anuncios', [AnuncioV1Controller::class, 'index']);
    Route::get('/anuncios/{id}', [AnuncioV1Controller::class, 'show']);
    
    // Rotas de categorias
    Route::get('/categorias', [CategoriaController::class, 'index']);
    
    // Rotas de nichos
    Route::get('/nichos', [NichoController::class, 'index']);
});
```

### 3. Redirecionamento para Next.js

Implementado o NextJsController para redirecionar para o aplicativo Next.js:

```php
public function index($path = null)
{
    $nextJsUrl = config('app.next_js_url', 'http://localhost:3000');
    $fullUrl = $nextJsUrl . "/escalando-agora";
    
    if ($path) {
        $fullUrl .= "/{$path}";
    }
    
    return redirect()->away($fullUrl);
}
```

Rota web adicionada:
```php
Route::get('escalando-agora/{path?}', [NextJsController::class, 'index'])
    ->where('path', '.*')
    ->name('next.index');
```

### 4. Configurações

#### 4.1. Variáveis de Ambiente (.env)
```
NEXT_JS_URL=http://localhost:3000
```

#### 4.2. CORS (config/cors.php)
```php
'allowed_origins' => ['http://localhost:3000', env('NEXT_JS_URL'), env('APP_URL')],
```

#### 4.3. Configuração da Aplicação (config/app.php)
```php
'next_js_url' => env('NEXT_JS_URL', 'http://localhost:3000'),
```

### 5. Configuração do Next.js

#### 5.1. next.config.mjs
```javascript
/** @type {import('next').NextConfig} */
const nextConfig = {
  // ... configurações existentes ...
  basePath: '/escalando-agora',
  async rewrites() {
    return [
      {
        source: '/api/v1/:path*',
        destination: process.env.LARAVEL_API_URL || 'http://localhost:8000/api/v1/:path*',
      },
    ];
  },
}
```

#### 5.2. .env.local
```
LARAVEL_API_URL=http://localhost:8000/api/v1
```

## Lógica da Solução

A implementação seguiu estes princípios:

1. **Transformação de Dados**: Adaptação dos modelos do Laravel para a estrutura esperada pelo Next.js
   - Conversão de campos individuais para objetos aninhados (ex: `links` e `produto`)
   - Geração de dados estatísticos no formato esperado pelo frontend

2. **Preservação da Estrutura Existente**: Respeito às convenções e estruturas já implementadas
   - Uso do relacionamento existente entre `Anuncio` e `Criativo`
   - Preservação dos campos atuais sem quebrar compatibilidade

3. **API Pública com Segurança**: Rotas públicas para consumo do Next.js, mantendo rotas administrativas protegidas
   - Rotas da API V1 são públicas para acesso do frontend
   - Rotas administrativas mantidas sob autenticação

4. **Integração Bidirecional**: 
   - Laravel pode redirecionar para o Next.js através da rota `escalando-agora`
   - Next.js pode consumir dados do Laravel através da API RESTful

## Testes e Validação

Para testar a implementação:

1. Inicie o servidor Laravel:
```bash
cd /z:/xampp/htdocs/liveturb/AppLaravel
php artisan serve
```

2. Configure e inicie o Next.js:
```bash
cd /z:/xampp/htdocs/liveturb/escalados
cp /z:/xampp/htdocs/liveturb/ALTERACOES/next-js-config/next.config.mjs .
cp /z:/xampp/htdocs/liveturb/ALTERACOES/next-js-config/.env.local .
npm run dev
```

3. Acesse os endpoints para verificar:
   - API Laravel: `http://localhost:8000/api/v1/anuncios`
   - Redirecionamento: `http://localhost:8000/escalando-agora`

## Conclusão

A implementação da API RESTful no Laravel para integração com o frontend Next.js foi concluída com sucesso, permitindo uma comunicação eficiente entre os sistemas. A solução mantém a integridade dos dados, respeita as convenções existentes e proporciona uma experiência fluida para os usuários finais. 