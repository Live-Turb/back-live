# Configuração do Frontend Next.js

Este guia contém as etapas necessárias para configurar o frontend Next.js para integração com a API Laravel.

## Arquivos de Configuração

Dois arquivos principais precisam ser configurados:

1. **next.config.mjs** - Configuração principal do Next.js
2. **.env.local** - Variáveis de ambiente locais

## Instruções de Instalação

1. Copie o arquivo `next.config.mjs` para a pasta raiz do seu projeto Next.js (substitua o existente se necessário)
2. Copie o arquivo `.env.local` para a pasta raiz do seu projeto Next.js

## Iniciando o Servidor Next.js

Após configurar os arquivos, inicie o servidor Next.js:

```bash
cd /z:/xampp/htdocs/liveturb/escalados
npm run dev
```

## URLs para Teste

Após iniciar os servidores Laravel e Next.js, você pode acessar:

### API Laravel:
- Lista de anúncios: http://localhost:8000/api/v1/anuncios
- Anúncio específico: http://localhost:8000/api/v1/anuncios/1
- Categorias: http://localhost:8000/api/v1/categorias
- Nichos: http://localhost:8000/api/v1/nichos

### Frontend Next.js:
- Página principal: http://localhost:8000/escalando-agora
- Detalhes de anúncio: http://localhost:8000/escalando-agora/anuncios/1

### Administração Laravel:
- Gerenciamento de anúncios: http://localhost:8000/admin/anuncios

## Estrutura Esperada de Dados

A API foi projetada para retornar a estrutura de dados exatamente como esperada pelo frontend Next.js:

- Objetos aninhados como `links` e `produto` 
- Estatísticas em formato específico (7/15/30 dias)
- Estrutura de criativos compatível 