@extends('layouts.app', ['title' => 'Nueva Promoción'])

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Promoción
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('promociones.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select class="form-select" id="id_producto" name="id_producto" required>
                            <option value="">Seleccione un producto...</option>
                            @foreach($productos as $producto)
                            <option value="{{ $producto['id'] }}">{{ $producto['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" id="descuento" name="descuento" 
                                   min="1" max="100" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('promociones.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    // Establecer fecha mínima (hoy)
    const today = new Date().toISOString().split('T')[0];
    fechaInicio.min = today;
    
    // Actualizar fecha mínima de fin cuando cambia inicio
    fechaInicio.addEventListener('change', function() {
        fechaFin.min = this.value;
    });
});
</script>
@endpush
@endsection