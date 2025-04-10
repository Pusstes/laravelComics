@extends('layouts.app', ['title' => 'Editar Usuario'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-user-edit me-2"></i>
                <h5 class="mb-0">Editar Usuario</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.update', $usuario['id']) }}" method="POST" novalidate onsubmit="return confirmSubmit(event)">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="contrasena" value=""> <!-- Valor predeterminado vacío -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control rounded-pill shadow-sm" id="nombre" name="nombre"
                                   value="{{ $usuario['nombre'] }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control rounded-pill shadow-sm" id="email" name="email"
                                   value="{{ $usuario['email'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control rounded-pill shadow-sm" id="telefono" name="telefono"
                                   value="{{ $usuario['telefono'] }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control rounded-pill shadow-sm" id="direccion" name="direccion"
                                   value="{{ $usuario['direccion'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contrasena_nueva" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control rounded-pill shadow-sm" id="contrasena_nueva" name="contrasena_nueva">
                            <small class="text-muted">Deja en blanco para mantener la contraseña actual</small>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control rounded-pill shadow-sm" id="password_confirmation"
                                   name="password_confirmation">
                        </div> --}}
                    </div>
                    {{-- @if(auth()->user()['role'] === 'Administrador')
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select rounded-pill shadow-sm" id="role" name="role" required>
                            <option value="Cliente" {{ $usuario['role'] === 'Cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="Administrador" {{ $usuario['role'] === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                    @endif --}}
                    {{-- <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select rounded-pill shadow-sm" id="role" name="role" required>
                            <option value="Cliente" {{ $usuario['role'] === 'Cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="Administrador" {{ $usuario['role'] === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div> --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary rounded-pill" onclick="confirmCancel(event)">
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
                window.location.href = "{{ route('usuarios.index') }}";
            }
        });
    }

    // Confirmación para guardar cambios
    function confirmSubmit(event) {
        event.preventDefault();

        // Obtenemos los valores actuales del formulario
        const nombre = document.getElementById('nombre').value.trim();
        const email = document.getElementById('email').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const direccion = document.getElementById('direccion').value.trim();
        const contrasenaNueva = document.getElementById('contrasena_nueva').value;

        // Si hay contraseña nueva, la asignamos al campo oculto
        if (contrasenaNueva) {
            document.querySelector('input[name="contrasena"]').value = contrasenaNueva;
        }

        // Mostramos la confirmación con los datos a actualizar
        Swal.fire({
            title: '¿Guardar cambios?',
            html: `
                <div class="text-start">
                    <p><strong>Nombre:</strong> ${nombre}</p>
                    <p><strong>Email:</strong> ${email}</p>
                    <p><strong>Teléfono:</strong> ${telefono}</p>
                    <p><strong>Dirección:</strong> ${direccion}</p>
                    <p><strong>Contraseña:</strong> ${contrasenaNueva ? 'Se actualizará la contraseña' : 'No se modificará'}</p>
                </div>
                <p class="mt-3">¡Verifica que toda la información sea correcta!</p>
            `,
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
