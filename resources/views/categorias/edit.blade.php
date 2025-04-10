
@extends('layouts.app', ['title' => 'Editar Categoría'])

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-warning text-dark rounded-top-4">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Categoría
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categorias.update', $categoria['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nombre" class="form-label fw-semibold">Nombre de la categoría</label>
                        <input type="text" class="form-control rounded-3" id="nombre" name="nombre" value="{{ $categoria['nombre'] }}" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning rounded-pill px-4">
                            <i class="fas fa-save me-1"></i>Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
