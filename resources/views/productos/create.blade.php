@extends('layouts.app', ['title' => 'Nuevo Producto'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 py-3 px-4 d-flex align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Producto
                </h4>
            </div>
            <div class="card-body p-4 bg-light">
                <form id="formProducto" action="{{ route('productos.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nombre" class="form-label fw-semibold">Nombre del Producto</label>
                        <input type="text" class="form-control form-control-lg rounded-pill shadow-sm"
                               id="nombre" name="nombre" placeholder="Manga one Piece #1">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                        <textarea class="form-control rounded-3 shadow-sm"
                                  id="descripcion" name="descripcion" rows="4" placeholder="Agrega una descripción clara..."></textarea>
                        <small class="text-muted">La descripción debe tener al menos 5 caracteres.</small>
                    </div>

                    <div class="mb-4">
                        <label for="precio" class="form-label fw-semibold">Precio</label>
                        <div class="input-group rounded-pill shadow-sm overflow-hidden">
                            <span class="input-group-text bg-white border-end-0">$</span>
                            <input type="number" step="0.01" class="form-control border-start-0"
                                   id="precio" name="precio" min="0" placeholder="0.00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_categoria" class="form-label fw-semibold">Categoría</label>
                            <select class="form-select rounded-pill shadow-sm" id="id_categoria" name="id_categoria">
                                <option value="" disabled selected>Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="id_proveedor" class="form-label fw-semibold">Proveedor</label>
                            <select class="form-select rounded-pill shadow-sm" id="id_proveedor" name="id_proveedor">
                                <option value="" disabled selected>Seleccione un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor['id'] }}">{{ $proveedor['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-3">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm" onclick="confirmCancel(event)">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="fas fa-save me-1"></i>Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Alertas de sesión con SweetAlert2 --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33'
    });
</script>
@endif

{{-- Validación en el cliente con SweetAlert2 --}}
<script>
    document.getElementById('formProducto').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenimos el envío del formulario por defecto

        const nombre = document.getElementById('nombre').value.trim();
        const descripcion = document.getElementById('descripcion').value.trim();
        const precio = document.getElementById('precio').value;
        const categoria = document.getElementById('id_categoria').value;
        const proveedor = document.getElementById('id_proveedor').value;
        const categoriaText = categoria ? document.getElementById('id_categoria').options[document.getElementById('id_categoria').selectedIndex].text : '';
        const proveedorText = proveedor ? document.getElementById('id_proveedor').options[document.getElementById('id_proveedor').selectedIndex].text : '';

        // Verificar si hay campos vacíos
        if (!nombre || !descripcion || !precio || categoria === null || categoria === "" || proveedor === null || proveedor === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor, completa todos los campos antes de continuar.',
                confirmButtonColor: '#f0ad4e'
            });
            return;
        }

        // Verificar longitud mínima de la descripción (5 caracteres)
        if (descripcion.length < 5) {
            Swal.fire({
                icon: 'error',
                title: 'Descripción muy corta',
                text: 'La descripción debe tener al menos 5 caracteres.',
                confirmButtonColor: '#d33'
            });
            return;
        }

        // Mostrar confirmación con los datos a registrar
        Swal.fire({
            title: '¿Confirmar registro?',
            html: `
                <div class="text-start">
                    <p><strong>Nombre:</strong> ${nombre}</p>
                    <p><strong>Descripción:</strong> ${descripcion}</p>
                    <p><strong>Precio:</strong> ${precio}</p>
                    <p><strong>Categoría:</strong> ${categoriaText}</p>
                    <p><strong>Proveedor:</strong> ${proveedorText}</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si confirma, enviamos el formulario
                document.getElementById('formProducto').submit();
            }
        });
    });

    // Confirmación para cancelar
    function confirmCancel(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Los datos ingresados se perderán!",
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
</script>
@endsection
