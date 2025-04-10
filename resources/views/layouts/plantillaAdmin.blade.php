<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('Titulo')</title>
    @vite(['resources/js/app.js'])
    @yield('css-index')
    @yield('css-gestionProductos')
    @yield('css-gestionInventario')
    @yield('css-gestionPedidos')
    @yield('css-gestionUsuarios')
    @yield('css-gestionPromociones')
    @yield('css-Reportes')
    @yield('css-configuracion')
    @yield('css-gestionProvedores')
</head>
<body>
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{route('rutainicioAdmin')}}"><i class="fas fa-chart-line"></i> Resumen General</a></li>
            <li><a href="{{route('rutagestionProductos')}}"><i class="fas fa-box"></i> Gestión de Productos</a></li>
            <li><a href="{{route('rutagestionInventario')}}"><i class="fas fa-warehouse"></i> Gestión de Inventario</a></li>
            <li><a href="{{route('rutagestionPedidos')}}"><i class="fas fa-shopping-cart"></i> Gestión de Pedidos</a></li>
            <li><a href="{{route('rutagestionUsuarios')}}"><i class="fas fa-users"></i> Gestión de Usuarios</a></li>
            <li><a href="{{route('rutagestionPromociones')}}"><i class="fas fa-tags"></i> Gestión de Promociones</a></li>
            <li><a href="{{route('rutareportes')}}"><i class="fas fa-chart-pie"></i> Reporte de Análisis</a></li>
            <li><a href="{{route('rutaconfiguracion')}}"><i class="fas fa-cogs"></i> Configuración del Sistema</a></li>
            <li><a href="{{route('rutagestionProvedores')}}"><i class="fas fa-truck"></i> Gestión de Proveedores</a></li>
            <li><a href="{{route('rutaindex')}}"><i class="fas fa-home"></i> Cerrar Sesion</a></li>

        </ul>
    </aside>

    <div class="container">
        @yield('contenidoInicioAdmin')
        @yield('contenidogestionProductos')
        @yield('contenidogestionInventario')
        @yield('contenidogestionPedidos')
        @yield('contenidogestionUsuarios')
        @yield('contenidogestionPromociones')
        @yield('contenidoReportes')
        @yield('contenidoConfiguracion')
        @yield('contenidogestionProvedores')
    </div>


</body>
</html>
