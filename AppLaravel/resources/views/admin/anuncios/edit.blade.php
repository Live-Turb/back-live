@extends('layouts.app')

<!-- CSRF Token para requisições AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Editar Anúncio</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.anuncios.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

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

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Formulário de Edição</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.anuncios.update', $anuncio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Informações Básicas</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $anuncio->titulo) }}" required>
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
                                <option value="ESCALANDO" {{ old('tag_principal', $anuncio->tag_principal) === 'ESCALANDO' ? 'selected' : '' }}>ESCALANDO</option>
                                <option value="TESTE" {{ old('tag_principal', $anuncio->tag_principal) === 'TESTE' ? 'selected' : '' }}>TESTE</option>
                                <option value="PAUSADO" {{ old('tag_principal', $anuncio->tag_principal) === 'PAUSADO' ? 'selected' : '' }}>PAUSADO</option>
                                <option value="RECEM ADICIONADO" {{ old('tag_principal', $anuncio->tag_principal) === 'RECEM ADICIONADO' ? 'selected' : '' }}>Recém Adicionado</option>
                                <option value="EVOLUINDO RAPIDO" {{ old('tag_principal', $anuncio->tag_principal) === 'EVOLUINDO RAPIDO' ? 'selected' : '' }}>Evoluindo Rápido</option>
                                <option value="OPORTUNIDADE RAPIDA" {{ old('tag_principal', $anuncio->tag_principal) === 'OPORTUNIDADE RAPIDA' ? 'selected' : '' }}>Oportunidade Rápida</option>
                                <option value="ATIVA" {{ old('tag_principal', $anuncio->tag_principal) === 'ATIVA' ? 'selected' : '' }}>Ativa</option>
                            </select>
                            @error('tag_principal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="data_anuncio" class="form-label">Data <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('data_anuncio') is-invalid @enderror" id="data_anuncio" name="data_anuncio" value="{{ old('data_anuncio', $anuncio->data_anuncio->format('Y-m-d')) }}" required>
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
                            <input type="text" class="form-control @error('nicho') is-invalid @enderror" id="nicho" name="nicho" value="{{ old('nicho', $anuncio->nicho) }}" required>
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
                                <option value="{{ $codigo }}" {{ old('pais_codigo', $anuncio->pais_codigo) === $codigo ? 'selected' : '' }}>{{ $nome }}</option>
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
                                <option value="Ativo" {{ old('status', $anuncio->status) === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Inativo" {{ old('status', $anuncio->status) === 'Inativo' ? 'selected' : '' }}>Inativo</option>
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
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', is_array($anuncio->tags) ? implode(', ', $anuncio->tags) : '') }}" placeholder="Separe as tags por vírgula">
                            @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Exemplo: tag1, tag2, tag3</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="novo_anuncio" name="novo_anuncio" value="1" {{ old('novo_anuncio', $anuncio->novo_anuncio) ? 'checked' : '' }}>
                            <label class="form-check-label" for="novo_anuncio">Novo Anúncio</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="destaque" name="destaque" value="1" {{ old('destaque', $anuncio->destaque) ? 'checked' : '' }}>
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

                            @if($anuncio->imagem)
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
                            @endif
                            <div class="form-text mt-2">
                                <ul class="mb-0 ps-3">
                                    <li>Para <strong>substituir</strong> a imagem atual, selecione um novo arquivo acima.</li>
                                    <li>Para <strong>remover</strong> a imagem sem substituir, clique no botão "Remover Imagem".</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="url_video" class="form-label">URL do Vídeo</label>
                            <input type="url" class="form-control @error('url_video') is-invalid @enderror" id="url_video" name="url_video" value="{{ old('url_video', $anuncio->url_video) }}">
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
                            <input type="url" class="form-control @error('link_transcricao') is-invalid @enderror" id="link_transcricao" name="link_transcricao" value="{{ old('link_transcricao', $anuncio->link_transcricao) }}" placeholder="https://exemplo.com/documento">
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
                        <h5 class="border-bottom pb-2">Estatísticas</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="variacao_diaria" class="form-label">Variação Diária (número absoluto de anúncios)</label>
                            <input type="number" step="1" class="form-control @error('variacao_diaria') is-invalid @enderror" id="variacao_diaria" name="variacao_diaria" value="{{ old('variacao_diaria', $anuncio->variacao_diaria) }}" placeholder="Ex: 5 para aumento de 5 anúncios, -3 para redução de 3 anúncios">
                            @error('variacao_diaria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="variacao_semanal" class="form-label">Variação Semanal (número absoluto de anúncios)</label>
                            <input type="number" step="1" class="form-control @error('variacao_semanal') is-invalid @enderror" id="variacao_semanal" name="variacao_semanal" value="{{ old('variacao_semanal', $anuncio->variacao_semanal) }}" placeholder="Ex: 10 para aumento de 10 anúncios, -5 para redução de 5 anúncios">
                            @error('variacao_semanal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="numero_anuncios" class="form-label">Número de Anúncios</label>
                            <input type="number" min="0" class="form-control @error('numero_anuncios') is-invalid @enderror" id="numero_anuncios" name="numero_anuncios" value="{{ old('numero_anuncios', $anuncio->numero_anuncios) }}">
                            @error('numero_anuncios')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Quantidade total de anúncios associados</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="numero_criativos" class="form-label">Número de Criativos</label>
                            <input type="number" class="form-control" id="numero_criativos" value="{{ $anuncio->numero_criativos }}" disabled>
                            <small class="text-muted">Atualizado automaticamente</small>
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
                                <option value="Infoproduto" {{ old('produto_tipo', $anuncio->produto_tipo) === 'Infoproduto' ? 'selected' : '' }}>Infoproduto</option>
                                <option value="Produto Físico" {{ old('produto_tipo', $anuncio->produto_tipo) === 'Produto Físico' ? 'selected' : '' }}>Produto Físico</option>
                                <option value="Serviço" {{ old('produto_tipo', $anuncio->produto_tipo) === 'Serviço' ? 'selected' : '' }}>Serviço</option>
                                <option value="Assinatura" {{ old('produto_tipo', $anuncio->produto_tipo) === 'Assinatura' ? 'selected' : '' }}>Assinatura</option>
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
                                <option value="VSL" {{ old('produto_estrutura', $anuncio->produto_estrutura) === 'VSL' ? 'selected' : '' }}>VSL</option>
                                <option value="PLR" {{ old('produto_estrutura', $anuncio->produto_estrutura) === 'PLR' ? 'selected' : '' }}>PLR</option>
                                <option value="Webinar" {{ old('produto_estrutura', $anuncio->produto_estrutura) === 'Webinar' ? 'selected' : '' }}>Webinar</option>
                                <option value="Carta de Vendas" {{ old('produto_estrutura', $anuncio->produto_estrutura) === 'Carta de Vendas' ? 'selected' : '' }}>Carta de Vendas</option>
                            </select>
                            @error('produto_estrutura')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_idioma" class="form-label">Idioma <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('produto_idioma') is-invalid @enderror" id="produto_idioma" name="produto_idioma" value="{{ old('produto_idioma', $anuncio->produto_idioma) }}" required>
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
                            <input type="text" class="form-control @error('produto_rede_trafego') is-invalid @enderror" id="produto_rede_trafego" name="produto_rede_trafego" value="{{ old('produto_rede_trafego', $anuncio->produto_rede_trafego) }}" required>
                            @error('produto_rede_trafego')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="produto_funil_vendas" class="form-label">Funil de Vendas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('produto_funil_vendas') is-invalid @enderror" id="produto_funil_vendas" name="produto_funil_vendas" value="{{ old('produto_funil_vendas', $anuncio->produto_funil_vendas) }}" required>
                            @error('produto_funil_vendas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                            <input type="url" class="form-control @error('link_pagina_anuncio') is-invalid @enderror" id="link_pagina_anuncio" name="link_pagina_anuncio" value="{{ old('link_pagina_anuncio', $anuncio->link_pagina_anuncio) }}">
                            @error('link_pagina_anuncio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_criativos_fb" class="form-label">Link dos Criativos do Facebook</label>
                            <input type="url" class="form-control @error('link_criativos_fb') is-invalid @enderror" id="link_criativos_fb" name="link_criativos_fb" value="{{ old('link_criativos_fb', $anuncio->link_criativos_fb) }}">
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
                            <input type="url" class="form-control @error('link_anuncios_escalados') is-invalid @enderror" id="link_anuncios_escalados" name="link_anuncios_escalados" value="{{ old('link_anuncios_escalados', $anuncio->link_anuncios_escalados) }}">
                            @error('link_anuncios_escalados')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="link_site_cloaker" class="form-label">Link do Site Cloaker</label>
                            <input type="url" class="form-control @error('link_site_cloaker') is-invalid @enderror" id="link_site_cloaker" name="link_site_cloaker" value="{{ old('link_site_cloaker', $anuncio->link_site_cloaker) }}">
                            @error('link_site_cloaker')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Métricas (Somente Leitura)</h5>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Contador de Anúncios</label>
                            <input type="text" class="form-control" value="{{ $anuncio->contador_anuncios }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Variação Diária</label>
                            <input type="text" class="form-control" value="{{ $anuncio->variacao_diaria }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Variação Semanal</label>
                            <input type="text" class="form-control" value="{{ $anuncio->variacao_semanal }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>

                <!-- Modal para confirmar remoção da imagem -->
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
            </form>
        </div>
    </div>

    <!-- Seção de Criativos -->
    <div class="card mt-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="criativos-tab" data-bs-toggle="tab" data-bs-target="#criativos" type="button" role="tab" aria-controls="criativos" aria-selected="true">
                        Criativos <span class="badge bg-primary">{{ $anuncio->criativos->count() }}</span>
                    </button>
                </li>
                <li class="nav-item ms-auto">
                    <a href="{{ route('admin.criativos.create', ['anuncio_id' => $anuncio->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Novo Criativo
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="criativos" role="tabpanel" aria-labelledby="criativos-tab">
                    @if($anuncio->criativos->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Nenhum criativo cadastrado para este anúncio.
                            <div class="mt-2">
                                <a href="{{ route('admin.criativos.create', ['anuncio_id' => $anuncio->id]) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-plus"></i> Adicionar Criativo
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imagem</th>
                                        <th>Título</th>
                                        <th>Plataforma</th>
                                        <th>Idioma</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anuncio->criativos as $criativo)
                                    <tr>
                                        <td>{{ $criativo->id }}</td>
                                        <td>
                                            @if($criativo->image)
                                            <img src="{{ $criativo->image }}" alt="{{ $criativo->titulo }}" class="img-thumbnail" width="50">
                                            @else
                                            <div class="text-center text-muted">
                                                <i class="fas fa-image fa-2x"></i>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $criativo->titulo }}</td>
                                        <td>
                                            @php
                                                $platforms = is_array($criativo->platform) ? $criativo->platform : [$criativo->platform];
                                            @endphp
                                            @foreach($platforms as $platform)
                                                <span class="badge bg-info me-1">{{ $platform }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $criativo->idioma }}</td>
                                        <td>
                                            <span class="badge {{ $criativo->status === 'ativo' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $criativo->status === 'ativo' ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.criativos.edit', $criativo->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.criativos.destroy', $criativo->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este criativo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.criativos.create', ['anuncio_id' => $anuncio->id]) }}" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="fas fa-plus"></i> Adicionar Criativo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
@endsection
