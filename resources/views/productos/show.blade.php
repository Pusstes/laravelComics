@extends('layouts.app', ['title' => 'Detalle de Producto'])

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title">
                    <i class="fas fa-info-circle me-2"></i>Detalle del Producto
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        <div class="bg-light p-4 rounded">
                            <i class="fas fa-box fa-5x text-secondary"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $producto['nombre'] }}</h3>
                        <h5 class="text-primary">${{ number_format($producto['precio'], 2) }}</h5>
                        <p class="text-muted">{{ $producto['descripcion'] }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Categoría:</strong> {{ $producto['id_categoria'] }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Proveedor:</strong> {{ $producto['id_proveedor'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('productos.edit', $producto['id']) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Editar
                    </a>
                    <form action="{{ route('productos.destroy', $producto['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection