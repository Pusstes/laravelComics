<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Iconos FontAwesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>@yield('Titulo')</title>

    {{-- Estilos y scripts con Vite --}}
    @vite(['resources/js/app.js'])

    {{-- Estilos específicos por vista --}}
    @yield('css-inicio')
    @yield('css-index')

    {{-- Estilos para la navbar --}}
    <style>
         .navbar {
        background: linear-gradient(90deg, #ff8a00, #e52e71);
        padding: 15px 0;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-size: 320px;
        font-weight: bold;
        color: #fff !important;
        transition: transform 0.2s ease-in-out;
    }

    .navbar-brand:hover {
        transform: scale(1.08);
    }

    .nav-link {
        font-size: 18px;
        color: #fff !important;
        margin: 0 10px;
        transition: color 0.3s ease-in-out, transform 0.2s ease-in-out;
    }

    .nav-link:hover {
        color: #ffde59 !important;
        transform: scale(1.05);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.8);
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <header>
        <nav class="navbar navbar-expand-lg bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('rutainicio') }}">Comic Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutainicio') }}"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutatienda') }}"><i class="fas fa-store"></i> Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutaoferta') }}"><i class="fas fa-tags"></i> Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutacontacto') }}"><i class="fas fa-envelope"></i> Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutaperfil') }}"><i class="fas fa-user"></i> Mi Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rutacarrito') }}"><i class="fas fa-shopping-cart"></i> Mi Carrito</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- Contenido dinámico por sección --}}
    <div class="container">
        @yield('contenidoInicio')
        @yield('contenidoTienda')
        @yield('contenidoOfertas')
        @yield('contenidoContacto')
        @yield('contenidoPerfil')
        @yield('contenidoCarrito')
    </div>

    {{-- Footer --}}
    <footer class="mt-5 p-4 bg-black text-white text-center">
        <p>© 2025 | Todos los derechos reservados</p>
        <div class="redes d-flex justify-content-center gap-4 mt-2">
            <a href="#" class="facebook d-flex align-items-center gap-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="social-logo" width="24"> Facebook
            </a>
            <a href="#" class="instagram d-flex align-items-center gap-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram" class="social-logo" width="24"> Instagram
            </a>
        </div>
    </footer>

</body>
</html>
