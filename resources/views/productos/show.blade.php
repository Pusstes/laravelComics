@extends('layouts.app', ['title' => 'Detalle de Producto'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white d-flex align-items-center rounded-top">
                <i class="fas fa-info-circle me-2"></i>
                <h5 class="mb-0">Detalle del Producto</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        <div class="bg-light p-4 rounded-circle shadow-sm">
                            <i class="fas fa-box fa-5x text-secondary"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 class="text-dark">{{ $producto['nombre'] }}</h3>
                        <h5 class="text-primary mb-3">${{ number_format($producto['precio'], 2) }}</h5>
                        <p class="text-muted mb-4">{{ $producto['descripcion'] }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Categoría:</strong> {{ $categoriasMap[$producto['id_categoria']] ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Proveedor:</strong> {{ $proveedoresMap[$producto['id_proveedor']] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('productos.edit', $producto['id']) }}" class="btn btn-warning rounded-pill px-4">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                    <form action="{{ route('productos.destroy', $producto['id']) }}" method="POST" class="d-inline" id="delete-form-{{ $producto['id'] }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger rounded-pill px-4" onclick="confirmDelete({{ $producto['id'] }})">
                            <i class="fas fa-trash-alt me-1"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Este producto será eliminado permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviamos el formulario
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }
</script>
@endsection
