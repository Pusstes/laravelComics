
@extends('layouts.app', ['title' => 'Nueva Entrada'])

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Registrar Nueva Entrada
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('entradas.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="form-label fw-semibold">Nombre de la entrada</label>
                        <input type="text" class="form-control rounded-3" id="nombre" name="nombre" placeholder="Ej. Nueva Entrada" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('entradas.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
