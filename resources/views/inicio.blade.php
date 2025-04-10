@extends('layouts.plantillaUsu')
@section('Titulo', 'Inicio')

@section('css-inicio')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('contenidoInicio')
<style>
    body {
        color: white;
        background-color: #222;
    }

    h1, h2, h3, p {
        color: white;
    }

    a {
        color: white;
        text-decoration: none;
    }

    a:hover {
        color: #ffcc00;
    }

    button {
        background-color: #ff8a00;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background-color: #e52e71;
    }

    input {
        color: white;
        background-color: #444;
        border: 1px solid #ff8a00;
        padding: 8px;
    }

    input::placeholder {
        color: #ccc;
    }

    .descripcion, .precio {
        color: white;
    }

    .reseña p {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 10px;
        border-radius: 5px;
    }
</style>

    <!-- Buscador -->
    <section class="search-bar">
        <input type="text" placeholder="🔍 Buscar productos...">
        <button onclick="buscarProducto()">Buscar</button>
    </section>

    <!-- Banner -->
    <div class="banner">
        <p>🔥 ¡Descuentos en cómics y figuras de acción! Hasta 30% OFF 🔥</p>
    </div>

    <!-- Productos Destacados -->
    <section class="productos">
        <h2>📘 Productos Destacados</h2>
        <div class="productos-grid">
            <div class="producto">
                <img src="{{ asset('img/batman1.webp') }}" alt="Batman">
                <h3>Batman Edición Especial</h3>
                <p>Categoría: Cómics</p>
                <p class="precio">Precio: $299 MXN</p>
                <p class="descripcion">Edición especial del Caballero de la Noche con portada holográfica.</p>
            </div>
            <div class="producto">
                <img src="{{ asset('img/spiderman.webp') }}" alt="Spider-Man">
                <h3>Spider-Man Figura de Acción</h3>
                <p>Categoría: Figuras</p>
                <p class="precio">Precio: $499 MXN</p>
                <p class="descripcion">Figura articulada de colección de Spider-Man con accesorios.</p>
            </div>
            <div class="producto">
                <img src="{{ asset('img/iroman.jpg') }}" alt="Iron Man">
                <h3>Iron Man Funko Pop</h3>
                <p>Categoría: Figuras</p>
                <p class="precio">Precio: $379 MXN</p>
                <p class="descripcion">Figura Funko Pop de Iron Man con su icónico traje Mark 50.</p>
            </div>
            <div class="producto">
                <img src="{{ asset('img/superman.jpg') }}" alt="Superman">
                <h3>Superman Cómic Original</h3>
                <p>Categoría: Cómics</p>
                <p class="precio">Precio: $259 MXN</p>
                <p class="descripcion">Reedición del primer cómic de Superman con arte remasterizado.</p>
            </div>
        </div>
    </section>

    <!-- Sección de Información de la Tienda -->
    <section class="info-tienda">
        <h2>Sobre <span>Comic Shop</span></h2>
        <p>Somos una tienda especializada en cómics, figuras de acción y coleccionables. Nuestra misión es acercar el mundo del cómic a todos los fanáticos con los mejores productos y promociones.</p>
    </section>

    <!-- Sección de Categorías -->
    <section class="categorias">
        <h2>Categorías de Productos</h2>
        <div class="categorias-grid">
            <a href="{{route('rutatienda')}}" class="categoria">📖 Cómics</a>
            <a href="{{route('rutatienda')}}" class="categoria">🎭 Figuras de Acción</a>
            <a href="{{route('rutatienda')}}" class="categoria">🧸 Funko Pop</a>
            <a href="{{route('rutatienda')}}" class="categoria">🏆 Coleccionables</a>
        </div>
    </section>

    <!-- Sección de Reseñas -->
    <section class="reseñas">
        <h2>Opiniones de Nuestros Clientes</h2>
        <div class="reseñas-grid">
            <div class="reseña">
                <p>⭐⭐⭐⭐⭐ "Excelente tienda, gran variedad y precios accesibles." - Carlos G.</p>
            </div>
            <div class="reseña">
                <p>⭐⭐⭐⭐ "Muy buena calidad en los productos, envío rápido." - Andrea R.</p>
            </div>
            <div class="reseña">
                <p>⭐⭐⭐⭐⭐ "Me encantó la figura de Spider-Man, llegó en perfecto estado." - Miguel P.</p>
            </div>
        </div>
    </section>

    <!-- Sección de Suscripción -->
    <section class="suscripcion">
        <h2>Suscríbete para recibir ofertas exclusivas</h2>
        <input type="email" placeholder="Ingresa tu correo">
        <button>Suscribirme</button>
    </section>
@endsection
