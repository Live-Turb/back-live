@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gerenciamento de Despesas</h1>
        <a href="{{ route('admin.kpi.expenses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Nova Despesa
        </a>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->title }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ getBadgeColor($expense->category) }}">
                                    {{ $expense->category }}
                                </span>
                            </td>
                            <td>R$ {{ number_format($expense->amount, 2, ',', '.') }}</td>
                            <td>{{ $expense->expense_date->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.kpi.expenses.edit', $expense) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.kpi.expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                    <p class="h5 text-muted">Nenhuma despesa registrada</p>
                                    <a href="{{ route('admin.kpi.expenses.create') }}" class="btn btn-sm btn-primary mt-3">
                                        Registrar primeira despesa
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
