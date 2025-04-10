@extends('layouts.app', ['title' => 'Nueva Promoción'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 py-3 px-4 d-flex align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-percentage me-2"></i>Registrar Nueva Promoción
                </h4>
            </div>
            <div class="card-body p-4 bg-light">
                <form id="formPromocion" action="{{ route('promociones.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="id_producto" class="form-label fw-semibold">Producto</label>
                        <select class="form-select rounded-pill shadow-sm" id="id_producto" name="id_producto" required>
                            <option value="" disabled selected>Seleccione un producto</option>
                            @foreach($productos as $producto)
                            <option value="{{ $producto['id'] }}">{{ $producto['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="descuento" class="form-label fw-semibold">Descuento (%)</label>
                        <input type="number" class="form-control rounded-pill shadow-sm"
                               id="descuento" name="descuento" min="1" max="100" placeholder="10" required>
                        <div class="form-text">Introduce un valor entre 1 y 100</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fecha_inicio" class="form-label fw-semibold">Fecha Inicio</label>
                            <input type="date" class="form-control rounded-pill shadow-sm"
                                   id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="fecha_fin" class="form-label fw-semibold">Fecha Fin</label>
                            <input type="date" class="form-control rounded-pill shadow-sm"
                                   id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-3">
                        <a href="{{ route('promociones.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm" id="btnCancelar">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" id="btnGuardar">
                            <i class="fas fa-save me-1"></i>Guardar Promoción
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

        // Establecer fecha mínima (hoy)
        const today = new Date().toISOString().split('T')[0];
        fechaInicio.min = today;

        // Actualizar fecha mínima de fin cuando cambia inicio
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
                title: '¿Cancelar promoción?',
                text: '¡Los datos ingresados se perderán!',
                icon: 'question',
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

        // Botón Guardar con SweetAlert2
        document.getElementById('btnGuardar').addEventListener('click', function() {
            // Obtener valores del formulario
            const idProducto = document.getElementById('id_producto');
            const descuento = document.getElementById('descuento').value;
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;
            const productoText = idProducto.options[idProducto.selectedIndex]?.text || '';

            // Validación de campos
            if (!idProducto.value || !descuento || !fechaInicio || !fechaFin) {
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
                title: '¿Confirmar registro?',
                html: `
                    <div class="text-start">
                        <p><strong>Producto:</strong> ${productoText}</p>
                        <p><strong>Descuento:</strong> ${descuento}%</p>
                        <p><strong>Fecha Inicio:</strong> ${formatDate(fechaInicio)}</p>
                        <p><strong>Fecha Fin:</strong> ${formatDate(fechaFin)}</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Sí, registrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formPromocion').submit();
                }
            });
        });
    });

    // Alertas de sesión con SweetAlert2
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
