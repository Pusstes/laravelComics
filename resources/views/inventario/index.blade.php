@extends('layouts.app', ['title' => 'Inventario'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="fas fa-boxes me-2"></i>Inventario
    </h1>
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
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventario as $item)
                    <tr>
                        <td>{{ $productosMap[$item['id_producto']] ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $item['stock'] > 0 ? 'success' : 'danger' }}">
                                {{ $item['stock'] }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('inventario.edit', $item['id']) }}" 
                                   class="btn btn-sm btn-warning" title="Ajustar Stock">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay registros de inventario</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection