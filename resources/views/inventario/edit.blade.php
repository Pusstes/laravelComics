@extends('layouts.app', ['title' => 'Ajustar Inventario'])

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-edit me-2"></i>Ajustar Stock
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('inventario.update', $item['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" value="{{ $productosMap[$item['id_producto']] ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Actual</label>
                        <input type="number" class="form-control" id="stock" name="stock" 
                               value="{{ $item['stock'] }}" min="0" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('inventario.index') }}" class="btn btn-secondary me-md-2">
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
@endsection