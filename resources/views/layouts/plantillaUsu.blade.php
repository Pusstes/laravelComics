
@extends('layouts.app', ['title' => 'Usuario'])

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-info text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fas fa-user me-2"></i>Perfil del Usuario
            </h5>
        </div>
        <div class="card-body">
            <h4 class="fw-bold">Bienvenido, {{ $usuario['nombre'] }}</h4>
            <p class="mt-3">Detalles de tu cuenta.</p>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('perfil.edit', $usuario['id']) }}" class="btn btn-warning rounded-pill px-4">
                    <i class="fas fa-edit me-1"></i>Editar Perfil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
