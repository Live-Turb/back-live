# Ajuste na Exibição do Número de Anúncios

## Descrição do Problema
A seção "Espionagem de Anúncios" no frontend não estava exibindo corretamente os números de anúncios. Os valores exibidos não correspondiam aos dados do backend e a interface não deixava claro que os números se referiam a anúncios.

## Solução Implementada
1. Modificação da interface `EspionagemChartProps` para incluir os dados do anúncio:
   - Adicionado campo `anuncioData` com:
     - `numero_anuncios`: número total de anúncios
     - `variacao_diaria`: variação nas últimas 24h
     - `variacao_semanal`: variação nos últimos 7 dias

2. Ajuste no componente `EspionagemChart`:
   - Alterado o cálculo do `valorAtual` para usar `anuncioData.numero_anuncios`
   - Mantida a lógica de cálculo para valores máximos e mínimos baseada no histórico
   - Adicionada label "anúncios" nos cards de resumo para melhor clareza
   - Atualizado tooltip do gráfico para exibir "anúncios" ao invés de "criativos"

3. Atualização do componente `ModernDashboard`:
   - Passagem dos dados corretos do anúncio para o componente `EspionagemChart`
   - Adicionada estrutura de dados completa com número de anúncios e variações

## Benefícios
1. Exibição correta do número atual de anúncios
2. Maior precisão nas estatísticas apresentadas
3. Melhor sincronização entre frontend e backend
4. Interface mais clara e intuitiva
5. Melhor compreensão dos dados pelos usuários

## Impacto
- Não há impacto em funcionalidades existentes
- Apenas correção na exibição dos dados e melhorias visuais

## Testes Realizados
1. Verificação da exibição correta do número de anúncios
2. Validação da sincronização com o backend
3. Teste de diferentes cenários de dados
4. Validação da clareza das informações na interface

## Próximos Passos
1. Monitorar a precisão dos dados exibidos
2. Coletar feedback dos usuários sobre a clareza das informações
3. Considerar melhorias na visualização das variações
4. Avaliar possibilidade de adicionar mais detalhes sobre os anúncios 