# Sistema de Transcrições

## Visão Geral
O sistema de transcrições foi atualizado para usar links externos para documentos Word ao invés de armazenar o conteúdo diretamente no banco de dados. Isso traz várias vantagens:

- Melhor performance do banco de dados
- Suporte a formatação rica do Word
- Possibilidade de edição colaborativa
- Integração com serviços de armazenamento em nuvem

## Formatos Suportados
O sistema suporta os seguintes formatos de links:

1. MinIO
   - Links diretos do servidor MinIO
   - URLs no formato: https://prod-minio.ja6ipr.easypanel.host/...

2. OneDrive
   - Links diretos (1drv.ms)
   - Links compartilhados (onedrive.live.com)

3. Google Drive
   - Links de compartilhamento
   - Links de visualização

4. Office Online
   - Links diretos do Office Online
   - Links do SharePoint

## Migração de Dados
Para preservar os dados existentes, foi criado um processo de migração que:

1. Cria uma tabela temporária `temp_transcricoes`
2. Copia os dados existentes da tabela `anuncios`
3. Gera documentos Word para cada transcrição
4. Atualiza os links na tabela `anuncios`

## Visualização
O sistema utiliza o Office Online Viewer para exibir os documentos, que oferece:

- Visualização em tempo real
- Suporte a formatação completa
- Compatibilidade com diferentes versões do Word
- Interface responsiva

## Segurança
- Todos os links são validados antes de serem salvos
- Acesso aos documentos é controlado pelas configurações de compartilhamento
- URLs são sanitizadas antes da exibição
- Suporte a CORS para links do MinIO

## Manutenção
Para manter o sistema funcionando corretamente:

1. Verifique periodicamente se os links estão acessíveis
2. Atualize os links se necessário
3. Mantenha os documentos organizados nas pastas apropriadas
4. Monitore o uso de espaço em disco
5. Verifique as configurações de CORS do MinIO 