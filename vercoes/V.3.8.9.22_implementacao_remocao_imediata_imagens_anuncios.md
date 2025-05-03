# Implementação da Funcionalidade de Remoção Imediata de Imagens nos Anúncios

**Versão:** V.3.8.9.22  
**Data:** 30/03/2023  
**Autor:** Equipe de Desenvolvimento

## Resumo

A implementação realizada adiciona a capacidade de remover imagens de anúncios no painel administrativo (/admin/anuncios) sem a necessidade de salvar o formulário completo. Anteriormente, para remover uma imagem era necessário clicar em "Salvar Alterações" após solicitar a remoção, agora essa ação é imediata através de AJAX.

## Problema Identificado

No painel administrativo de anúncios (/admin/anuncios), os usuários podiam fazer upload de imagens para os anúncios, mas não havia uma opção para remover ou substituir essas imagens sem recarregar a página ou salvar todo o formulário. Isso tornava o processo de gerenciamento de imagens ineficiente.

### Limitações Anteriores:
- Para substituir uma imagem, era necessário fazer o upload de uma nova
- Não era possível remover uma imagem sem substituir
- Após solicitar a remoção, era necessário salvar o formulário inteiro para efetivar a operação

## Solução Implementada

Implementamos uma solução baseada em AJAX que permite remover a imagem de um anúncio instantaneamente, sem a necessidade de recarregar a página ou salvar o formulário completo.

### Componentes da Solução:

1. **Nova Rota**: Criamos uma rota dedicada para processar a remoção de imagens.
2. **Método no Controller**: Adicionamos um método no controlador para remover a imagem.
3. **Confirmação via Modal**: Implementamos um modal de confirmação para evitar remoções acidentais.
4. **Feedback Instantâneo**: A interface é atualizada imediatamente após a remoção.
5. **Tratamento de Backdrop**: Corrigimos um problema com o backdrop do modal que permanecia na tela.

## Arquivos Modificados

### 1. Rotas da Aplicação

**Arquivo:** `AppLaravel/routes/web.php`

```php
// Adicionada nova rota para remover imagens
Route::post('/admin/anuncios/{id}/remover-imagem', [App\Http\Controllers\Admin\AnuncioController::class, 'removerImagem'])->name('admin.anuncios.remover-imagem');
```

### 2. Controller de Anúncios

**Arquivo:** `AppLaravel/app/Http/Controllers/Admin/AnuncioController.php`

```php
/**
 * Remover a imagem de um anúncio via AJAX.
 */
public function removerImagem(string $id)
{
    $anuncio = Anuncio::findOrFail($id);

    // Verificar se o anúncio tem imagem
    if (!$anuncio->imagem) {
        return response()->json([
            'success' => false,
            'message' => 'Este anúncio não possui imagem para remover.'
        ], 400);
    }

    // Remover a imagem do storage
    Storage::disk('public')->delete($anuncio->imagem);

    // Atualizar o registro no banco de dados
    $anuncio->imagem = null;
    $anuncio->save();

    return response()->json([
        'success' => true,
        'message' => 'Imagem removida com sucesso!'
    ]);
}
```

**Modificações no método `update`**:
- Removida a lógica de remoção de imagem do método `update`, deixando apenas o código para upload de nova imagem.

### 3. Request de Validação

**Arquivo:** `AppLaravel/app/Http/Requests/AnuncioRequest.php`

- Removida a regra de validação para o campo `remover_imagem`, já que ele não é mais utilizado.

### 4. View de Edição

**Arquivo:** `AppLaravel/resources/views/admin/anuncios/edit.blade.php`

**Principais alterações:**

```html
<!-- CSRF Token para requisições AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Botão de remover imagem no container da imagem -->
<div class="mt-2 d-flex align-items-center">
    <div>
        <img src="{{ asset('storage/' . $anuncio->imagem) }}" alt="{{ $anuncio->titulo }}" class="img-thumbnail" style="max-height: 100px;">
        <small class="text-muted d-block mt-1">Imagem atual</small>
    </div>
    <div class="ms-3">
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#removerImagemModal">
            <i class="fas fa-trash"></i> Remover Imagem
        </button>
    </div>
</div>

<!-- Modal para confirmar remoção -->
<div class="modal fade" id="removerImagemModal" tabindex="-1" aria-labelledby="removerImagemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removerImagemModalLabel">Confirmar Remoção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja remover a imagem deste anúncio?</p>
                <p class="text-danger"><strong>Atenção:</strong> Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarRemoverImagem">Remover Imagem</button>
            </div>
        </div>
    </div>
</div>
```

**Script JavaScript para processar a remoção via AJAX:**

