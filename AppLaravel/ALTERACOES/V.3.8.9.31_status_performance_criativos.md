# V.3.8.9.31 - Implementação de Status de Performance Dinâmico para Criativos

**Data:** 02/04/2025
**Autor:** Equipe de Desenvolvimento
**Tipo:** Melhoria

## Resumo
Esta atualização implementa um sistema dinâmico de status de performance para os criativos, baseado no número total de criativos ativos e na quantidade de novos criativos. O sistema calcula automaticamente o status de performance quando o número de criativos é alterado no painel administrativo.

## Parâmetros de Status
1. **Escalando**: Quando há 50 ou mais criativos ativos
2. **Testando criativos**: Quando há entre 20 e 49 criativos ativos
3. **Perdendo desempenho**: Quando há menos de 10 criativos ativos
4. **Lateralizando Oferta**: Quando há 15 ou mais novos criativos nos últimos 7 dias

## Alterações Técnicas

### Banco de Dados
- Adição do campo `performance_status` na tabela `criativos`
- Adição do campo `last_status_change` para rastrear a última atualização de status
- Nova migration: `2024_04_02_000000_add_performance_status_to_criativos.php`

### Modelo Criativo
- Novo método `calculatePerformanceStatus()` para calcular o status baseado nas métricas
- Novo método `countNovosCriativos()` para contar criativos criados nos últimos 7 dias
- Adição dos campos na lista de `fillable`
- Configuração de `casts` para campos de data

### Controller
- Atualização do método `update` no `CriativoController`
- Implementação da lógica de cálculo de status ao alterar o número de criativos
- Adição de logs para rastrear mudanças de status

### Frontend
- Adição do indicador de status de performance no formulário de edição
- Badges coloridos para diferentes status:
  - Verde: Escalando
  - Azul: Testando criativos
  - Azul escuro: Lateralizando Oferta
  - Amarelo: Perdendo desempenho

## Lógica de Status
1. **Verificação de Lateralização**:
   - Primeiro verifica se há 15+ novos criativos nos últimos 7 dias
   - Se sim, define status como "Lateralizando Oferta"

2. **Verificação por Quantidade**:
   - Se não está lateralizando, verifica o número total de criativos
   - 50+ → Escalando
   - 20-49 → Testando criativos
   - <10 → Perdendo desempenho

## Benefícios
1. **Monitoramento Automático**: Status atualizado automaticamente com as mudanças
2. **Visibilidade**: Fácil identificação do desempenho dos criativos
3. **Rastreabilidade**: Histórico de mudanças de status com timestamps
4. **Análise de Tendências**: Identificação de padrões de crescimento ou declínio

## Instruções para Teste
1. Acesse o painel de edição de um criativo
2. Altere o "Número de Criativos" para diferentes valores:
   - Acima de 50 para ver status "Escalando"
   - Entre 20-49 para ver "Testando criativos"
   - Abaixo de 10 para ver "Perdendo desempenho"
3. Crie vários criativos novos (15+) para ver o status "Lateralizando Oferta"
4. Verifique se o timestamp de última atualização é atualizado

## Considerações Técnicas
- O cálculo de novos criativos considera os últimos 7 dias
- O status é atualizado apenas quando o número de criativos é alterado
- Logs são gerados para cada mudança de status
- O sistema é retroativo e funciona com criativos existentes

## Próximos Passos
1. Implementar histórico de mudanças de status
2. Adicionar gráficos de tendência de status
3. Criar alertas para mudanças significativas de status
4. Desenvolver relatórios de performance baseados nos status
5. Considerar métricas adicionais para o cálculo de status 
