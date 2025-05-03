# Correção na Captura de Visualizações de Templates - V.3.8.9.3

## Problema Identificado

Foi identificado um problema na captura e exibição dos dados de visualização dos templates criados pelos usuários. As visualizações não estavam sendo corretamente registradas e exibidas nos painéis de análise, tanto no painel do usuário quanto no painel administrativo.

## Análise do Problema

Após uma análise detalhada do código, identificamos os seguintes problemas:

1. O middleware `TrackViewsMiddleware` não estava capturando o `template_id` das visualizações, o que resultava em registros incompletos na tabela `view_statistics`.

2. O controlador `KpiController` não estava consultando corretamente os dados de visualizações por país a partir da tabela `view_statistics`, utilizando dados simulados em vez de dados reais.

3. O método `getUsersOnlineGeographicData` no `KpiController` não estava processando corretamente os códigos de país para exibição no mapa.

## Correções Implementadas

### 1. Middleware TrackViewsMiddleware

Modificamos o middleware `TrackViewsMiddleware` para capturar o `template_id` a partir do UUID do template na rota:

```php
// Tenta obter o template_id da rota
$templateId = null;
$uuid = $request->route('uuid');

if ($uuid) {
    // Busca o template pelo UUID
    $template = \App\Models\VideoDetail::where('uuid', $uuid)->first();
    if ($template) {
        $templateId = $template->id;
        \Log::info("Template encontrado: ID {$templateId}, UUID {$uuid}");
    } else {
        \Log::warning("Template não encontrado para UUID: {$uuid}");
    }
} else {
    \Log::warning("UUID não encontrado na rota");
}

// Registra a visualização
$viewData = [
    'user_id' => auth()->id(),
    'template_id' => $templateId, // Adiciona o template_id
    // ... outros campos
];
```

### 2. KpiController - Método getUsersGeographicData

Modificamos o método `getUsersGeographicData` para obter dados reais de visualizações por país a partir da tabela `view_statistics`:

```php
// Obter dados reais de visualizações por país a partir da tabela view_statistics
$usersGeo = DB::table('view_statistics')
    ->select('country', DB::raw('count(*) as total'))
    ->whereNotNull('country')
    ->where('country', '!=', '')
    ->where('created_at', '>=', now()->subDays(30)) // Últimos 30 dias
    ->groupBy('country')
    ->orderByDesc('total')
    ->get();

// Se não houver dados, retornar dados simulados
if ($usersGeo->isEmpty()) {
    \Log::warning('Nenhum dado geográfico encontrado, retornando dados simulados');
    
    // ... dados simulados
} else {
    \Log::info('Dados geográficos encontrados: ' . $usersGeo->count() . ' países');
    
    // Converter os códigos de país para minúsculas para compatibilidade com o mapa
    $usersGeo = $usersGeo->map(function($item) {
        return [
            'country' => strtolower($item->country),
            'total' => $item->total
        ];
    });
}
```

### 3. KpiController - Método getUsersOnlineGeographicData

Modificamos o método `getUsersOnlineGeographicData` para processar corretamente os códigos de país:

```php
// Converter os códigos de país para minúsculas para compatibilidade com o mapa
$onlineUsers = $onlineUsers->map(function($item) {
    return [
        'country' => strtolower($item->country),
        'total' => $item->total
    ];
});
```

## Resultados Esperados

Com essas correções, esperamos que:

1. As visualizações dos templates sejam corretamente registradas na tabela `view_statistics` com o `template_id` correspondente.

2. Os dados de visualizações por país sejam corretamente exibidos no painel de administração, na seção "Distribuição Geográfica de Usuários".

3. Os dados de usuários online por país sejam corretamente exibidos no painel de administração, com os círculos pulsantes ao redor de cada valor.

## Próximos Passos

1. Monitorar os logs para verificar se as visualizações estão sendo corretamente registradas.

2. Verificar se os dados estão sendo corretamente exibidos nos painéis de análise.

3. Considerar a implementação de testes automatizados para garantir que essas funcionalidades continuem funcionando corretamente no futuro. 