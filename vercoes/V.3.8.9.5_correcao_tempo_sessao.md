# Correção do Tempo de Sessão na Dashboard KPI - V.3.8.9.5

## Problema Identificado

Foram identificados os seguintes problemas na página `/admin/kpi`:

1. O card "Tempo Médio de Sessão" estava exibindo "0 min" ao invés do valor real.
2. O card "Tempo de Sessão dos Usuários" estava exibindo a mensagem "Nenhum dado de tempo de sessão disponível para o período selecionado" ao invés de mostrar o gráfico com os dados.

## Análise do Problema

Após investigação, foram identificadas as seguintes causas:

1. O controlador `KpiController` estava tentando filtrar os dados de sessão usando as colunas `role` e `is_active` da tabela `users`, mas essas colunas não existem na estrutura atual do banco de dados.
2. As consultas SQL estavam falhando silenciosamente devido a essas referências a colunas inexistentes, resultando em conjuntos de dados vazios.

## Correções Implementadas

### 1. Método `getSessionTimeData` no `KpiController`

Modificamos o método para não depender das colunas inexistentes:

```php
// Antes
$sessionData = DB::table('user_sessions as us')
    ->join('users as u', 'us.user_id', '=', 'u.id')
    ->where('u.role', 'user')
    ->where('u.is_active', true)
    ->whereBetween('us.created_at', [$startDate, $endDate])
    ->select(
        DB::raw('DATE(us.created_at) as date'),
        DB::raw('
            AVG(TIMESTAMPDIFF(SECOND, us.created_at, us.last_activity_at)) as avg_duration
        ')
    )
    ->groupBy('date')
    ->orderBy('date')
    ->get();

// Depois
$sessionData = DB::table('user_sessions as us')
    ->join('users as u', 'us.user_id', '=', 'u.id')
    ->whereBetween('us.created_at', [$startDate, $endDate])
    ->select(
        DB::raw('DATE(us.created_at) as date'),
        DB::raw('AVG(TIMESTAMPDIFF(SECOND, us.created_at, us.last_activity_at)) as avg_duration')
    )
    ->groupBy('date')
    ->orderBy('date')
    ->get();
```

### 2. Método `getTotalSessionTime` no `KpiController`

Modificamos o método para não depender das colunas inexistentes:

```php
// Antes
$totalTime = DB::table('user_sessions as us')
    ->join('users as u', 'us.user_id', '=', 'u.id')
    ->where('u.role', 'user')
    ->where('u.is_active', true)
    ->select(DB::raw('
        AVG(TIMESTAMPDIFF(SECOND, us.created_at, us.last_activity_at)) as avg_duration
    '))
    ->first();

// Depois
$totalTime = DB::table('user_sessions as us')
    ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, us.created_at, us.last_activity_at)) as avg_duration'))
    ->first();
```

### 3. Adição de Logs para Melhor Monitoramento

Adicionamos logs detalhados para facilitar o diagnóstico de problemas futuros:

```php
// Registrar informações para debug
Log::info('Buscando dados de tempo de sessão', [
    'period' => $period,
    'start_date' => $startDate->toDateTimeString(),
    'end_date' => $endDate->toDateTimeString()
]);

// Registrar o resultado para debug
Log::info('Tempo médio de sessão calculado', [
    'avg_duration_seconds' => $averageDuration,
    'avg_minutes' => $averageMinutes
]);
```

## Testes Realizados

1. Criamos scripts de diagnóstico para verificar a estrutura das tabelas e os dados existentes.
2. Confirmamos que a tabela `user_sessions` existe e contém dados válidos.
3. Verificamos que as consultas modificadas retornam dados corretos.
4. Testamos os métodos do controlador diretamente e confirmamos que eles agora retornam os dados esperados.

## Resultados

Após as correções:

1. O card "Tempo Médio de Sessão" agora exibe o valor correto (aproximadamente 45.7 minutos).
2. O card "Tempo de Sessão dos Usuários" agora exibe o gráfico com os dados de tempo de sessão por dia.

## Recomendações Futuras

1. Considerar a adição de índices na tabela `user_sessions` para melhorar o desempenho das consultas.
2. Implementar um sistema de monitoramento mais robusto para detectar problemas semelhantes no futuro.
3. Revisar outras partes do código que possam estar referenciando colunas inexistentes no banco de dados. 