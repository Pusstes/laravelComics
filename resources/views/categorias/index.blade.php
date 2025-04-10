
@extends('layouts.app', ['title' => 'Categorías'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">
        <i class="fas fa-tags me-2 text-primary"></i>Categorías
    </h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-success rounded-pill px-4">
        <i class="fas fa-plus me-1"></i>Agregar Nueva
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow rounded-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria['id'] }}</td>
                        <td>{{ $categoria['nombre'] }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('categorias.edit', $categoria['id']) }}" 
                                   class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('¿Estás seguro?')" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">No hay categorías registradas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
