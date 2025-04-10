
@extends('layouts.app', ['title' => 'Administrador'])

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-danger text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fas fa-shield-alt me-2"></i>Panel de Administrador
            </h5>
        </div>
        <div class="card-body">
            <h4 class="fw-bold">Gestiona la aplicación y sus usuarios</h4>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('usuarios.index') }}" class="btn btn-success rounded-pill px-4">
                    <i class="fas fa-users me-1"></i>Ver Usuarios
                </a>
                <a href="{{ route('configuracion.index') }}" class="btn btn-warning rounded-pill px-4">
                    <i class="fas fa-cogs me-1"></i>Configuración
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
