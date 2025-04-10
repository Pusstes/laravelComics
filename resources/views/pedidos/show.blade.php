@extends('layouts.app', ['title' => 'Detalle de Pedido'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title">
                    <i class="fas fa-file-invoice me-2"></i>Detalle del Pedido #{{ $pedido['id'] }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Información del Pedido</h6>
                        <p><strong>Usuario:</strong> {{ $usuariosMap[$pedido['id_usuario']] ?? 'N/A' }}</p>
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido['fecha'])->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h3 class="text-primary">Total: ${{ number_format($pedido['total'], 2) }}</h3>
                    </div>
                </div>

                <h6>Productos</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $detalle)
                            <tr>
                                <td>{{ $productosMap[$detalle['id_producto']] ?? 'N/A' }}</td>
                                <td>{{ $detalle['cantidad'] }}</td>
                                <td>${{ number_format($detalle['precio_unitario'], 2) }}</td>
                                <td>${{ number_format($detalle['cantidad'] * $detalle['precio_unitario'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i>Volver
                    </a>
                    <form action="{{ route('pedidos.destroy', $pedido['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection