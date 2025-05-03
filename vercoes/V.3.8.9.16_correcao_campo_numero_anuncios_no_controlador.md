# Versão 3.8.9.16 - Correção do Campo Número de Anúncios no Controlador API

**Data:** 28/03/2025
**Desenvolvedor:** Suporte Técnico

## Sumário da Alteração

Correção do nome do campo usado no controlador API V1 para garantir a correta exibição do número de anúncios no frontend.

## Problema Resolvido

**Inconsistência no Nome do Campo "Número de Anúncios":**
- **Problema**: O campo `numero_anuncios` definido no backend não estava sendo exibido no frontend, mostrando sempre "0".
- **Causa**: O controlador API V1 estava usando incorretamente o campo `contador_anuncios` (que não existe ou é sempre nulo) em vez de `numero_anuncios`.

## Arquivos Afetados

- `AppLaravel/app/Http/Controllers/Api/V1/AnuncioController.php`
  - Método `index` (linha 49)
  - Método `show` (linha 100)

## Detalhes da Implementação

### Substituição do Nome do Campo

Alteramos as referências ao campo incorreto `contador_anuncios` para usar o nome correto `numero_anuncios` nos dois métodos principais do controlador:

```php
// Antes
'contador_anuncios' => $anuncio->contador_anuncios ?? 0,

// Depois
'numero_anuncios' => $anuncio->numero_anuncios ?? 0,
```

## Resultados da Correção

1. **Consistência de Dados**: Agora o valor definido no backend (128) é corretamente exibido no frontend.
2. **Normalização de API**: A API agora usa consistentemente o nome de campo `numero_anuncios` em todas as camadas da aplicação.

## Testes Realizados

1. **Verificação da Resposta da API**: 
   - Teste da rota `/api/v1/teste-numero-anuncios` mostrou que o valor correto (128) estava armazenado no banco de dados.
   - Teste da rota `/api/v1/anuncios` após a correção confirmou que o campo agora está sendo corretamente transmitido na resposta da API.

2. **Verificação no Frontend**:
   - Após a correção, o valor "128" agora é exibido corretamente na interface onde antes mostrava "0".

## Observações

Esta correção demonstra a importância da consistência na nomenclatura de campos entre as diferentes camadas da aplicação. O problema ocorreu porque:

1. O banco de dados e o modelo Eloquent usavam `numero_anuncios`
2. O controlador da API V1 usava `contador_anuncios`
3. O frontend esperava `numero_anuncios`

Garantir consistência de nomenclatura entre backend e frontend é essencial para evitar problemas semelhantes no futuro. 