@extends('layouts.app', ['title' => 'Inventario'])

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
                            <i class="fas fa-boxes fa-2x"></i>
                        </div>
                        <h1 class="m-0 text-uppercase fw-bold" style="text-shadow: 3px 3px 0px #000, -1px -1px 0px #ff4500;">
                            Inventario
                        </h1>
                    </div>
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
                    <i class="fas fa-boxes me-2"></i>LISTADO DE INVENTARIO
                </h5>
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Buscar producto..." 
                           id="searchInput">
                    <span class="input-group-text bg-primary border-0">
                        <i class="fas fa-search text-white"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="inventarioTable">
                    <thead>
                        <tr class="bg-light">
                            <th class="border-0" width="70%">Producto</th>
                            <th class="border-0" width="15%">Stock</th>
                            <th class="border-0 text-center" width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventario as $item)
                        <tr>
                            <td class="align-middle fw-bold text-primary">{{ $productosMap[$item['id_producto']] ?? 'N/A' }}</td>
                            <td class="align-middle">
                                @if($item['stock'] > 10)
                                    <span class="badge bg-success">{{ $item['stock'] }}</span>
                                @elseif($item['stock'] > 0)
                                    <span class="badge bg-warning text-dark">{{ $item['stock'] }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $item['stock'] }}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('inventario.edit', $item['id']) }}" 
                                       class="btn btn-sm btn-warning text-white" title="Ajustar Stock">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-message">
                            <td colspan="3" class="text-center py-5">
                                <div class="empty-state">
                                    <img src="/assets/images/empty-comics.svg" alt="No hay inventario" 
                                        style="max-height: 150px;" class="mb-3">
                                    <h4 class="text-muted">¡No hay productos en inventario!</h4>
                                    <p class="text-muted mb-3">Aún no hay productos registrados en el inventario.</p>
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
                    <span class="text-muted">Total: <strong>{{ count($inventario) }}</strong> productos</span>
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
    
    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.7rem;
    }
</style>

<!-- Script para búsqueda -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return; // Verificamos que exista el input de búsqueda
    
    const table = document.getElementById('inventarioTable');
    if (!table) return; // Verificamos que exista la tabla
    
    // Encontrar tbody y sus filas de datos (excluir encabezados)
    const tbody = table.querySelector('tbody');
    if (!tbody) return;
    
    searchInput.addEventListener('keyup', function() {
        const term = searchInput.value.toLowerCase().trim();
        
        // Seleccionamos solo las filas que son productos (excluyendo mensajes vacíos)
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
                    <td colspan="3" class="text-center py-4">
                        <div class="text-muted">
                            <i class="fas fa-search me-2"></i>
                            No se encontraron productos con el término: "${term}"
                        </div>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            } else {
                noResultsRow.querySelector('td div').innerHTML = `
                    <i class="fas fa-search me-2"></i>
                    No se encontraron productos con el término: "${term}"
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