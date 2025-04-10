<nav class="navbar navbar-expand-lg shadow-sm mb-4 navbar-dark">
    <div class="container">
        <!-- Logo y marca -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <div class="bg-primary bg-opacity-25 text-white rounded-circle p-2 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                <i class="fas fa-store"></i>
            </div>
            Tienda Cómics
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('productos.*') ? 'active bg-white bg-opacity-10 rounded-pill' : '' }}"
                       href="{{ route('productos.index') }}">
                        <i class="fas fa-box-open me-1"></i>Productos
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('categorias.*') ? 'active bg-white bg-opacity-10 rounded-pill' : '' }}"
                       href="{{ route('categorias.index') }}">
                        <i class="fas fa-tags me-1"></i>Categorías
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('proveedores.*') ? 'active bg-white bg-opacity-10 rounded-pill' : '' }}"
                       href="{{ route('proveedores.index') }}">
                        <i class="fas fa-truck me-1"></i>Proveedores
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('pedidos.*') ? 'active bg-white bg-opacity-10 rounded-pill' : '' }}"
                       href="{{ route('pedidos.index') }}">
                        <i class="fas fa-shopping-cart me-1"></i>Pedidos
                    </a>
                </li>
                @if(auth()->user()['role'] === 'Administrador')
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ request()->routeIs('usuarios.*') ? 'active bg-white bg-opacity-10 rounded-pill' : '' }}"
                       href="{{ route('usuarios.index') }}">
                        <i class="fas fa-users me-1"></i>Usuarios
                    </a>
                </li>
                @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                @auth
                <!-- Notificaciones (elemento visual agregado) -->
                <li class="nav-item dropdown me-2">
                    <a class="nav-link position-relative p-2" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="rounded-circle bg-white bg-opacity-10 p-1 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="fas fa-bell"></i>
                        </div>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            2 <span class="visually-hidden">notificaciones</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 py-0" style="width: 300px;">
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="mb-0 fw-bold">Notificaciones</h6>
                        </div>
                        <div class="p-2">
                            <a href="#" class="dropdown-item p-2 rounded-3">
                                <div class="d-flex">
                                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-medium">Nuevo pedido completado</p>
                                        <p class="text-muted small mb-0">Hace 5 minutos</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item p-2 rounded-3">
                                <div class="d-flex">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-medium">Stock bajo en 3 productos</p>
                                        <p class="text-muted small mb-0">Hace 1 hora</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 bg-light border-top text-center">
                            <a href="#" class="text-decoration-none small">Ver todas</a>
                        </div>
                    </div>
                </li>

                <!-- Perfil de usuario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="rounded-circle bg-white bg-opacity-10 p-1 d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <span>{{ auth()->user()['nombre'] }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 py-0">
                        <div class="p-3 border-bottom">
                            <p class="mb-0 fw-bold">{{ auth()->user()['nombre'] }}</p>
                            <p class="text-muted small mb-0">{{ auth()->user()['role'] }}</p>
                        </div>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user me-2 text-muted"></i>Mi Perfil</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2 text-muted"></i>Configuración</a></li>
                        <li><hr class="dropdown-divider my-0"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link btn {{ request()->routeIs('login') ? 'btn-outline-light' : 'btn-outline-light bg-white bg-opacity-10' }} rounded-pill px-3 me-2" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary rounded-pill px-3" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i>Registrarse
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Estilos personalizados para el navbar -->
<style>
    .navbar {
        background: linear-gradient(to right, #4e73df, #224abe);
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
    }

    .navbar .dropdown-menu {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .navbar .nav-link {
        transition: all 0.2s ease;
    }

    .navbar .nav-link:hover:not(.active):not(.btn) {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 2rem;
    }

    /* Efecto hover para items de dropdown */
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    /* Efecto activo para enlaces en la navegación */
    .navbar .nav-link.active {
        font-weight: 500;
    }
</style>
