@extends('layouts.plantillaUsu')
@section('Titulo', 'Tienda')
@section('css-index')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection
@section('contenidoTienda')
<style>
    /* Hace que todo el texto de la página sea blanco */
    body {
        color: white;
        background-color: #222; /* Fondo oscuro para mejor contraste */
    }

    /* Asegurar que los títulos y párrafos sean blancos */
    h1, h2, h3, p {
        color: white;
    }

    /* Para los enlaces en categorías y navegación */
    a {
        color: white;
        text-decoration: none;
    }

    .filtros {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: linear-gradient(90deg, #ff8a00, #e52e71);
        border-radius: 10px;
        margin: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        animation: fadeIn 1s ease-in-out;
    }
    .filtros select, .filtros button {
        padding: 10px;
        border-radius: 5px;
        border: none;
        transition: all 0.3s ease;
    }
    .filtros button {
        background-color: #ff8a00;
        color: white;
        cursor: pointer;
    }
    .filtros button:hover {
        background-color: #e52e71;
        transform: scale(1.1);
    }

    /* 🔹 Estilos para la notificación */
    .notificacion {
        position: fixed;
        top: 20px;
        right: -300px;
        background: #27ae60;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: right 0.5s ease-in-out;
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 1000;
    }

    .notificacion i {
        font-size: 20px;
    }

    /* Aparece en pantalla */
    .notificacion.mostrar {
        right: 20px;
    }
    /* Asegurar que la barra de navegación y otras secciones sean blancas */
    nav ul li a {
        color: white;
    }
</style>
</head>
<body>

<!-- Notificación de éxito -->
<div id="notificacion-carrito" class="notificacion">
    <i class="fas fa-check-circle"></i> Producto agregado al carrito
</div>

<section class="filtros">
    <h2>Filtrar Productos</h2>
    <label for="categoria">Categoría:</label>
    <select id="categoria">
        <option value="todos">Todos</option>
        <option value="comics">Cómics</option>
        <option value="figuras">Figuras de Acción</option>
        <option value="ropa">Ropa</option>
    </select>

    <label for="precio">Precio:</label>
    <select id="precio">
        <option value="todos">Todos</option>
        <option value="0-200">$0 - $200</option>
        <option value="201-400">$201 - $400</option>
        <option value="401-600">$401 - $600</option>
    </select>

    <label for="disponibilidad">Disponibilidad:</label>
    <select id="disponibilidad">
        <option value="todos">Todos</option>
        <option value="disponible">Disponible</option>
        <option value="agotado">Agotado</option>
    </select>
    <button onclick="filtrarProductos()">Aplicar Filtros</button>
</section>

<section class="productos">
    <h2>🛒 <span>Nuestra Tienda</span></h2>
    <div class="productos-grid" id="productos-grid">
                        <div class="producto" data-categoria="comics" data-precio="250" data-disponible="disponible">
                <a href="producto.php?id=1">
                    <img src="img/comic-spider.webp" alt="Cómic Spiderman">
                    <h3>Cómic Spiderman</h3>
                    <p class="precio">$250 MXN</p>
                </a>
                <button class="btn-comprar" >
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="figuras" data-precio="450" data-disponible="agotado">
                <a href="producto.php?id=2">
                    <img src="img/figura-batman.jpg" alt="Figura Batman">
                    <h3>Figura Batman</h3>
                    <p class="precio">$450 MXN</p>
                </a>
                <button class="btn-comprar" disabled>
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="comics" data-precio="200" data-disponible="disponible">
                <a href="producto.php?id=3">
                    <img src="img/comic-super.jpg" alt="Cómic Superman">
                    <h3>Cómic Superman</h3>
                    <p class="precio">$200 MXN</p>
                </a>
                <button class="btn-comprar" >
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="ropa" data-precio="350" data-disponible="disponible">
                <a href="producto.php?id=4">
                    <img src="img/funko-spider.webp" alt="Funko Spiderman">
                    <h3>Funko Spiderman</h3>
                    <p class="precio">$350 MXN</p>
                </a>
                <button class="btn-comprar" >
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="figuras" data-precio="500" data-disponible="disponible">
                <a href="producto.php?id=5">
                    <img src="img/figura-iron.webp" alt="Figura Iron Man">
                    <h3>Figura Iron Man</h3>
                    <p class="precio">$500 MXN</p>
                </a>
                <button class="btn-comprar" >
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="comics" data-precio="180" data-disponible="agotado">
                <a href="producto.php?id=6">
                    <img src="img/comic-xmen.jpg" alt="Cómic X-Men">
                    <h3>Cómic X-Men</h3>
                    <p class="precio">$180 MXN</p>
                </a>
                <button class="btn-comprar" disabled>
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                        <div class="producto" data-categoria="ropa" data-precio="300" data-disponible="disponible">
                <a href="producto.php?id=7">
                    <img src="img/funko-groot.jpg" alt="Funko Groot">
                    <h3>Funko Groot</h3>
                    <p class="precio">$300 MXN</p>
                </a>
                <button class="btn-comprar" >
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
                </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const botonesCompra = document.querySelectorAll(".btn-comprar");
    const notificacion = document.getElementById("notificacion-carrito");

    botonesCompra.forEach(boton => {
        boton.addEventListener("click", function () {
            if (!this.disabled) {
                mostrarNotificacion();
            }
        });
    });

    function mostrarNotificacion() {
        notificacion.classList.add("mostrar");
        setTimeout(() => {
            notificacion.classList.remove("mostrar");
        }, 3000); // Ocultar después de 3 segundos
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // 🛒 Funcionalidad de agregar productos al carrito
    const botonesCompra = document.querySelectorAll(".btn-comprar");
    const notificacion = document.getElementById("notificacion-carrito");

    botonesCompra.forEach(boton => {
        boton.addEventListener("click", function () {
            if (!this.disabled) {
                mostrarNotificacion();
            }
        });
    });

    function mostrarNotificacion() {
        notificacion.classList.add("mostrar");
        setTimeout(() => {
            notificacion.classList.remove("mostrar");
        }, 3000);
    }

    // 🔍 Funcionalidad de filtros de productos
    function filtrarProductos() {
        const categoria = document.getElementById("categoria").value;
        const precio = document.getElementById("precio").value;
        const disponibilidad = document.getElementById("disponibilidad").value;
        const productos = document.querySelectorAll(".producto");

        productos.forEach(producto => {
            let categoriaProducto = producto.getAttribute("data-categoria");
            let precioProducto = parseInt(producto.getAttribute("data-precio"));
            let disponibilidadProducto = producto.getAttribute("data-disponible");

            let cumpleCategoria = (categoria === "todos" || categoria === categoriaProducto);
            let cumplePrecio = (precio === "todos" || (precio === "0-200" && precioProducto <= 200) ||
                (precio === "201-400" && precioProducto > 200 && precioProducto <= 400) ||
                (precio === "401-600" && precioProducto > 400 && precioProducto <= 600));
            let cumpleDisponibilidad = (disponibilidad === "todos" || disponibilidad === disponibilidadProducto);

            if (cumpleCategoria && cumplePrecio && cumpleDisponibilidad) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }
        });
    }

    // Evento para el botón de filtros
    document.querySelector(".filtros button").addEventListener("click", filtrarProductos);
});

 </script>
@endsection
