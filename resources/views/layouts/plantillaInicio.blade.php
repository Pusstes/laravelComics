
@extends('layouts.app', ['title' => 'Inicio'])

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fas fa-home me-2"></i>Bienvenido a la Aplicación
            </h5>
        </div>
        <div class="card-body">
            <h4 class="fw-bold">Inicio</h4>
            <p class="mt-3">Explora nuestras funcionalidades y gestiona todo desde aquí.</p>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('inicio') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-right me-1"></i>Empezar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
