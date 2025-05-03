# Instruções para Configuração do reCAPTCHA

Para garantir o funcionamento correto do sistema de reCAPTCHA que implementamos nas páginas de registro e redefinição de senha, você precisa adicionar as seguintes variáveis ao seu arquivo `.env`:

```
RECAPTCHA_SITE_KEY=sua_chave_do_site_aqui
RECAPTCHA_SECRET_KEY=sua_chave_secreta_aqui
```

## Como obter as chaves do reCAPTCHA

1. Acesse o [Console do Google reCAPTCHA](https://www.google.com/recaptcha/admin)
2. Faça login com sua conta do Google
3. Clique em "+" para criar um novo site
4. Escolha "reCAPTCHA v2" e a opção "Sou humano"
5. Adicione seu domínio na lista de domínios permitidos
6. Aceite os termos de serviço e clique em "Enviar"
7. Você receberá duas chaves: a "Chave do site" e a "Chave secreta"
8. Adicione essas chaves ao seu arquivo `.env` conforme mostrado acima

## Testando o reCAPTCHA

Para testar se o reCAPTCHA está funcionando corretamente:

1. Acesse a página de registro: `/user/register/{uuid}`
2. Preencha o formulário e verifique se o widget do reCAPTCHA aparece
3. Tente enviar o formulário sem marcar o reCAPTCHA (deve exibir uma mensagem de erro)
4. Marque o reCAPTCHA e envie o formulário (deve prosseguir normalmente)
5. Repita os testes para a página de redefinição de senha: `/password/reset`

Para fins de teste, você pode usar as seguintes chaves públicas do Google (apenas para ambiente de desenvolvimento):

```
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

> **IMPORTANTE**: As chaves acima são apenas para testes em ambiente de desenvolvimento. Para produção, você DEVE obter suas próprias chaves.
