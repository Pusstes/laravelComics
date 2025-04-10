@extends('layouts.app', ['title' => 'Distribuidores de Comics'])

@section('content')
<div class="container-fluid py-4">
    <!-- Header con estilo de cómic -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center p-4"
                     style="background-image: url('/assets/images/comic-header-bg.jpg'); background-size: cover; background-position: center;">
                    <div class="d-flex align-items-center">
                        <div class="comic-bubble me-3">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                        <h1 class="m-0 text-uppercase fw-bold" style="text-shadow: 3px 3px 0px #000, -1px -1px 0px #ff4500;">
                            Distribuidores de Comics
                        </h1>
                    </div>
                    <a href="{{ route('proveedores.create') }}" class="btn btn-danger btn-lg shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Distribuidor
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-start border-success border-5">
        <div class="d-flex align-items-center">
            <div class="comic-bubble-small bg-success me-3">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <strong>¡POW!</strong> {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-truck me-2"></i>LISTADO DE DISTRIBUIDORES
                </h5>
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Buscar distribuidor..."
                           id="searchInput">
                    <span class="input-group-text bg-primary border-0">
                        <i class="fas fa-search text-white"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="proveedoresTable">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-0" width="5%">#</th>
                            <th class="border-0" width="30%">Distribuidor</th>
                            <th class="border-0" width="20%">Contacto</th>
                            <th class="border-0" width="15%">Teléfono</th>
                            <th class="border-0" width="15%">Email</th>
                            <th class="border-0 text-center" width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proveedores as $proveedor)
                        <tr>
                            <td class="align-middle">
                                <div class="comic-number">{{ $proveedor['id'] }}</div>
                            </td>
                            <td class="align-middle fw-bold text-primary">{{ $proveedor['nombre'] }}</td>
                            <td class="align-middle">{{ $proveedor['contacto'] }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt text-success me-2"></i>
                                    {{ $proveedor['telefono'] }}
                                </div>
                            </td>
                            <td class="align-middle">
                                <a href="mailto:{{ $proveedor['email'] }}" class="text-decoration-none">
                                    {{ $proveedor['email'] }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('proveedores.edit', $proveedor['id']) }}"
                                       class="btn btn-sm btn-warning text-white" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger delete-proveedor"
                                            title="Eliminar" data-id="{{ $proveedor['id'] }}"
                                            data-nombre="{{ $proveedor['nombre'] }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{ $proveedor['id'] }}"
                                          action="{{ route('proveedores.destroy', $proveedor['id']) }}"
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <img src="/assets/images/empty-comics.svg" alt="No hay distribuidores"
                                         style="max-height: 150px;" class="mb-3">
                                    <h4 class="text-muted">¡No hay distribuidores registrados!</h4>
                                    <p class="text-muted mb-3">Agrega tu primer distribuidor de comics</p>
                                    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle me-2"></i>Agregar distribuidor
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted">Total: <strong>{{ count($proveedores) }}</strong> distribuidores</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
    .comic-bubble {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #ff4500;
        color: white;
        border-radius: 50%;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .comic-bubble:after {
        content: '';
        position: absolute;
        bottom: -10px;
        right: -5px;
        width: 15px;
        height: 15px;
        background-color: #ff4500;
        transform: rotate(45deg);
    }

    .comic-bubble-small {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        color: white;
    }

    .comic-number {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        background-color: #3f51b5;
        color: white;
        border-radius: 50%;
        font-weight: bold;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    /* Animaciones para botones */
    .btn {
        transition: all 0.3s;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- SweetAlert2 & Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función de búsqueda para la tabla
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('proveedoresTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function() {
        const term = searchInput.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName('td');
            let shouldShow = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().indexOf(term) > -1) {
                    shouldShow = true;
                    break;
                }
            }

            row.style.display = shouldShow ? '' : 'none';
        }
    });

    // SweetAlert2 para confirmación de eliminación
    const deleteButtons = document.querySelectorAll('.delete-proveedor');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const proveedorId = this.dataset.id;
            const proveedorNombre = this.dataset.nombre;

            Swal.fire({
                title: '¿Eliminar distribuidor?',
                html: `
                    <div class="text-center mb-4">
                        <p>¿Estás seguro de eliminar al distribuidor?</p>
                        <h4 class="text-danger fw-bold">${proveedorNombre}</h4>
                        <p class="text-muted">Esta acción no se puede deshacer</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${proveedorId}`).submit();

                    // Mostrar mensaje de eliminación en proceso
                    Swal.fire({
                        title: '¡Eliminando!',
                        text: 'El distribuidor está siendo eliminado',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            });
        });
    });

    // SweetAlert2 para mensajes de sesión
    @if(session('success'))
        Swal.fire({
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#28a745'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Error',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonColor: '#dc3545'
        });
    @endif
});
</script>
@endsection
