@extends('layouts.plantillaUsu')
@section('Titulo', 'Ofertas')

@section('css-index')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('contenidoOfertas')
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

        .notificacion {
            position: fixed;
            top: 20px;
            right: -300px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            font-size: 16px;
            font-weight: bold;
            transition: right 0.5s ease-in-out;
            z-index: 1000;
        }

        .notificacion.mostrar {
            right: 20px;
        }

        .btn-comprar {
            background-color: #ff4500;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-comprar:hover {
            background-color: #4b0082;
            transform: scale(1.05);
        }

        nav ul li a {
            color: white;
        }
    </style>

    <section class="ofertas">
        <h2>🔥 <span>Ofertas Especiales</span></h2>
        <div class="ofertas-grid">
            <div class="oferta">
                <img src="img/Hulk.webp" alt="Funko Hulk">
                <h3>Funko Hulk</h3>
                <p class="precio-ant">350 MXN</p>
                <p class="precio-nuevo">250 MXN</p>
                <button class="btn-comprar" onclick="agregarAlCarrito('Funko Hulk')">
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
            <div class="oferta">
                <img src="img/gamora.jpg" alt="Funko Gamora">
                <h3>Funko Gamora</h3>
                <p class="precio-ant">500 MXN</p>
                <p class="precio-nuevo">400 MXN</p>
                <button class="btn-comprar" onclick="agregarAlCarrito('Funko Gamora')">
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
            <div class="oferta">
                <img src="img/rocket.webp" alt="Funko Rocket">
                <h3>Funko Rocket</h3>
                <p class="precio-ant">300 MXN</p>
                <p class="precio-nuevo">220 MXN</p>
                <button class="btn-comprar" onclick="agregarAlCarrito('Funko Rocket')">
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
            <div class="oferta">
                <img src="img/daredevil.jpg" alt="Funko Daredevil">
                <h3>Funko Daredevil</h3>
                <p class="precio-ant">600 MXN</p>
                <p class="precio-nuevo">450 MXN</p>
                <button class="btn-comprar" onclick="agregarAlCarrito('Funko Daredevil')">
                    <i class="fas fa-shopping-cart"></i> Agregar al Carrito
                </button>
            </div>
        </div>
    </section>

    <div id="notificacion" class="notificacion">Producto agregado al carrito</div>

    <script>
        function agregarAlCarrito(nombreProducto) {
            let notificacion = document.getElementById('notificacion');
            notificacion.innerHTML = `✅ ${nombreProducto} se agregó al carrito`;
            notificacion.classList.add('mostrar');

            setTimeout(() => {
                notificacion.classList.remove('mostrar');
            }, 3000);
        }
    </script>
@endsection
