@extends('layouts.app', ['title' => 'Promociones'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-primary fw-bold">
        <i class="fas fa-percentage me-2"></i>Gestión de Promociones
    </h1>
    <a href="{{ route('promociones.create') }}" class="btn btn-outline-primary shadow-sm rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Nueva Promoción
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
                        <th>Producto</th>
                        <th>Descuento</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($promociones as $promocion)
                    @php
                        $hoy = \Carbon\Carbon::now();
                        $fechaInicio = \Carbon\Carbon::parse($promocion['fecha_inicio']);
                        $fechaFin = \Carbon\Carbon::parse($promocion['fecha_fin']);
                        $estado = 'Pendiente';
                        $estadoClass = 'bg-secondary';

                        if ($hoy->between($fechaInicio, $fechaFin)) {
                            $estado = 'Activa';
                            $estadoClass = 'bg-success';
                        } elseif ($hoy->greaterThan($fechaFin)) {
                            $estado = 'Finalizada';
                            $estadoClass = 'bg-danger';
                        }
                    @endphp
                    <tr>
                        <td>{{ $productosMap[$promocion['id_producto']] ?? 'N/A' }}</td>
                        <td><span class="badge bg-warning text-dark">{{ $promocion['descuento'] }}%</span></td>
                        <td>{{ $fechaInicio->format('d/m/Y') }}</td>
                        <td>{{ $fechaFin->format('d/m/Y') }}</td>
                        <td><span class="badge {{ $estadoClass }}">{{ $estado }}</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('promociones.edit', $promocion['id']) }}"
                                   class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle delete-promocion"
                                        title="Eliminar" data-id="{{ $promocion['id'] }}"
                                        data-producto="{{ $productosMap[$promocion['id_producto']] ?? 'N/A' }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="delete-form-{{ $promocion['id'] }}"
                                      action="{{ route('promociones.destroy', $promocion['id']) }}"
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center py-4">No hay promociones registradas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SweetAlert2 Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar botones de eliminar
        const deleteButtons = document.querySelectorAll('.delete-promocion');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const promocionId = this.dataset.id;
                const producto = this.dataset.producto;

                Swal.fire({
                    title: '¿Eliminar promoción?',
                    html: `
                        <div class="text-center mb-4">
                            <p>¿Estás seguro de eliminar la promoción para el producto:</p>
                            <h5 class="text-danger fw-bold">${producto}</h5>
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
                        document.getElementById(`delete-form-${promocionId}`).submit();

                        // Mostrar mensaje de eliminación en proceso
                        Swal.fire({
                            title: '¡Eliminando promoción!',
                            text: 'La promoción está siendo eliminada',
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
        @if(session('sweet_alert'))
        Swal.fire({
            icon: '{{ session('sweet_alert.type') }}',
            title: '{{ session('sweet_alert.title') }}',
            text: '{{ session('sweet_alert.text') }}',
            timer: 3000,
            timerProgressBar: true
        });
        @endif
    });
</script>
@endsection
