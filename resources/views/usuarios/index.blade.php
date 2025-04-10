@extends('layouts.app', ['title' => 'Usuarios'])

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
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h1 class="m-0 text-uppercase fw-bold" style="text-shadow: 3px 3px 0px #000, -1px -1px 0px #ff4500;">
                            Usuarios
                        </h1>
                    </div>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-danger btn-lg shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
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
                    <i class="fas fa-user-friends me-2"></i>LISTADO DE USUARIOS
                </h5>
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Buscar usuario..." 
                           id="searchInput">
                    <span class="input-group-text bg-primary border-0">
                        <i class="fas fa-search text-white"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="usuariosTable">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-0" width="5%">#</th>
                            <th class="border-0" width="30%">Nombre</th>
                            <th class="border-0" width="25%">Email</th>
                            <th class="border-0" width="20%">Teléfono</th>
                            <th class="border-0 text-center" width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                        <tr>
                            <td class="align-middle">
                                <div class="comic-number">{{ $usuario['id'] }}</div>
                            </td>
                            <td class="align-middle fw-bold text-primary">{{ $usuario['nombre'] }}</td>
                            <td class="align-middle">
                                <a href="mailto:{{ $usuario['email'] }}" class="text-decoration-none">
                                    {{ $usuario['email'] }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt text-success me-2"></i>
                                    {{ $usuario['telefono'] }}
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('usuarios.edit', $usuario['id']) }}" 
                                       class="btn btn-sm btn-warning text-white" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info text-white" 
                                            title="Ver detalles" data-bs-toggle="modal" 
                                            data-bs-target="#usuarioModal{{ $usuario['id'] }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('usuarios.destroy', $usuario['id']) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                title="Eliminar" 
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Modal para ver detalles -->
                        <div class="modal fade" id="usuarioModal{{ $usuario['id'] }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-info-circle me-2"></i>Detalles del Usuario
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="text-primary mb-0">{{ $usuario['nombre'] }}</h4>
                                            <span class="badge bg-success">ID: {{ $usuario['id'] }}</span>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary">Email</label>
                                                <p class="mb-0">{{ $usuario['email'] }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary">Teléfono</label>
                                                <p class="mb-0">{{ $usuario['telefono'] }}</p>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-secondary">Dirección</label>
                                                <p class="mb-0">{{ $usuario['direccion'] ?? 'No especificada' }}</p>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-secondary">Fecha de registro</label>
                                                <p class="mb-0">{{ $usuario['fecha_registro'] ?? 'No disponible' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <a href="{{ route('usuarios.edit', $usuario['id']) }}" 
                                           class="btn btn-warning text-white">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr class="empty-message">
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <img src="/assets/images/empty-users.svg" alt="No hay usuarios" 
                                         style="max-height: 150px;" class="mb-3">
                                    <h4 class="text-muted">¡No hay usuarios registrados!</h4>
                                    <p class="text-muted mb-3">Agrega tu primer usuario al sistema</p>
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle me-2"></i>Agregar usuario
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
                    <span class="text-muted">Total: <strong>{{ count($usuarios) }}</strong> usuarios</span>
                </div>
                <!-- Aquí puedes agregar paginación si la necesitas -->
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

<!-- Script para búsqueda -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return; // Verificamos que exista el input de búsqueda
    
    const table = document.getElementById('usuariosTable');
    if (!table) return; // Verificamos que exista la tabla
    
    // Encontrar tbody y sus filas de datos (excluir encabezados)
    const tbody = table.querySelector('tbody');
    if (!tbody) return;
    
    searchInput.addEventListener('keyup', function() {
        const term = searchInput.value.toLowerCase().trim();
        
        // Seleccionamos solo las filas que son usuarios (excluyendo mensajes vacíos)
        const dataRows = tbody.querySelectorAll('tr:not(.empty-message)');
        
        dataRows.forEach(function(row) {
            if (row.cells.length <= 1) return; // Ignorar filas especiales
            
            let shouldShow = false;
            const rowText = row.textContent.toLowerCase();
            
            // Revisar si el término de búsqueda está en cualquier parte de la fila
            if (rowText.includes(term)) {
                shouldShow = true;
            }
            
            row.style.display = shouldShow ? '' : 'none';
        });
        
        // Verificar si hay resultados visibles
        const visibleRows = Array.from(dataRows).filter(row => row.style.display !== 'none');
        
        // Mostrar mensaje de "no hay resultados" si es necesario
        let noResultsRow = tbody.querySelector('.no-results-message');
        
        if (visibleRows.length === 0 && term !== '') {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results-message';
                noResultsRow.innerHTML = `
                    <td colspan="5" class="text-center py-4">
                        <div class="text-muted">
                            <i class="fas fa-search me-2"></i>
                            No se encontraron usuarios con el término: "${term}"
                        </div>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            } else {
                noResultsRow.querySelector('td div').innerHTML = `
                    <i class="fas fa-search me-2"></i>
                    No se encontraron usuarios con el término: "${term}"
                `;
                noResultsRow.style.display = '';
            }
        } else if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    });
});
</script>
@endsection