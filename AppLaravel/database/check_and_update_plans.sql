-- Primeiro, vamos ver os valores atuais
SELECT id, name, views_limit, `limit` FROM pay_pal_plans;

-- Agora vamos atualizar os valores corretamente
UPDATE pay_pal_plans SET views_limit = 6000 WHERE name = 'Basic';
UPDATE pay_pal_plans SET views_limit = 25000 WHERE name = 'Smart';
UPDATE pay_pal_plans SET views_limit = 50000 WHERE name = 'Gold';

-- Verificar novamente após a atualização
SELECT id, name, views_limit, `limit` FROM pay_pal_plans;
