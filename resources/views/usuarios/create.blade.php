@extends('layouts.app', ['title' => 'Nuevo Usuario'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 py-3 px-4 d-flex align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>Registrar Nuevo Usuario
                </h4>
            </div>
            <div class="card-body p-4 bg-light">
                <form id="formUsuario" action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="nombre" class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="nombre" name="nombre" placeholder="Nombre y apellidos">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="email" name="email" placeholder="ejemplo@correo.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="telefono" name="telefono" placeholder="123-456-7890">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="direccion" class="form-label fw-semibold">Dirección</label>
                            <input type="text" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="direccion" name="direccion" placeholder="Calle, Ciudad, Estado">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <input type="password" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="password" name="password">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input type="password" class="form-control form-control-lg rounded-pill shadow-sm"
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    {{-- @if(auth()->user()['role'] === 'Administrador')
                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold">Rol</label>
                        <select class="form-select rounded-pill shadow-sm" id="role" name="role">
                            <option value="" disabled selected>Seleccione un rol</option>
                            <option value="Cliente">Cliente</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    @endif
                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold">Rol</label>
                        <select class="form-select rounded-pill shadow-sm" id="role" name="role">
                            <option value="" disabled selected>Seleccione un rol</option>
                            <option value="Cliente">Cliente</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div> --}}
                    <div class="d-flex justify-content-end mt-4 gap-3">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm" onclick="confirmCancel(event)">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="fas fa-save me-1"></i>Guardar Usuario
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
    document.getElementById('formUsuario').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenimos el envío del formulario por defecto

        const nombre = document.getElementById('nombre').value.trim();
        const email = document.getElementById('email').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const direccion = document.getElementById('direccion').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        // Verificar campos obligatorios
        if (nombre === "" || email === "" || telefono === "" || direccion === "" || password === "" || passwordConfirmation === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor, completa todos los campos obligatorios.',
                confirmButtonColor: '#f0ad4e'
            });
            return;
        }

        if (password !== passwordConfirmation) {
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas no coinciden',
                text: 'Por favor, verifica que las contraseñas sean iguales.',
                confirmButtonColor: '#d33'
            });
            return;
        }

        // Mostrar confirmación con los datos a registrar
        Swal.fire({
            title: '¿Confirmar registro de usuario?',
            html: `
                <div class="text-start">
                    <p><strong>Nombre:</strong> ${nombre}</p>
                    <p><strong>Email:</strong> ${email}</p>
                    <p><strong>Teléfono:</strong> ${telefono}</p>
                    <p><strong>Dirección:</strong> ${direccion}</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, registrar usuario',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si confirma, enviamos el formulario
                document.getElementById('formUsuario').submit();
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
                window.location.href = "{{ route('usuarios.index') }}";
            }
        });
    }
</script>
@endsection
