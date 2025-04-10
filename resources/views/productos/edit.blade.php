@extends('layouts.app', ['title' => 'Editar Producto'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-edit me-2"></i>
                <h5 class="mb-0">Editar Producto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('productos.update', $producto['id']) }}" method="POST" novalidate onsubmit="return confirmSubmit(event)">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control rounded-pill shadow-sm" id="nombre" name="nombre"
                               value="{{ $producto['nombre'] }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control shadow-sm" id="descripcion" name="descripcion"
                                  rows="3" required>{{ $producto['descripcion'] }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-light">$</span>
                            <input type="number" step="0.01" class="form-control" id="precio"
                                   name="precio" min="0" value="{{ $producto['precio'] }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select class="form-select shadow-sm" id="id_categoria" name="id_categoria" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}"
                                        {{ $producto['id_categoria'] == $categoria['id'] ? 'selected' : '' }}>
                                        {{ $categoria['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_proveedor" class="form-label">Proveedor</label>
                            <select class="form-select shadow-sm" id="id_proveedor" name="id_proveedor" required>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor['id'] }}"
                                        {{ $producto['id_proveedor'] == $proveedor['id'] ? 'selected' : '' }}>
                                        {{ $proveedor['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary rounded-pill" onclick="confirmCancel(event)">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill">
                            <i class="fas fa-save me-1"></i>Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Confirmación para cancelar
    function confirmCancel(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Los cambios no guardados se perderán!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'Continuar editando'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('productos.index') }}";
            }
        });
    }

    // Confirmación para guardar cambios
    function confirmSubmit(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Guardar cambios?',
            text: "¡Verifica que toda la información sea correcta!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Revisar'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }

    // Mostrar alertas de sesión
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endsection
