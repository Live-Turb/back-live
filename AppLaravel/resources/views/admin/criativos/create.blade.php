@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Adicionar Novo Criativo</h1>
        </div>
        <div class="col-auto">
            @if(isset($anuncioId) || request()->has('anuncio_id'))
            <a href="{{ route('admin.anuncios.edit', $anuncioId ?? request()->anuncio_id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar para o Anúncio
            </a>
            @else
            <a href="{{ route('admin.criativos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            @endif
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
            <h5 class="mb-0">Formulário de Criativo</h5>
        </div>
        <div class="card-body">
            @if(isset($anuncios) && $anuncios->isEmpty())
            <div class="alert alert-warning" role="alert">
                <h5><i class="fas fa-exclamation-triangle me-2"></i> Não existem anúncios cadastrados!</h5>
                <p class="mb-0">É necessário ter pelo menos um anúncio para cadastrar criativos.</p>
                <div class="mt-3">
                    <a href="{{ route('admin.anuncios.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus-circle me-1"></i> Criar Anúncio
                    </a>
                    <a href="{{ route('admin.anuncios.teste') }}" class="btn btn-outline-primary">
                        <i class="fas fa-magic me-1"></i> Criar Anúncios de Teste
                    </a>
                </div>
            </div>
            @else
            <form action="{{ route('admin.criativos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($anuncio))
                <!-- Se temos um anúncio específico, mostramos em um campo somente leitura -->
                <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Anúncio Selecionado</label>
                            <div class="form-control bg-light">
                                {{ $anuncio->titulo }} [ID: {{ $anuncio->id }}]
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(isset($anuncioId))
                <!-- Se temos apenas o ID do anúncio, também usamos um campo oculto -->
                <input type="hidden" name="anuncio_id" value="{{ $anuncioId }}">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Anúncio Selecionado</label>
                            <div class="form-control bg-light">
                                Anúncio #{{ $anuncioId }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Caso contrário, mostramos o dropdown de seleção de anúncio -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="anuncio_id" class="form-label">Anúncio <span class="text-danger">*</span></label>
                            <select class="form-select @error('anuncio_id') is-invalid @enderror" id="anuncio_id" name="anuncio_id" required>
                                <option value="">Selecione o anúncio...</option>
                                @foreach($anuncios as $anuncioItem)
                                <option value="{{ $anuncioItem->id }}" {{ old('anuncio_id') == $anuncioItem->id ? 'selected' : '' }}>
                                    {{ $anuncioItem->titulo }} [ID: {{ $anuncioItem->id }}]
                                </option>
                                @endforeach
                            </select>
                            @error('anuncio_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <small class="text-muted">(opcional)</small></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" maxlength="100" placeholder="Deixe em branco para gerar automaticamente como 'Criativo N'">
                            <small class="text-muted">Máximo 100 caracteres. Se deixado em branco, será gerado automaticamente como "Criativo 1", "Criativo 2", etc.</small>
                            @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="platform" class="form-label">Plataformas <span class="text-danger">*</span></label>
                            <div class="border rounded p-3 @error('platform') border-danger @enderror">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Facebook" name="platform[]" id="platform_facebook" {{ (is_array(old('platform')) && in_array('Facebook', old('platform'))) ? 'checked' : 'checked' }}>
                                    <label class="form-check-label" for="platform_facebook">
                                        Facebook
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Instagram" name="platform[]" id="platform_instagram" {{ (is_array(old('platform')) && in_array('Instagram', old('platform'))) ? 'checked' : 'checked' }}>
                                    <label class="form-check-label" for="platform_instagram">
                                        Instagram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Google" name="platform[]" id="platform_google" {{ (is_array(old('platform')) && in_array('Google', old('platform'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_google">
                                        Google
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="TikTok" name="platform[]" id="platform_tiktok" {{ (is_array(old('platform')) && in_array('TikTok', old('platform'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_tiktok">
                                        TikTok
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="YouTube" name="platform[]" id="platform_youtube" {{ (is_array(old('platform')) && in_array('YouTube', old('platform'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_youtube">
                                        YouTube
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Outra" name="platform[]" id="platform_outra" {{ (is_array(old('platform')) && in_array('Outra', old('platform'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_outra">
                                        Outra
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted">Selecione uma ou mais plataformas (Facebook e Instagram já vêm pré-selecionados por padrão)</small>
                            @error('platform')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idioma" class="form-label">Idioma do Criativo <span class="text-danger">*</span></label>
                            <select class="form-select @error('idioma') is-invalid @enderror" id="idioma" name="idioma" required onchange="document.getElementById('language').value = this.value;">
                                <option value="">Selecione o idioma...</option>
                                <option value="PT-BR" {{ old('idioma') == 'PT-BR' ? 'selected' : '' }}>Português (Brasil)</option>
                                <option value="EN-US" {{ old('idioma') == 'EN-US' ? 'selected' : '' }}>Inglês (EUA)</option>
                                <option value="ES" {{ old('idioma') == 'ES' ? 'selected' : '' }}>Espanhol</option>
                                <option value="FR" {{ old('idioma') == 'FR' ? 'selected' : '' }}>Francês</option>
                                <option value="DE" {{ old('idioma') == 'DE' ? 'selected' : '' }}>Alemão</option>
                                <option value="IT" {{ old('idioma') == 'IT' ? 'selected' : '' }}>Italiano</option>
                            </select>
                            @error('idioma')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="hidden" id="language" name="language" value="{{ old('idioma') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Selecione o status...</option>
                                <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="creativeId" class="form-label">ID do Criativo</label>
                            <input type="text" class="form-control @error('creativeId') is-invalid @enderror" id="creativeId" name="creativeId" value="{{ old('creativeId') }}">
                            @error('creativeId')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL do Criativo <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" required>
                            <small class="text-muted">URL do vídeo para reprodução no player. Para vídeos, use URLs terminadas em .mp4</small>
                            @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="value" class="form-label">Número de Criativos</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', 0) }}" min="0">
                            </div>
                            <small class="text-muted">Quantidade total de criativos ativos. Este número é usado para calcular o desempenho do criativo.</small>
                            @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagem do Criativo</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="caption" class="form-label">Legenda/Descrição</label>
                            <textarea class="form-control @error('caption') is-invalid @enderror" id="caption" name="caption" rows="4">{{ old('caption') }}</textarea>
                            @error('caption')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <div class="form-check d-inline-block me-3">
                            <input class="form-check-input" type="checkbox" id="continuar_adicionando" name="continuar_adicionando" value="1" checked>
                            <label class="form-check-label" for="continuar_adicionando">
                                Continuar adicionando criativos
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Criativo
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
