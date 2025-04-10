@extends('layouts.app', ['title' => 'Nuevo Pedido'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Pedido
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_usuario" class="form-label">Usuario</label>
                            <select class="form-select" id="id_usuario" name="id_usuario" required>
                                <option value="">Seleccione un usuario...</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario['id'] }}">{{ $usuario['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Productos</h5>
                    <div id="productos-container">
                        <div class="row producto-item mb-3">
                            <div class="col-md-5">
                                <label class="form-label">Producto</label>
                                <select class="form-select producto-select" name="productos[0][id_producto]" required>
                                    <option value="">Seleccione...</option>
                                    @foreach($productos as $producto)
                                    <option value="{{ $producto['id'] }}" 
                                        data-precio="{{ $producto['precio'] }}">
                                        {{ $producto['nombre'] }} (${{ number_format($producto['precio'], 2) }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control cantidad" 
                                       name="productos[0][cantidad]" min="1" value="1" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Precio Unitario</label>
                                <input type="number" step="0.01" class="form-control precio-unitario" 
                                       name="productos[0][precio_unitario]" readonly>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-remove-producto">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="btn-add-producto" class="btn btn-sm btn-secondary mb-4">
                        <i class="fas fa-plus me-1"></i>Agregar Producto
                    </button>

                    <div class="row">
                        <div class="col-md-4 offset-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total del Pedido</h5>
                                    <input type="hidden" id="total" name="total">
                                    <h3 id="total-display" class="text-primary">$0.00</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables para el contador de productos
    let productoCounter = 1;
    
    // Función para calcular el total
    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.producto-item').forEach(item => {
            const cantidad = parseFloat(item.querySelector('.cantidad').value) || 0;
            const precio = parseFloat(item.querySelector('.precio-unitario').value) || 0;
            total += cantidad * precio;
        });
        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('total-display').textContent = '$' + total.toFixed(2);
    }
    
    // Evento para agregar nuevo producto
    document.getElementById('btn-add-producto').addEventListener('click', function() {
        const container = document.getElementById('productos-container');
        const newItem = document.querySelector('.producto-item').cloneNode(true);
        
        // Actualizar los nombres de los campos
        const newIndex = productoCounter++;
        newItem.innerHTML = newItem.innerHTML.replace(/productos\[0\]/g, `productos[${newIndex}]`);
        
        // Limpiar valores
        newItem.querySelector('.producto-select').selectedIndex = 0;
        newItem.querySelector('.cantidad').value = 1;
        newItem.querySelector('.precio-unitario').value = '';
        
        // Agregar al contenedor
        container.appendChild(newItem);
        
        // Agregar eventos al nuevo elemento
        agregarEventosProducto(newItem);
    });
    
    // Función para agregar eventos a un elemento producto
    function agregarEventosProducto(item) {
        // Evento para cambiar producto
        item.querySelector('.producto-select').addEventListener('change', function() {
            const precio = this.options[this.selectedIndex].getAttribute('data-precio');
            item.querySelector('.precio-unitario').value = precio;
            calcularTotal();
        });
        
        // Evento para cambiar cantidad
        item.querySelector('.cantidad').addEventListener('input', calcularTotal);
        
        // Evento para eliminar producto
        item.querySelector('.btn-remove-producto').addEventListener('click', function() {
            if (document.querySelectorAll('.producto-item').length > 1) {
                item.remove();
                calcularTotal();
            } else {
                alert('Debe haber al menos un producto en el pedido.');
            }
        });
    }
    
    // Agregar eventos al primer producto
    agregarEventosProducto(document.querySelector('.producto-item'));
    
    // Calcular total inicial
    calcularTotal();
});
</script>
@endpush
@endsection