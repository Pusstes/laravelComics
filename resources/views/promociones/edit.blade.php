@extends('layouts.app', ['title' => 'Editar Promoción'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-percentage me-2"></i>
                <h5 class="mb-0">Editar Promoción</h5>
            </div>
            <div class="card-body">
                <form id="formPromocion" action="{{ route('promociones.update', $promocion['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control rounded-pill shadow-sm"
                               value="{{ $productosMap[$promocion['id_producto']] ?? 'N/A' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="descuento" class="form-label">Descuento (%)</label>
                        <input type="number" class="form-control rounded-pill shadow-sm" id="descuento" name="descuento"
                               value="{{ $promocion['descuento'] }}" min="1" max="100" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control rounded-pill shadow-sm" id="fecha_inicio" name="fecha_inicio"
                                   value="{{ \Carbon\Carbon::parse($promocion['fecha_inicio'])->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control rounded-pill shadow-sm" id="fecha_fin" name="fecha_fin"
                                   value="{{ \Carbon\Carbon::parse($promocion['fecha_fin'])->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('promociones.index') }}" class="btn btn-outline-secondary rounded-pill" id="btnCancelar">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="button" class="btn btn-success rounded-pill" id="btnActualizar">
                            <i class="fas fa-save me-1"></i>Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert2 Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');

        // Establecer relación entre fechas
        fechaInicio.addEventListener('change', function() {
            fechaFin.min = this.value;

            // Si la fecha fin ya está establecida y es menor que la nueva fecha inicio
            if (fechaFin.value && fechaFin.value < this.value) {
                fechaFin.value = this.value;
            }
        });

        // Botón Cancelar con SweetAlert2
        document.getElementById('btnCancelar').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Cancelar cambios?',
                text: '¡Los cambios no guardados se perderán!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'Continuar editando'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('promociones.index') }}";
                }
            });
        });

        // Botón Actualizar con SweetAlert2
        document.getElementById('btnActualizar').addEventListener('click', function() {
            // Obtener valores del formulario
            const producto = document.querySelector('input[readonly]').value;
            const descuento = document.getElementById('descuento').value;
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;

            // Validación de campos
            if (!descuento || !fechaInicio || !fechaFin) {
                Swal.fire({
                    title: 'Campos incompletos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'warning',
                    confirmButtonColor: '#f0ad4e'
                });
                return;
            }

            // Formato de fechas para mostrar
            const formatDate = (dateString) => {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString(undefined, options);
            };

            // Mostrar confirmación
            Swal.fire({
                title: '¿Guardar cambios?',
                html: `
                    <div class="text-start">
                        <p><strong>Producto:</strong> ${producto}</p>
                        <p><strong>Descuento:</strong> ${descuento}%</p>
                        <p><strong>Fecha Inicio:</strong> ${formatDate(fechaInicio)}</p>
                        <p><strong>Fecha Fin:</strong> ${formatDate(fechaFin)}</p>
                    </div>
                    <p class="mt-3">¡Verifica que toda la información sea correcta!</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Revisar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formPromocion').submit();
                }
            });
        });
    });

    // Alertas para mensajes de sesión con SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endsection
