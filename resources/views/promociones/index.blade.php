@extends('layouts.app', ['title' => 'Promociones'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="fas fa-percentage me-2"></i>Promociones
    </h1>
    <a href="{{ route('promociones.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Nueva Promoción
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Descuento</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promociones as $promocion)
                    <tr>
                        <td>{{ $productosMap[$promocion['id_producto']] ?? 'N/A' }}</td>
                        <td>{{ $promocion['descuento'] }}%</td>
                        <td>{{ \Carbon\Carbon::parse($promocion['fecha_inicio'])->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($promocion['fecha_fin'])->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('promociones.edit', $promocion['id']) }}" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('promociones.destroy', $promocion['id']) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay promociones registradas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection