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
                                <div class="col-md-6 mb-4">
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
                                <div class="col-md-6 mb-4">
                                    <label for="tipo" class="form-label comic-label">
                                        <i class="fas fa-tags me-2"></i>Tipo de Comics
                                    </label>
                                    <select class="form-select bg-light" id="tipo" name="tipo">
                                        <option value="">Selecciona un tipo</option>
                                        <option value="manga" {{ isset($proveedor['tipo']) && $proveedor['tipo'] == 'manga' ? 'selected' : '' }}>Manga / Comics Japoneses</option>
                                        <option value="american" {{ isset($proveedor['tipo']) && $proveedor['tipo'] == 'american' ? 'selected' : '' }}>Comics Americanos</option>
                                        <option value="european" {{ isset($proveedor['tipo']) && $proveedor['tipo'] == 'european' ? 'selected' : '' }}>Comics Europeos</option>
                                        <option value="independiente" {{ isset($proveedor['tipo']) && $proveedor['tipo'] == 'independiente' ? 'selected' : '' }}>Comics Independientes</option>
                                        <option value="varios" {{ isset($proveedor['tipo']) && $proveedor['tipo'] == 'varios' ? 'selected' : '' }}>Varios</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="direccion" class="form-label comic-label">
                                    <i class="fas fa-map-marker-alt me-2"></i>Dirección
                                </label>
                                <textarea class="form-control bg-light" id="direccion" name="direccion" 
                                          rows="3">{{ $proveedor['direccion'] }}</textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label comic-label">
                                    <i class="fas fa-bookmark me-2"></i>Géneros que distribuye
                                </label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero1" name="generos[]" 
                                                   value="superheroes" {{ isset($proveedor['generos']) && in_array('superheroes', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero1">Superhéroes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero2" name="generos[]" 
                                                   value="fantasia" {{ isset($proveedor['generos']) && in_array('fantasia', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero2">Fantasía</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero3" name="generos[]" 
                                                   value="ciencia_ficcion" {{ isset($proveedor['generos']) && in_array('ciencia_ficcion', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero3">Ciencia Ficción</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero4" name="generos[]" 
                                                   value="terror" {{ isset($proveedor['generos']) && in_array('terror', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero4">Terror</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero5" name="generos[]" 
                                                   value="novela_grafica" {{ isset($proveedor['generos']) && in_array('novela_grafica', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero5">Novela Gráfica</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="genero6" name="generos[]" 
                                                   value="otros" {{ isset($proveedor['generos']) && in_array('otros', $proveedor['generos'] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genero6">Otros</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notas" class="form-label comic-label">
                                    <i class="fas fa-sticky-note me-2"></i>Notas Adicionales
                                </label>
                                <textarea class="form-control bg-light" id="notas" name="notas" 
                                          rows="2">{{ $proveedor['notas'] ?? '' }}</textarea>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="clasificacion" class="form-label comic-label">
                                        <i class="fas fa-star me-2"></i>Clasificación
                                    </label>
                                    <div class="rating-stars">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="clasificacion" id="star1" value="1" 
                                                  {{ isset($proveedor['clasificacion']) && $proveedor['clasificacion'] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="star1"><i class="fas fa-star text-warning"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="clasificacion" id="star2" value="2"
                                                  {{ isset($proveedor['clasificacion']) && $proveedor['clasificacion'] == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="star2"><i class="fas fa-star text-warning"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="clasificacion" id="star3" value="3"
                                                  {{ isset($proveedor['clasificacion']) && $proveedor['clasificacion'] == 3 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="star3"><i class="fas fa-star text-warning"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="clasificacion" id="star4" value="4"
                                                  {{ isset($proveedor['clasificacion']) && $proveedor['clasificacion'] == 4 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="star4"><i class="fas fa-star text-warning"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="clasificacion" id="star5" value="5"
                                                  {{ isset($proveedor['clasificacion']) && $proveedor['clasificacion'] == 5 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="star5"><i class="fas fa-star text-warning"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="estado" class="form-label comic-label">
                                        <i class="fas fa-toggle-on me-2"></i>Estado
                                    </label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1"
                                              {{ isset($proveedor['estado']) && $proveedor['estado'] == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="estado">Distribuidor activo</label>
                                    </div>
                                </div>
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
            
            <!-- Timeline de cambios -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-light p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>Historial de cambios
                    </h5>
                </div>
                <div class="card-body p-3">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Creación del distribuidor</h6>
                                <p class="timeline-text">01/04/2025 - Por: Admin</p>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Actualización de datos de contacto</h6>
                                <p class="timeline-text">05/04/2025 - Por: Admin</p>
                            </div>
                        </li>
                    </ul>
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
    
    /* Timeline styles */
    .timeline {
        position: relative;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        left: 15px;
        height: 100%;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 20px;
    }
    
    .timeline-marker {
        position: absolute;
        top: 0;
        left: 0;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: #0d6efd;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
    }
    
    .timeline-title {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }
    
    .timeline-text {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 0;
    }
    
    /* Form check styles */
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
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