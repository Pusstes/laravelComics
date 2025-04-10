@extends('layouts.plantillaUsu')
@section('Titulo', 'Carrito')
@section('css-index')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg,rgb(0, 70, 6),rgb(0, 0, 0));
            color: white;
            text-align: center;
            padding: 20px;
        }

        .contenedor2 {
            max-width: 700px;
            margin: auto;
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #ff4500;
        }

        .producto {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            transition: transform 0.3s;
        }

        .producto:hover {
            transform: scale(1.02);
        }

        .producto img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .producto-info {
            flex-grow: 1;
            padding-left: 15px;
            text-align: left;
        }

        .precio {
            font-weight: bold;
            color: #4b0082;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #4b0082;
        }

        .btn-pagar {
            display: block;
            background-color: #ff4500;
            color: white;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-pagar:hover {
            background-color: #4b0082;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Asegurar que la barra de navegación y otras secciones sean blancas */
        nav ul li a {
            color: white;
        }


        /* Estilo del botón de Seguimiento de Pedidos */
.btn-seguimiento {
    display: inline-block;
    background-color: #28a745; /* Verde brillante */
    color: white;
    padding: 12px 20px;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    margin-top: 20px;
    width: auto;
    cursor: pointer;
}

/* Efecto de hover */
.btn-seguimiento:hover {
    background-color: #218838; /* Verde oscuro */
    transform: translateY(-3px); /* Eleva el botón */
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

/* Efecto de focus */
.btn-seguimiento:focus {
    outline: none;
    box-shadow: 0px 0px 8px rgba(41, 167, 69, 0.7); /* Resalta con un foco verde */
}

/* Animación suave de aparición */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.btn-seguimiento {
    animation: fadeIn 1s ease-out;
}

.logo-link {
            text-decoration: none; /* Sin subrayado */
            display: inline-block;
        }

        .logo {
            cursor: pointer; /* Indica que es interactivo */
            transition: transform 0.2s ease-in-out;
            color: #ff8a00; /* Color llamativo */
            font-size: 28px;
        }

        .logo:hover {
            transform: scale(1.05); /* Pequeño efecto de zoom */
            color: #e52e71; /* Cambio de color al pasar el mouse */
        }

    </style>
@endsection

@section('contenidoCarrito')
<div class="contenedor2">
    <h2>🛒 Mi Carrito</h2>

                <div class="producto">
            <img src="img/spiderman.webp" alt="Cómic Spiderman">
            <div class="producto-info">
                <p><strong>Cómic Spiderman</strong></p>
                <p class="precio">$250 MXN</p>
                <p>Cantidad: 1</p>
            </div>
            <p><strong>$250 MXN</strong></p>
        </div>
                <div class="producto">
            <img src="img/batman.jpg" alt="Figura Batman">
            <div class="producto-info">
                <p><strong>Figura Batman</strong></p>
                <p class="precio">$450 MXN</p>
                <p>Cantidad: 1</p>
            </div>
            <p><strong>$450 MXN</strong></p>
        </div>
                <div class="producto">
            <img src="img/superman.jpg" alt="Cómic Superman">
            <div class="producto-info">
                <p><strong>Cómic Superman</strong></p>
                <p class="precio">$200 MXN</p>
                <p>Cantidad: 2</p>
            </div>
            <p><strong>$400 MXN</strong></p>
        </div>

    <p class="total">Total a Pagar: <strong>$1100 MXN</strong></p>

    <a href="{{route('rutapago')}}" class="categoria">Pago</a>

</div>

<a href="seguimiento" class="btn-seguimiento">📦 Seguimiento de Pedidos</a>

@endsection