```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Adicionar listener para quando o modal for escondido por qualquer motivo
    const modalElement = document.getElementById('removerImagemModal');
    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function () {
            // Remover backdrop manualmente
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
    }
    
    // Configurar o botão de confirmar remoção de imagem
    const btnConfirmarRemoverImagem = document.getElementById('confirmarRemoverImagem');

    if (btnConfirmarRemoverImagem) {
        btnConfirmarRemoverImagem.addEventListener('click', function() {
            // Obter o ID do anúncio da URL
            const url = window.location.pathname;
            const matches = url.match(/\/admin\/anuncios\/(\d+)\/edit/);
            const idAnuncio = matches ? matches[1] : null;
            
            if (!idAnuncio) {
                console.error('Não foi possível obter o ID do anúncio');
                return;
            }
            
            // Mostrar loader ou desabilitar botão
            btnConfirmarRemoverImagem.disabled = true;
            btnConfirmarRemoverImagem.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Removendo...';
            
            // Enviar requisição AJAX para remover a imagem
            fetch(`/admin/anuncios/${idAnuncio}/remover-imagem`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                // Fechar o modal corretamente
                const modal = bootstrap.Modal.getInstance(document.getElementById('removerImagemModal'));
                modal.hide();
                
                // Remover backdrop manualmente
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                if (data.success) {
                    // Remover a imagem da visualização
                    const containerImagem = document.querySelector('.img-thumbnail').closest('.mt-2');
                    containerImagem.innerHTML = '';
                    
                    // Adicionar mensagem de sucesso
                    const alertSuccess = document.createElement('div');
                    alertSuccess.className = 'alert alert-success mt-2';
                    alertSuccess.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                    
                    const containerPai = document.querySelector('#imagem').closest('.mb-3');
                    containerPai.insertBefore(alertSuccess, document.querySelector('.form-text'));
                    
                    // Esconder o botão após alguns segundos
                    setTimeout(() => {
                        alertSuccess.classList.add('fade');
                        setTimeout(() => alertSuccess.remove(), 500);
                    }, 3000);
                } else {
                    // Mostrar mensagem de erro
                    const alertError = document.createElement('div');
                    alertError.className = 'alert alert-danger mt-2';
                    alertError.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + (data.message || 'Erro ao remover a imagem.');
                    
                    const containerPai = document.querySelector('#imagem').closest('.mb-3');
                    containerPai.insertBefore(alertError, document.querySelector('.form-text'));
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                
                // Fechar o modal corretamente
                const modal = bootstrap.Modal.getInstance(document.getElementById('removerImagemModal'));
                modal.hide();
                
                // Remover backdrop manualmente
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                
                // Mostrar mensagem de erro
                const alertError = document.createElement('div');
                alertError.className = 'alert alert-danger mt-2';
                alertError.innerHTML = '<i class="fas fa-exclamation-circle"></i> Ocorreu um erro ao processar sua solicitação.';
                
                const containerPai = document.querySelector('#imagem').closest('.mb-3');
                containerPai.insertBefore(alertError, document.querySelector('.form-text'));
            })
            .finally(() => {
                // Restaurar botão
                btnConfirmarRemoverImagem.disabled = false;
                btnConfirmarRemoverImagem.innerHTML = 'Remover Imagem';
            });
        });
    }
});
```

## Lógica da Solução

1. **Abordagem AJAX**: Utilizamos AJAX para permitir a remoção de imagens sem recarregar a página, proporcionando uma experiência mais fluida para o usuário.

2. **Confirmação de Ação**: Implementamos um modal de confirmação para evitar remoções acidentais, seguindo boas práticas de UX.

3. **Feedback Visual**: Adicionamos feedback visual imediato através de:
   - Indicador de carregamento durante a operação
   - Mensagem de sucesso/erro após a operação
   - Remoção visual da imagem da interface

4. **Tratamento de Erros**: Implementamos tratamento de erros robusto para lidar com possíveis falhas na operação.

5. **Correção do Modal Backdrop**: Resolvemos um problema onde o backdrop (máscara) do modal permanecia na tela após o fechamento, impedindo interações com a página. Implementamos uma solução que remove manualmente os elementos e classes CSS relacionados ao backdrop.

## Instruções para Testes

1. Acesse o painel administrativo em `/admin/anuncios`
2. Edite um anúncio que possua uma imagem
3. Clique no botão "Remover Imagem"
4. Confirme a remoção no modal
5. A imagem deve ser removida instantaneamente e uma mensagem de sucesso deve aparecer

## Observações Técnicas

- A solução mantém a compatibilidade com a funcionalidade existente de substituição de imagens
- O código foi implementado seguindo as melhores práticas de AJAX e manipulação do DOM
- Utilizamos promises para lidar com o fluxo assíncrono da requisição
- A implementação é compatível com todos os navegadores modernos

## Próximos Passos

- Implementar a mesma funcionalidade para outros tipos de mídia no sistema
- Adicionar opção de crop/redimensionamento de imagens antes do upload
- Considerar a implementação de uma biblioteca de gerenciamento de mídia mais robusta para necessidades futuras 