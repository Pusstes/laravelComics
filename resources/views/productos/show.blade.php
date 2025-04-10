
@extends('layouts.app', ['title' => 'Ver Entrada'])

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-success text-white rounded-top-4">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Detalles de la Entrada
                </h5>
            </div>
            <div class="card-body">
                <h4 class="fw-bold">{{ $entrada['nombre'] }}</h4>
                <p class="mt-3">{{ $entrada['descripcion'] }}</p>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('entradas.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-1"></i>Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
