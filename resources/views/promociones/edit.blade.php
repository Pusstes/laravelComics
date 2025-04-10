@extends('layouts.app', ['title' => 'Editar Promoción'])

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-edit me-2"></i>Editar Promoción
                </5>
            </div>
            <div class="card-body">
                <form action="{{ route('promociones.update', $promocion['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" 
                               value="{{ $productosMap[$promocion['id_producto']] ?? 'N/A' }}" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" id="descuento" name="descuento" 
                                   value="{{ $promocion['descuento'] }}" min="1" max="100" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                   value="{{ \Carbon\Carbon::parse($promocion['fecha_inicio'])->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                                   value="{{ \Carbon\Carbon::parse($promocion['fecha_fin'])->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('promociones.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar
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
    
    // Establecer relación entre fechas
    fechaInicio.addEventListener('change', function() {
        fechaFin.min = this.value;
    });
});
</script>
@endpush
@endsection