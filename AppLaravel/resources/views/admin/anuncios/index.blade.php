@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3">Gerenciamento de Anúncios</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.anuncios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Anúncio
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.anuncios.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" value="{{ request('titulo') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tag Principal</label>
                        <select name="tag_principal" class="form-select">
                            <option value="">Todas</option>
                            <option value="ESCALANDO" {{ request('tag_principal') === 'ESCALANDO' ? 'selected' : '' }}>ESCALANDO</option>
                            <option value="TESTE" {{ request('tag_principal') === 'TESTE' ? 'selected' : '' }}>TESTE</option>
                            <option value="PAUSADO" {{ request('tag_principal') === 'PAUSADO' ? 'selected' : '' }}>PAUSADO</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Todos</option>
                            <option value="Ativo" {{ request('status') === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="Inativo" {{ request('status') === 'Inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nicho</label>
                        <input type="text" name="nicho" class="form-control" value="{{ request('nicho') }}">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="{{ route('admin.anuncios.index') }}" class="btn btn-secondary">Limpar</a>
                    </div>
                </div>
            </form>
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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Lista de Anúncios</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Tag Principal</th>
                            <th>Data</th>
                            <th>Nicho</th>
                            <th>País</th>
                            <th>Status</th>
                            <th>Criativos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anuncios as $anuncio)
                        <tr>
                            <td>{{ $anuncio->id }}</td>
                            <td>
                                @if($anuncio->imagem)
                                <img src="{{ $anuncio->imagem }}" alt="{{ $anuncio->titulo }}" class="img-thumbnail" width="50">
                                @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $anuncio->titulo }}</td>
                            <td>
                                <span class="badge {{ $anuncio->tag_principal === 'ESCALANDO' ? 'bg-success' : ($anuncio->tag_principal === 'TESTE' ? 'bg-info' : 'bg-warning') }}">
                                    {{ $anuncio->tag_principal }}
                                </span>
                            </td>
                            <td>{{ $anuncio->data_anuncio->format('d/m/Y') }}</td>
                            <td>{{ $anuncio->nicho }}</td>
                            <td>{{ $anuncio->pais_codigo }}</td>
                            <td>
                                <span class="badge {{ $anuncio->status === 'Ativo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $anuncio->status }}
                                </span>
                            </td>
                            <td>
                                {{ $anuncio->criativos->count() }}
                                <a href="{{ route('admin.criativos.index', ['anuncio_id' => $anuncio->id]) }}" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.anuncios.edit', $anuncio->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.anuncios.destroy', $anuncio->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este anúncio?')">
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
                            <td colspan="10" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-search me-2"></i> Nenhum anúncio encontrado
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $anuncios->links() }}
    </div>
</div>
@endsection
