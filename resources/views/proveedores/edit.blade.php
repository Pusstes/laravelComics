@extends('layouts.app', ['title' => 'Editar Distribuidor'])

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}" class="text-decoration-none">Distribuidores</a></li>
                    <li class="breadcrumb-item active">Editar Distribuidor</li>
                </ol>
            </nav>
            
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-gradient-warning text-white p-4">
                    <div class="d-flex align-items-center">
                        <div class="comic-icon-edit me-3">
                            <i class="fas fa-pencil-alt fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="m-0 fw-bold">Editar Distribuidor: {{ $proveedor['nombre'] }}</h4>
                            <p class="m-0 opacity-75">ID: {{ $proveedor['id'] }} • Actualiza la información del distribuidor</p>
                        </div>
                    </div>
                </div>
                
                <div class="position-relative">
                    <!-- Comic decoration elements -->
                    <div class="comic-element comic-element-1">
                        <span>¡ZAP!</span>
                    </div>
                    <div class="comic-element comic-element-2">
                        <span>¡BOOM!</span>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('proveedores.update', $proveedor['id']) }}" method="POST" class="form-comic">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="nombre" class="form-label comic-label">
                                        <i class="fas fa-building me-2"></i>Nombre del Distribuidor
                                    </label>
                                    <input type="text" class="form-control form-control-lg bg-light" 
                                           id="nombre" name="nombre" value="{{ $proveedor['nombre'] }}" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="contacto" class="form-label comic-label">
                                        <i class="fas fa-user me-2"></i>Persona de Contacto
                                    </label>
                                    <input type="text" class="form-control bg-light" 
                                           id="contacto" name="contacto" value="{{ $proveedor['contacto'] }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="telefono" class="form-label comic-label">
                                        <i class="fas fa-phone-alt me-2"></i>Teléfono
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white border-0">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control bg-light" 
                                               id="telefono" name="telefono" value="{{ $proveedor['telefono'] }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="email" class="form-label comic-label">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white border-0">
                                            <i class="fas fa-at"></i>
                                        </span>
                                        <input type="email" class="form-control bg-light" 
                                               id="email" name="email" value="{{ $proveedor['email'] }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="direccion" class="form-label comic-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Dirección
                                </label>
                                <textarea class="form-control bg-light" id="direccion" name="direccion" 
                                          rows="3" required>{{ $proveedor['direccion'] }}</textarea>
                            </div>
                           
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning btn-lg px-5 text-white">
                                    <i class="fas fa-save me-2"></i>¡Actualizar Distribuidor!
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos para formulario temático de comics */
    .form-comic .form-control:focus,
    .form-comic .form-select:focus {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.25);
    }
    
    .comic-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .comic-icon-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60px;
        height: 60px;
        background-color: #fff;
        color: #fd7e14;
        border-radius: 50%;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(145deg, #fd7e14, #e76f51);
    }
    
    /* Comic elements decoration */
    .comic-element {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        font-weight: bold;
        font-size: 16px;
        color: white;
        z-index: 1;
        transform: rotate(-15deg);
    }
    
    .comic-element-1 {
        background-color: #dc3545;
        top: -20px;
        right: 100px;
    }
    
    .comic-element-2 {
        background-color: #0d6efd;
        bottom: -15px;
        left: 50px;
        transform: rotate(10deg);
    }
    
    .comic-element:after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: 15px;
        width: 15px;
        height: 15px;
        background-color: inherit;
        transform: rotate(45deg);
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