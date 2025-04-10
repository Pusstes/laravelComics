@extends('layouts.app', ['title' => 'Editar Producto'])

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-edit me-2"></i>Editar Producto
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('productos.update', $producto['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="{{ $producto['nombre'] }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" 
                                  rows="3" required>{{ $producto['descripcion'] }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="precio" 
                                   name="precio" min="0" value="{{ $producto['precio'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria['id'] }}" 
                                    {{ $producto['id_categoria'] == $categoria['id'] ? 'selected' : '' }}>
                                    {{ $categoria['nombre'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_proveedor" class="form-label">Proveedor</label>
                            <select class="form-select" id="id_proveedor" name="id_proveedor" required>
                                @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor['id'] }}" 
                                    {{ $producto['id_proveedor'] == $proveedor['id'] ? 'selected' : '' }}>
                                    {{ $proveedor['nombre'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary me-md-2">
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