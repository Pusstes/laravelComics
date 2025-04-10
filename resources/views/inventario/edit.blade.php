@extends('layouts.app', ['title' => 'Ajustar Inventario'])

@section('content')
<div class="container-fluid py-4">
    <!-- Header con estilo de cómic -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center p-4" 
                     style="background-image: url('/assets/images/comic-header-bg.jpg'); background-size: cover; background-position: center;">
                    <div class="d-flex align-items-center">
                        <div class="comic-bubble me-3">
                            <i class="fas fa-edit fa-2x"></i>
                        </div>
                        <h1 class="m-0 text-uppercase fw-bold" style="text-shadow: 3px 3px 0px #000, -1px -1px 0px #ff4500;">
                            Ajustar Stock
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-primary text-white p-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>AJUSTAR STOCK DE PRODUCTO
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('inventario.update', $item['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Producto</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-book-open"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg bg-light" 
                                       value="{{ $productosMap[$item['id_producto']] ?? 'N/A' }}" readonly>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="stock" class="form-label fw-bold text-secondary">Stock Actual</label>
                            <div class="input-group">
                                <span class="input-group-text bg-warning text-white">
                                    <i class="fas fa-cubes"></i>
                                </span>
                                <input type="number" class="form-control form-control-lg" id="stock" name="stock" 
                                       value="{{ $item['stock'] }}" min="0" required>
                            </div>
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>Ingresa la cantidad total de unidades disponibles
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('inventario.index') }}" class="btn btn-secondary btn-lg me-md-2">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-1"></i>Actualizar
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
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 69, 0, 0.25);
        border-color: #ff4500;
    }
    
    .form-control {
        transition: all 0.3s;
    }
</style>
@endsection