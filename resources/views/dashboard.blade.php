@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="container-fluid px-0">
    <!-- Header del Dashboard -->
    <div class="bg-gradient-primary text-white rounded-3 shadow-sm mb-4 p-4">
        <div class="d-flex align-items-center">
            <div>
                <h4 class="mb-1 fw-bold">Panel de Control</h4>
                <p class="mb-0 text-white-50">Bienvenido al dashboard administrativo</p>
            </div>
            <div class="ms-auto">
                <div class="rounded-pill bg-white bg-opacity-25 px-3 py-1 text-white-50">
                    <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::now()->format('d M, Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row g-4 mb-4">
        <!-- Tarjeta de Productos -->
        <div class="col-md-4">
            <div class="card border-0 rounded-3 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute start-0 top-0 h-100 w-2 bg-primary"></div>
                <div class="card-body pb-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-box-open text-primary"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 text-uppercase fs-xs fw-bolder">Total de Productos</h6>
                            <h3 class="fw-bold mb-0">{{ $counts['productos'] ?? 0 }}</h3>
                        </div>
                    </div>
                    <div class="progress bg-light" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent pt-0">
                    <div class="d-flex align-items-center text-primary">
                        <small class="fw-medium">Ver inventario completo</small>
                        <i class="fas fa-arrow-right ms-auto"></i>
                    </div>
                    <a href="{{ route('productos.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pedidos -->
        <div class="col-md-4">
            <div class="card border-0 rounded-3 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute start-0 top-0 h-100 w-2 bg-success"></div>
                <div class="card-body pb-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-shopping-cart text-success"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 text-uppercase fs-xs fw-bolder">Total de Pedidos</h6>
                            <h3 class="fw-bold mb-0">{{ $counts['pedidos'] ?? 0 }}</h3>
                        </div>
                    </div>
                    <div class="progress bg-light" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%"></div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent pt-0">
                    <div class="d-flex align-items-center text-success">
                        <small class="fw-medium">Ver todos los pedidos</small>
                        <i class="fas fa-arrow-right ms-auto"></i>
                    </div>
                    <a href="{{ route('pedidos.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Usuarios -->
        <div class="col-md-4">
            <div class="card border-0 rounded-3 shadow-sm h-100 position-relative overflow-hidden">
                <div class="position-absolute start-0 top-0 h-100 w-2 bg-info"></div>
                <div class="card-body pb-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-users text-info"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 text-uppercase fs-xs fw-bolder">Total de Usuarios</h6>
                            <h3 class="fw-bold mb-0">{{ $counts['usuarios'] ?? 0 }}</h3>
                        </div>
                    </div>
                    <div class="progress bg-light" style="height: 6px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%"></div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent pt-0">
                    <div class="d-flex align-items-center text-info">
                        <small class="fw-medium">Ver todos los usuarios</small>
                        <i class="fas fa-arrow-right ms-auto"></i>
                    </div>
                    <a href="{{ route('usuarios.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de contenido principal -->
    <div class="row g-4">
        <!-- Panel de Últimos Productos -->
        <div class="col-lg-6">
            <div class="card border-0 rounded-3 shadow-sm h-100">
                <div class="card-header border-0 bg-transparent d-flex align-items-center pt-4 pb-0 px-4">
                    <div class="rounded-pill bg-primary bg-opacity-10 px-3 py-2 me-2">
                        <i class="fas fa-box-open text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Últimos Productos</h5>
                    <a href="{{ route('productos.index') }}" class="btn btn-sm btn-link text-decoration-none ms-auto">
                        Ver Todos <i class="fas fa-chevron-right ms-1 small"></i>
                    </a>
                </div>
                <div class="card-body pt-3 px-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th class="fw-medium">ID</th>
                                    <th class="fw-medium">Nombre</th>
                                    <th class="fw-medium">Precio</th>
                                    <th class="fw-medium">Categoría</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ultimosProductos as $producto)
                                <tr>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-dark fw-normal">
                                            #{{ is_array($producto) ? $producto['id'] : (is_object($producto) ? $producto->id : $producto) }}
                                        </span>
                                    </td>
                                    <td class="fw-medium text-nowrap">
                                        {{ is_array($producto) ? $producto['nombre'] : (is_object($producto) ? $producto->nombre : 'N/A') }}
                                    </td>
                                    <td>
                                        <span class="fw-medium text-success">
                                            ${{ number_format(is_array($producto) ? $producto['precio'] : (is_object($producto) ? $producto->precio : 0), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary">
                                            {{ is_array($producto) ? $producto['id_categoria'] : (is_object($producto) ? $producto->id_categoria : 'N/A') }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="display-6 text-muted mb-3"><i class="fas fa-box-open opacity-50"></i></div>
                                            <p class="text-muted mb-0">No hay productos registrados</p>
                                            <a href="{{ route('productos.create') }}" class="btn btn-sm btn-outline-primary mt-3">
                                                <i class="fas fa-plus me-1"></i> Agregar Producto
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de Últimos Pedidos -->
        <div class="col-lg-6">
            <div class="card border-0 rounded-3 shadow-sm h-100">
                <div class="card-header border-0 bg-transparent d-flex align-items-center pt-4 pb-0 px-4">
                    <div class="rounded-pill bg-success bg-opacity-10 px-3 py-2 me-2">
                        <i class="fas fa-shopping-cart text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Últimos Pedidos</h5>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-sm btn-link text-decoration-none ms-auto">
                        Ver Todos <i class="fas fa-chevron-right ms-1 small"></i>
                    </a>
                </div>
                <div class="card-body pt-3 px-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th class="fw-medium">ID</th>
                                    <th class="fw-medium">Usuario</th>
                                    <th class="fw-medium">Total</th>
                                    <th class="fw-medium">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ultimosPedidos as $pedido)
                                <tr>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-dark fw-normal">
                                            #{{ is_array($pedido) ? $pedido['id'] : (is_object($pedido) ? $pedido->id : $pedido) }}
                                        </span>
                                    </td>
                                    <td class="fw-medium">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-success bg-opacity-10 text-success rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                            <span>{{ is_array($pedido) ? $pedido['id_usuario'] : (is_object($pedido) ? $pedido->id_usuario : 'N/A') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium text-success">
                                            ${{ number_format(is_array($pedido) ? $pedido['total'] : (is_object($pedido) ? $pedido->total : 0), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-calendar-alt me-2 text-muted"></i>
                                            <span>{{ \Carbon\Carbon::parse(is_array($pedido) ? $pedido['fecha'] : (is_object($pedido) ? $pedido->fecha : now()))->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="display-6 text-muted mb-3"><i class="fas fa-shopping-cart opacity-50"></i></div>
                                            <p class="text-muted mb-0">No hay pedidos registrados</p>
                                            <a href="{{ route('pedidos.create') }}" class="btn btn-sm btn-outline-success mt-3">
                                                <i class="fas fa-plus me-1"></i> Crear Pedido
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados para mejorar la apariencia -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(to right, #4e73df, #224abe);
    }

    .w-2 {
        width: 6px !important;
    }

    .fs-xs {
        font-size: 0.75rem;
    }

    .rounded-3 {
        border-radius: 0.5rem !important;
    }

    /* Efecto hover en las tarjetas */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Estilos para la tabla */
    .table {
        margin-bottom: 0;
    }

    .table tr {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .table tr:last-child {
        border-bottom: none;
    }
</style>
@endsection
