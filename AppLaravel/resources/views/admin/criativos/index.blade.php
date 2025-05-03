@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Gerenciar Criativos</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.criativos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Criativo
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

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filtros</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.criativos.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="mb-0">
                        <label for="search" class="form-label">Buscar por título</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-0">
                        <label for="platform" class="form-label">Plataforma</label>
                        <select class="form-select" id="platform" name="platform">
                            <option value="">Todas</option>
                            <option value="Facebook" {{ request('platform') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="Instagram" {{ request('platform') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="Google" {{ request('platform') == 'Google' ? 'selected' : '' }}>Google</option>
                            <option value="TikTok" {{ request('platform') == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                            <option value="YouTube" {{ request('platform') == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                            <option value="Outra" {{ request('platform') == 'Outra' ? 'selected' : '' }}>Outra</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-0">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-0 d-flex h-100 align-items-end">
                        <div class="d-grid gap-2 w-100">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Título</th>
                            <th scope="col">Anúncio</th>
                            <th scope="col">Plataforma</th>
                            <th scope="col">Status</th>
                            <th scope="col">Criativos</th>
                            <th scope="col" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($criativos as $criativo)
                        <tr>
                            <td>{{ $criativo->id }}</td>
                            <td style="width: 80px">
                                @if($criativo->image)
                                <img src="{{ $criativo->image }}" alt="{{ $criativo->titulo }}" class="img-thumbnail" width="60">
                                @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-medium">{{ $criativo->titulo }}</div>
                                <div class="small text-muted">ID: {{ $criativo->creativeId ?: 'N/A' }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.anuncios.edit', $criativo->anuncio_id) }}" class="text-decoration-none">
                                    {{ $criativo->anuncio->titulo ?? 'Anúncio não encontrado' }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $platforms = is_array($criativo->platform) ? $criativo->platform : [$criativo->platform];
                                @endphp
                                @foreach($platforms as $platform)
                                    <span class="badge bg-info me-1">{{ $platform }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge {{ $criativo->status === 'ativo' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $criativo->status === 'ativo' ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td>{{ $criativo->value }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
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
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-search me-2"></i> Nenhum criativo encontrado
                                </div>
                                @if(request()->has('search') || request()->has('platform') || request()->has('status'))
                                <div class="mt-2">
                                    <a href="{{ route('admin.criativos.index') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-times"></i> Limpar filtros
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Exibindo {{ $criativos->firstItem() ?? 0 }} a {{ $criativos->lastItem() ?? 0 }} de {{ $criativos->total() ?? 0 }} criativos
                </div>
                <div>
                    {{ $criativos->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
