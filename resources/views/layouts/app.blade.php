
@extends('layouts.app', ['title' => 'Aplicación'])

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <h5 class="mb-0">
                <i class="fas fa-cogs me-2"></i>Ajustes de la Aplicación
            </h5>
        </div>
        <div class="card-body">
            <h4 class="fw-bold">Configuración General</h4>
            <p class="mt-3">Aquí puedes modificar la configuración de la aplicación.</p>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('configuracion.edit') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-edit me-1"></i>Editar Configuración
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
