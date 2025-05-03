@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Criar Novo Anúncio</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.anuncios.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro!</strong> Verifique os campos abaixo:
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Formulário de Anúncio</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.anuncios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Informações Básicas</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="tag_principal" class="form-label">Tag Principal <span class="text-danger">*</span></label>
                            <select class="form-select @error('tag_principal') is-invalid @enderror" id="tag_principal" name="tag_principal" required>
                                <option value="">Selecione...</option>
                                <option value="ESCALANDO" {{ old('tag_principal') === 'ESCALANDO' ? 'selected' : '' }}>ESCALANDO</option>
                                <option value="TESTE" {{ old('tag_principal') === 'TESTE' ? 'selected' : '' }}>TESTE</option>
                                <option value="PAUSADO" {{ old('tag_principal') === 'PAUSADO' ? 'selected' : '' }}>PAUSADO</option>
                                <option value="RECEM ADICIONADO" {{ old('tag_principal') === 'RECEM ADICIONADO' ? 'selected' : '' }}>Recém Adicionado</option>
                                <option value="EVOLUINDO RAPIDO" {{ old('tag_principal') === 'EVOLUINDO RAPIDO' ? 'selected' : '' }}>Evoluindo Rápido</option>
                                <option value="OPORTUNIDADE RAPIDA" {{ old('tag_principal') === 'OPORTUNIDADE RAPIDA' ? 'selected' : '' }}>Oportunidade Rápida</option>
                                <option value="ATIVA" {{ old('tag_principal') === 'ATIVA' ? 'selected' : '' }}>Ativa</option>
                            </select>
                            @error('tag_principal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="data_anuncio" class="form-label">Data <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('data_anuncio') is-invalid @enderror" id="data_anuncio" name="data_anuncio" value="{{ old('data_anuncio') }}" required>
                            @error('data_anuncio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nicho" class="form-label">Nicho <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nicho') is-invalid @enderror" id="nicho" name="nicho" value="{{ old('nicho') }}" required>
                            @error('nicho')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="pais_codigo" class="form-label">País <span class="text-danger">*</span></label>
                            <select class="form-select @error('pais_codigo') is-invalid @enderror" id="pais_codigo" name="pais_codigo" required>
                                <option value="">Selecione...</option>
                                @foreach($paises as $codigo => $nome)
                                <option value="{{ $codigo }}" {{ old('pais_codigo') === $codigo ? 'selected' : '' }}>{{ $nome }}</option>
                                @endforeach
                            </select>
                            @error('pais_codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Selecione...</option>
                                <option value="Ativo" {{ old('status') === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Inativo" {{ old('status') === 'Inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags') }}" placeholder="Separe as tags por vírgula">
                            @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Exemplo: tag1, tag2, tag3</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="novo_anuncio" name="novo_anuncio" value="1" {{ old('novo_anuncio') ? 'checked' : '' }}>
                            <label class="form-check-label" for="novo_anuncio">Novo Anúncio</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="destaque" name="destaque" value="1" {{ old('destaque') ? 'checked' : '' }}>
                            <label class="form-check-label" for="destaque">Destaque</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="imagem" class="form-label">Imagem</label>
                            <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem">
                            @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="url_video" class="form-label">URL do Vídeo</label>
                            <input type="url" class="form-control @error('url_video') is-invalid @enderror" id="url_video" name="url_video" value="{{ old('url_video') }}">
                            @error('url_video')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="link_transcricao" class="form-label">Link da Transcrição</label>
                            <input type="url" class="form-control @error('link_transcricao') is-invalid @enderror" id="link_transcricao" name="link_transcricao" value="{{ old('link_transcricao') }}" placeholder="https://exemplo.com/documento">
                            <small class="form-text text-muted">
                                Insira o link para o documento Word (OneDrive, Google Drive, Office Online ou MinIO)
                            </small>
                            @error('link_transcricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Informações do Produto</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="produto_tipo" class="form-label">Tipo de Produto <span class="text-danger">*</span></label>
                            <select class="form-select @error('produto_tipo') is-invalid @enderror" id="produto_tipo" name="produto_tipo" required>
                                <option value="">Selecione...</option>
                                <option value="Infoproduto" {{ old('produto_tipo') === 'Infoproduto' ? 'selected' : '' }}>Infoproduto</option>
                                <option value="Produto Físico" {{ old('produto_tipo') === 'Produto Físico' ? 'selected' : '' }}>Produto Físico</option>
                                <option value="Serviço" {{ old('produto_tipo') === 'Serviço' ? 'selected' : '' }}>Serviço</option>
                                <option value="Assinatura" {{ old('produto_tipo') === 'Assinatura' ? 'selected' : '' }}>Assinatura</option>
                            </select>
                            @error('produto_tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="produto_estrutura" class="form-label">Estrutura <span class="text-danger">*</span></label>
                            <select class="form-select @error('produto_estrutura') is-invalid @enderror" id="produto_estrutura" name="produto_estrutura" required>
                                <option value="">Selecione...</option>
                                <option value="VSL" {{ old('produto_estrutura') === 'VSL' ? 'selected' : '' }}>VSL</option>
                                <option value="PLR" {{ old('produto_estrutura') === 'PLR' ? 'selected' : '' }}>PLR</option>
                                <option value="Webinar" {{ old('produto_estrutura') === 'Webinar' ? 'selected' : '' }}>Webinar</option>
                                <option value="Carta de Vendas" {{ old('produto_estrutura') === 'Carta de Vendas' ? 'selected' : '' }}>Carta de Vendas</option>
                            </select>
                            @error('produto_estrutura')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_idioma" class="form-label">Idioma <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('produto_idioma') is-invalid @enderror" id="produto_idioma" name="produto_idioma" value="{{ old('produto_idioma') }}" required>
                            @error('produto_idioma')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_rede_trafego" class="form-label">Rede de Tráfego <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('produto_rede_trafego') is-invalid @enderror" id="produto_rede_trafego" name="produto_rede_trafego" value="{{ old('produto_rede_trafego') }}" required>
                            @error('produto_rede_trafego')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_funil_vendas" class="form-label">Funil de Vendas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('produto_funil_vendas') is-invalid @enderror" id="produto_funil_vendas" name="produto_funil_vendas" value="{{ old('produto_funil_vendas') }}" required>
                            @error('produto_funil_vendas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Estatísticas</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="variacao_diaria" class="form-label">Variação Diária (número absoluto de anúncios)</label>
                            <input type="number" step="1" class="form-control @error('variacao_diaria') is-invalid @enderror" id="variacao_diaria" name="variacao_diaria" value="{{ old('variacao_diaria', 0) }}" placeholder="Ex: 5 para aumento de 5 anúncios, -3 para redução de 3 anúncios">
                            @error('variacao_diaria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="variacao_semanal" class="form-label">Variação Semanal (número absoluto de anúncios)</label>
                            <input type="number" step="1" class="form-control @error('variacao_semanal') is-invalid @enderror" id="variacao_semanal" name="variacao_semanal" value="{{ old('variacao_semanal', 0) }}" placeholder="Ex: 10 para aumento de 10 anúncios, -5 para redução de 5 anúncios">
                            @error('variacao_semanal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="numero_anuncios" class="form-label">Número de Anúncios</label>
                            <input type="number" min="0" class="form-control @error('numero_anuncios') is-invalid @enderror" id="numero_anuncios" name="numero_anuncios" value="{{ old('numero_anuncios', 0) }}">
                            @error('numero_anuncios')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Quantidade total de anúncios associados</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="numero_criativos" class="form-label">Número de Criativos</label>
                            <input type="number" class="form-control" id="numero_criativos" value="0" disabled>
                            <small class="text-muted">Atualizado automaticamente</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Links</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_pagina_anuncio" class="form-label">Link da Página de Anúncio</label>
                            <input type="url" class="form-control @error('link_pagina_anuncio') is-invalid @enderror" id="link_pagina_anuncio" name="link_pagina_anuncio" value="{{ old('link_pagina_anuncio') }}">
                            @error('link_pagina_anuncio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_criativos_fb" class="form-label">Link dos Criativos do Facebook</label>
                            <input type="url" class="form-control @error('link_criativos_fb') is-invalid @enderror" id="link_criativos_fb" name="link_criativos_fb" value="{{ old('link_criativos_fb') }}">
                            @error('link_criativos_fb')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_anuncios_escalados" class="form-label">Link dos Anúncios Escalados</label>
                            <input type="url" class="form-control @error('link_anuncios_escalados') is-invalid @enderror" id="link_anuncios_escalados" name="link_anuncios_escalados" value="{{ old('link_anuncios_escalados') }}">
                            @error('link_anuncios_escalados')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_site_cloaker" class="form-label">Link do Site Cloaker</label>
                            <input type="url" class="form-control @error('link_site_cloaker') is-invalid @enderror" id="link_site_cloaker" name="link_site_cloaker" value="{{ old('link_site_cloaker') }}">
                            @error('link_site_cloaker')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Anúncio
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Inicializar os inputs de data
    document.addEventListener('DOMContentLoaded', function() {
        const dataAnuncioInput = document.getElementById('data_anuncio');
        if (!dataAnuncioInput.value) {
            // Definir a data atual como padrão
            const dataAtual = new Date().toISOString().split('T')[0];
            dataAnuncioInput.value = dataAtual;
        }
    });
</script>
@endsection
