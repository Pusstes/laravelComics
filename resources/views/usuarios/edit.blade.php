@extends('layouts.app', ['title' => 'Editar Usuario'])

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.update', $usuario['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="{{ $usuario['nombre'] }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ $usuario['email'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" 
                                   value="{{ $usuario['telefono'] }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" 
                                   value="{{ $usuario['direccion'] }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="constrasena" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena">
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" 
                                   name="password_confirmation">
                        </div> --}}
                    </div>
                    {{-- @if(auth()->user()['role'] === 'Administrador')
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="Cliente" {{ $usuario['role'] === 'Cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="Administrador" {{ $usuario['role'] === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                    @endif --}}
                    {{-- <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="Cliente" {{ $usuario['role'] === 'Cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="Administrador" {{ $usuario['role'] === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div> --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-md-2">
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