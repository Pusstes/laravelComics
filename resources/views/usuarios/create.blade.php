@extends('layouts.app', ['title' => 'Nuevo Usuario'])

@section('content')
<div class="container-fluid py-4">
    <!-- Header con estilo de cómic -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body d-flex align-items-center p-4" 
                     style="background-image: url('/assets/images/comic-header-bg.jpg'); background-size: cover; background-position: center;">
                    <div class="comic-bubble me-3">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                    <h1 class="m-0 text-uppercase fw-bold" style="text-shadow: 3px 3px 0px #000, -1px -1px 0px #ff4500;">
                        Nuevo Usuario
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white p-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-plus me-2"></i>REGISTRO DE USUARIO
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre" class="form-label fw-bold">
                                        <i class="fas fa-user text-primary me-1"></i>Nombre Completo
                                    </label>
                                    <input type="text" class="form-control border-primary" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="fas fa-envelope text-primary me-1"></i>Correo Electrónico
                                    </label>
                                    <input type="email" class="form-control border-primary" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-label fw-bold">
                                        <i class="fas fa-phone-alt text-primary me-1"></i>Teléfono
                                    </label>
                                    <input type="tel" class="form-control border-primary" id="telefono" name="telefono" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i>Dirección
                                    </label>
                                    <input type="text" class="form-control border-primary" id="direccion" name="direccion" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label fw-bold">
                                        <i class="fas fa-lock text-primary me-1"></i>Contraseña
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control border-primary" id="password" name="password" required>
                                        <button class="btn btn-outline-primary toggle-password" type="button" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label fw-bold">
                                        <i class="fas fa-lock text-primary me-1"></i>Confirmar Contraseña
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control border-primary" id="password_confirmation" 
                                               name="password_confirmation" required>
                                        <button class="btn btn-outline-primary toggle-password" type="button" data-target="password_confirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
    .comic-bubble {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #ff4500;
        color: white;
        border-radius: 50%;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .comic-bubble:after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: -5px;
        width: 15px;
        height: 15px;
        background-color: #ff4500;
        transform: rotate(45deg);
    }
    
    /* Animaciones para botones */
    .btn {
        transition: all 0.3s;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    /* Estilo para campos de formulario */
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        border-color: #0d6efd;
    }
</style>

<!-- Script para mostrar/ocultar contraseña -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.querySelector('i').classList.remove('fa-eye');
                this.querySelector('i').classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.querySelector('i').classList.remove('fa-eye-slash');
                this.querySelector('i').classList.add('fa-eye');
            }
        });
    });
});
</script>
@endsection