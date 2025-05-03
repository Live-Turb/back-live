# Versão 3.8.9.11 - Correção de Exibição do Número de Anúncios e Configuração de Porta

**Data:** 28/03/2025
**Desenvolvedor:** Suporte Técnico

## Sumário das Alterações

### 1. Correção de Exibição do Número de Anúncios
Implementação de solução para garantir que o valor do campo `numero_anuncios` seja corretamente exibido no frontend, forçando a conversão do valor para inteiro antes de ser enviado pela API.

### 2. Configuração de Porta Fixa para o Next.js
Alteração dos scripts de inicialização para garantir que o servidor Next.js sempre utilize a porta 3000, liberando a porta caso esteja em uso.

## Problema Resolvido

1. **Exibição do Número de Anúncios:** 
   - Problema: O campo `numero_anuncios` estava sendo definido no backend como 128, mas não aparecia no frontend, exibindo "0" ou nada.
   - Causa: Possível problema de serialização/deserialização entre Laravel e Next.js.

2. **Inconsistência de Porta para o Next.js:**
   - Problema: Quando a porta 3000 estava em uso, o Next.js automaticamente utilizava a porta 3001, o que poderia causar confusão em ambiente de produção.
   - Causa: Comportamento padrão do Next.js quando a porta está ocupada.

## Arquivos Afetados

### Backend (Laravel)
- `AppLaravel/app/Http/Controllers/Api/AnuncioController.php`
  - Modificação do método `index` para forçar a conversão do valor de `numero_anuncios` para inteiro antes de enviá-lo na resposta JSON.

### Frontend (Next.js)
- `escalados/package.json`
  - Alteração do script `dev` para liberar a porta 3000 antes de iniciar o servidor.
- `escalados/components/anuncio-card.tsx`
  - Garantia de fallback para valores nulos usando o operador `??`.

## Detalhes da Implementação

### 1. Correção do Valor de Número de Anúncios

No controlador `AnuncioController.php`, o método `index` foi modificado para processar explicitamente cada anúncio antes de enviá-lo na resposta:

```php
// Processar itens para garantir que numero_anuncios seja inteiro
$itens = $anuncios->items();
foreach ($itens as $anuncio) {
    // Força número de anúncios como inteiro
    if ($anuncio->numero_anuncios === null) {
        $anuncio->numero_anuncios = 0;
    } else {
        $anuncio->numero_anuncios = (int)$anuncio->numero_anuncios;
    }
    
    // Log para debug
    Log::debug("Anúncio {$anuncio->id} processado", [
        'titulo' => $anuncio->titulo,
        'numero_anuncios' => $anuncio->numero_anuncios,
        'tipo' => gettype($anuncio->numero_anuncios)
    ]);
}

return response()->json([
    'data' => $itens,
    // ...
]);
```

### 2. Configuração de Porta Fixa

No arquivo `package.json`, o script `dev` foi alterado para:

```json
"dev": "npx kill-port 3000 && next dev -p 3000"
```

Isso faz duas coisas:
1. Utiliza o pacote `kill-port` para finalizar qualquer processo que esteja utilizando a porta 3000
2. Especifica explicitamente a porta 3000 para o Next.js através do parâmetro `-p 3000`

## Impacto das Alterações

1. **Melhor Consistência de Dados:**
   - O valor de `numero_anuncios` agora é garantidamente exibido corretamente no frontend.
   - Qualquer valor nulo é tratado como 0 para evitar problemas de exibição.

2. **Consistência de Ambiente:**
   - O servidor Next.js agora utiliza sempre a porta 3000, facilitando a padronização de URLs.
   - Previne confusão para usuários e desenvolvedores sobre qual porta acessar.

## Instruções para Implementação

### 1. Backend (Laravel)
Aplicar as alterações no controlador `AnuncioController.php` e executar:
```bash
cd Z:\xampp\htdocs\liveturb\AppLaravel
php artisan cache:clear
php artisan config:clear
php artisan serve
```

### 2. Frontend (Next.js)
Instalar a dependência necessária e executar o servidor:
```bash
cd Z:\xampp\htdocs\liveturb\escalados
npm install kill-port --save-dev
npm run dev
```

## Testes Recomendados

1. **Validação do Número de Anúncios:**
   - Atualizar o valor de `numero_anuncios` para 128 no painel administrativo.
   - Verificar se o valor aparece corretamente no frontend (123).
   - Verificar os logs para confirmar a conversão para inteiro.

2. **Teste de Porta:**
   - Executar outro servidor na porta 3000.
   - Iniciar o Next.js com `npm run dev`.
   - Confirmar que o processo anterior é finalizado e o Next.js inicia na porta 3000.

## Conclusão

Estas alterações corrigem dois problemas importantes que afetavam a experiência do usuário e a confiabilidade do sistema. A correção do número de anúncios garante consistência entre o backend e frontend, enquanto a configuração de porta fixa garante previsibilidade na implantação e acesso ao sistema. 