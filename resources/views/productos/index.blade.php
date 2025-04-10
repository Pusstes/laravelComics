@extends('layouts.app', ['title' => 'Productos'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-primary fw-bold">
        <i class="fas fa-box-open me-2"></i>Gestión de Productos
    </h1>
    <a href="{{ route('productos.create') }}" class="btn btn-outline-primary shadow-sm rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Agregar Producto
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow rounded">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($productos as $producto)
                    <tr>
                        <td class="fw-semibold">{{ $producto['id'] }}</td>
                        <td>{{ $producto['nombre'] }}</td>
                        <td class="text-success fw-bold">${{ number_format($producto['precio'], 2) }}</td>
                        <td>{{ $categoriasMap[$producto['id_categoria']] ?? 'N/A' }}</td>
                        <td>{{ $proveedoresMap[$producto['id_proveedor']] ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('productos.show', $producto['id']) }}"
                                   class="btn btn-sm btn-outline-info rounded-circle" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto['id']) }}"
                                   class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto['id']) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                            title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center py-4">No hay productos registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
