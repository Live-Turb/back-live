# V.3.8.9.36 - Substituição do Campo Transcrição por Link

## Descrição da Alteração
Substituição do campo "Transcrição" (texto puro) por um campo de link no backend, permitindo a visualização de documentos Word diretamente na interface através de um iframe.

## Mudanças Realizadas

### Backend
1. **Migração**
   - Criada migração `2025_04_01_173000_modify_transcricao_to_link.php`
   - Adicionado campo `link_transcricao` (string, nullable)
   - Removido campo `transcricao` (text)

2. **Modelo Anuncio**
   - Atualizado `$fillable` para incluir `link_transcricao`
   - Removido `transcricao` do `$fillable`

3. **Validação**
   - Atualizado `AnuncioRequest` para validar `link_transcricao` como URL
   - Adicionada mensagem de erro específica para URL inválida

4. **Views**
   - Atualizado formulário de edição para campo de URL
   - Atualizado formulário de criação para campo de URL
   - Adicionado placeholder e texto de ajuda

### Frontend
1. **Tipos**
   - Atualizada interface `Anuncio` para incluir `link_transcricao`
   - Removido campo `transcricao`

2. **Novo Componente**
   - Criado `WordDocumentViewer` para exibir documentos
   - Suporte para OneDrive, Google Drive, Office Online e MinIO
   - Validação de URLs permitidas
   - Conversão automática de URLs para modo de visualização

## Benefícios
1. Melhor organização do conteúdo
2. Visualização direta de documentos
3. Suporte a formatação rica
4. Possibilidade de edição colaborativa
5. Redução de carga no banco de dados

## Impacto
- **Dados**: Necessária migração dos dados existentes
- **Interface**: Mudança na forma de visualização
- **Performance**: Redução de carga no banco de dados

## Instruções de Execução

### 1. Backup
```bash
# Fazer backup do banco de dados
mysqldump -u seu_usuario -p seu_banco > backup_antes_migracao.sql
```

### 2. Executar Migrações
```bash
# Dar permissão de execução ao script
chmod +x scripts/process_transcricoes.sh

# Executar o script
./scripts/process_transcricoes.sh
```

### 3. Verificar Logs
```bash
# Verificar logs de execução
tail -f storage/logs/laravel.log
```

### 4. Testar Interface
1. Acessar a página de edição de um anúncio
2. Verificar se o campo de URL está presente
3. Testar inserção de link do MinIO
4. Verificar visualização do documento

## Próximos Passos
1. Migrar dados existentes para o novo formato
2. Testar com diferentes serviços de hospedagem
3. Implementar cache de visualização
4. Adicionar suporte a mais serviços de hospedagem

## Notas Técnicas
- URLs permitidas: MinIO, OneDrive, Google Drive, Office Online
- Altura padrão do iframe: 600px
- Suporte a visualização em modo tela cheia
- Validação de segurança para URLs permitidas
- Suporte a CORS para links do MinIO

## Rollback
Em caso de problemas, execute:
```bash
# Reverter migrações
php artisan migrate:rollback

# Restaurar backup
mysql -u seu_usuario -p seu_banco < backup_antes_migracao.sql
``` 