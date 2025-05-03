# V.3.8.9.25 - Correção de exibição de imagens dos anúncios e criativos no frontend

**Data:** 29/03/2025
**Autor:** Equipe de Desenvolvimento
**Tipo:** Correção

## Resumo

Esta atualização resolve problemas na exibição de imagens de anúncios e criativos no frontend, garantindo que todas as imagens sejam carregadas corretamente através do novo controlador `StorageDirectController`.

## Problemas identificados

1. **Inconsistência nas URLs das imagens**: O controlador API V1 estava usando `asset('storage/')` para gerar URLs para imagens de anúncios e criativos, ignorando o acessor definido no modelo `Anuncio`.
2. **Armazenamento de imagens de criativos**: As imagens de criativos estavam sendo armazenadas de maneira diferente das imagens de anúncios.

## Soluções implementadas

1. **Uso consistente de acessores**: Atualizamos o controlador de API para usar os acessores de imagem definidos nos modelos, em vez de construir URLs manualmente.
2. **Padronização do armazenamento de imagens**: Criativos agora usam a mesma abordagem de armazenamento que anúncios, com imagens salvas diretamente na pasta `storage/criativos` e acessadas através da rota `/storage_direct/`.
3. **Adição de acessor para imagens de criativos**: Implementamos um acessor no modelo `Criativo` que gera URLs padronizadas para as imagens.

## Mudanças técnicas

### 1. Controller API V1 AnuncioController

- Removido o código que gerava URLs manualmente usando `asset('storage/')`.
- Agora utiliza os acessores `imagem` e `image` definidos nos modelos.

### 2. Modelo Criativo

- Adicionado o acessor `getImageAttribute` para gerar URLs consistentes para imagens.
- As URLs agora são formadas usando a rota `/storage_direct/`.

### 3. CriativoController

- Atualizado o método `store` para salvar imagens diretamente em `storage/criativos`.
- Atualizado o método `update` para usar o mesmo padrão do método `store`.
- Atualizado o método `destroy` para excluir imagens do diretório correto.

## Como testar

1. Acesse o painel admin em `/admin/anuncios`.
2. Edite um anúncio existente e adicione uma nova imagem.
3. Verifique se a imagem é exibida corretamente após salvar.
4. Adicione um novo criativo com imagem e confirme que a imagem é exibida.
5. Acesse o frontend e verifique se todas as imagens de anúncios e criativos estão sendo exibidas corretamente.

## Benefícios da correção

- **Consistência**: Todas as imagens agora são gerenciadas da mesma forma.
- **Confiabilidade**: A exibição de imagens é mais confiável porque usa um caminho padronizado.
- **Manutenção**: O código é mais fácil de manter com um único padrão para acesso a arquivos.
- **Desempenho**: As solicitações de imagem são tratadas de forma eficiente pelo controlador dedicado.

## Observações adicionais

Esta atualização é complementar à correção anterior (V.3.8.9.24) e completa a padronização do acesso a arquivos no sistema. 
