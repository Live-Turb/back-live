@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Editar Criativo</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.anuncios.edit', $criativo->anuncio_id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar para o Anúncio
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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Formulário de Edição</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.criativos.update', $criativo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="anuncio_id" value="{{ $criativo->anuncio_id }}">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $criativo->titulo) }}" required maxlength="100">
                            <small class="text-muted">Máximo 100 caracteres</small>
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
                                @php
                                    // Garantir que platform seja tratado como array
                                    $platformArray = old('platform', $criativo->platform ?? []);
                                    if (!is_array($platformArray)) {
                                        $platformArray = [$platformArray];
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Facebook" name="platform[]" id="platform_facebook" 
                                        {{ in_array('Facebook', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_facebook">
                                        Facebook
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Instagram" name="platform[]" id="platform_instagram" 
                                        {{ in_array('Instagram', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_instagram">
                                        Instagram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Google" name="platform[]" id="platform_google" 
                                        {{ in_array('Google', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_google">
                                        Google
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="TikTok" name="platform[]" id="platform_tiktok" 
                                        {{ in_array('TikTok', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_tiktok">
                                        TikTok
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="YouTube" name="platform[]" id="platform_youtube" 
                                        {{ in_array('YouTube', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_youtube">
                                        YouTube
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Outra" name="platform[]" id="platform_outra" 
                                        {{ in_array('Outra', $platformArray) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platform_outra">
                                        Outra
                                    </label>
                                </div>
                            </div>
                            <small class="text-muted">Selecione uma ou mais plataformas</small>
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
                                <option value="PT-BR" {{ old('idioma', $criativo->idioma ?? '') == 'PT-BR' ? 'selected' : '' }}>Português (Brasil)</option>
                                <option value="EN-US" {{ old('idioma', $criativo->idioma ?? '') == 'EN-US' ? 'selected' : '' }}>Inglês (EUA)</option>
                                <option value="ES" {{ old('idioma', $criativo->idioma ?? '') == 'ES' ? 'selected' : '' }}>Espanhol</option>
                                <option value="FR" {{ old('idioma', $criativo->idioma ?? '') == 'FR' ? 'selected' : '' }}>Francês</option>
                                <option value="DE" {{ old('idioma', $criativo->idioma ?? '') == 'DE' ? 'selected' : '' }}>Alemão</option>
                                <option value="IT" {{ old('idioma', $criativo->idioma ?? '') == 'IT' ? 'selected' : '' }}>Italiano</option>
                            </select>
                            @error('idioma')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <input type="hidden" id="language" name="language" value="{{ old('idioma', $criativo->idioma ?? $criativo->language ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Selecione o status...</option>
                                <option value="ativo" {{ old('status', $criativo->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ old('status', $criativo->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="creativeId" class="form-label">ID do Criativo</label>
                            <input type="text" class="form-control @error('creativeId') is-invalid @enderror" id="creativeId" name="creativeId" value="{{ old('creativeId', $criativo->creativeId) }}">
                            @error('creativeId')
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

                            @if($criativo->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $criativo->image) }}" alt="{{ $criativo->titulo }}" class="img-thumbnail" style="max-height: 100px;">
                                <small class="text-muted d-block mt-1">Imagem atual</small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL do Criativo <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $criativo->url ?? '') }}" required>
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
                                <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', (int)($criativo->value ?? 0)) }}" min="0">
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
                            <label class="form-label">Status de Performance</label>
                            <div class="form-control bg-light">
                                @if($criativo->performance_status)
                                    <span class="badge bg-{{ $criativo->performance_status == 'Ativo' ? 'success' : 'warning' }}">
                                        {{ $criativo->performance_status }}
                                    </span>
                                @else
                                    <span class="text-muted">Não calculado</span>
                                @endif
                            </div>
                            <small class="text-muted">
                                Status baseado no número de criativos e novos criativos
                                @if($criativo->last_status_change)
                                    <br>Última atualização: {{ $criativo->last_status_change->format('d/m/Y H:i') }}
                                @endif
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Atualizar Criativo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
