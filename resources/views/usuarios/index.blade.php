@extends('layouts.app', ['title' => 'Usuarios'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-primary fw-bold">
        <i class="fas fa-users me-2"></i>Gestión de Usuarios
    </h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-outline-primary shadow-sm rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Agregar Usuario
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow rounded">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        {{-- <th>Rol</th> --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td class="fw-semibold">{{ $usuario['id'] }}</td>
                        <td>{{ $usuario['nombre'] }}</td>
                        <td><span class="text-primary">{{ $usuario['email'] }}</span></td>
                        <td>{{ $usuario['telefono'] }}</td>
                        {{-- <td>{{ $usuario['role'] }}</td> --}}
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('usuarios.edit', $usuario['id']) }}"
                                   class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- @if($usuario['id'] != auth()->user()['id'])
                                <form action="{{ route('usuarios.destroy', $usuario['id']) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle"
                                            title="Eliminar" onclick="confirmDelete({{ $usuario['id'] }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif --}}
                                <form action="{{ route('usuarios.destroy', $usuario['id']) }}"
                                      method="POST" class="d-inline" id="delete-form-{{ $usuario['id'] }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle"
                                            title="Eliminar" onclick="confirmDelete({{ $usuario['id'] }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center py-4">No hay usuarios registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Este usuario será eliminado permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviamos el formulario
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

    // Para mensajes de éxito/error de SweetAlert2 después de redirecciones
    @if(session('sweet_alert'))
    Swal.fire({
        icon: '{{ session('sweet_alert.type') }}',
        title: '{{ session('sweet_alert.title') }}',
        text: '{{ session('sweet_alert.text') }}',
        timer: 3000,
        timerProgressBar: true
    });
    @endif
</script>
@endsection
