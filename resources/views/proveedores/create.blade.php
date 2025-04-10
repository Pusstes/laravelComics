@extends('layouts.app', ['title' => 'Nuevo Distribuidor'])

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}" class="text-decoration-none">Distribuidores</a></li>
                    <li class="breadcrumb-item active">Nuevo Distribuidor</li>
                </ol>
            </nav>
            
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-gradient-dark text-white p-4">
                    <div class="d-flex align-items-center">
                        <div class="comic-icon me-3">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="m-0 fw-bold">¡Nuevo Distribuidor de Comics!</h4>
                            <p class="m-0 opacity-75">Completa la información para agregar un nuevo distribuidor</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('proveedores.store') }}" method="POST" class="form-comic">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="nombre" class="form-label comic-label">
                                    <i class="fas fa-building me-2"></i>Nombre del Distribuidor
                                </label>
                                <input type="text" class="form-control form-control-lg bg-light" 
                                       id="nombre" name="nombre" placeholder="Ej: DC Comics Distribution" required>
                                <div class="form-text">Ingresa el nombre completo de la empresa distribuidora</div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="contacto" class="form-label comic-label">
                                    <i class="fas fa-user me-2"></i>Persona de Contacto
                                </label>
                                <input type="text" class="form-control bg-light" 
                                       id="contacto" name="contacto" placeholder="Ej: Bruce Wayne" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label comic-label">
                                    <i class="fas fa-phone-alt me-2"></i>Teléfono
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white border-0">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control bg-light" 
                                           id="telefono" name="telefono" placeholder="(+52) 555-123-4567" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="email" class="form-label comic-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white border-0">
                                        <i class="fas fa-at"></i>
                                    </span>
                                    <input type="email" class="form-control bg-light" 
                                           id="email" name="email" placeholder="contacto@distribuidor.com" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="direccion" class="form-label comic-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Dirección
                            </label>
                            <textarea class="form-control bg-light" id="direccion" name="direccion" 
                                      rows="3" placeholder="Dirección completa del distribuidor" required></textarea>
                        </div>
                       
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Regresar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save me-2"></i>¡Guardar Distribuidor!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Comic Hero Footer -->
            <div class="text-center mt-4">
                <div class="comic-footer-bubble">
                    <span>¡POW!</span>
                </div>
                <p class="text-muted">Todos los distribuidores ayudan a que nuestra tienda tenga los mejores comics</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos para formulario temático de comics */
    .form-comic .form-control:focus,
    .form-comic .form-select:focus {
        border-color: #ff4500;
        box-shadow: 0 0 0 0.25rem rgba(255, 69, 0, 0.25);
    }
    
    .comic-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .comic-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60px;
        height: 60px;
        background-color: #fff;
        color: #dc3545;
        border-radius: 50%;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .comic-footer-bubble {
        display: inline-block;
        background-color: #ff4500;
        color: white;
        font-weight: bold;
        padding: 5px 15px;
        border-radius: 20px;
        position: relative;
        margin-bottom: 15px;
        font-size: 18px;
        transform: rotate(-5deg);
    }
    
    .comic-footer-bubble:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 20px;
        width: 15px;
        height: 15px;
        background-color: #ff4500;
        transform: rotate(45deg);
    }
    
    .bg-gradient-dark {
        background: linear-gradient(145deg, #2c3e50, #1a1a2e);
    }
    
    /* Animaciones */
    .form-control, .form-select, .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection