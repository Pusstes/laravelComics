@extends('layouts.plantillaUsu')
@section('Titulo', 'Pago')

@section('css-inicio')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection
<style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #4b0082, #ff4500);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .contenedor3 {
            max-width: 900px;
            margin: auto;
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            gap: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .seccion {
            width: 48%;
            padding: 15px;
            border-radius: 5px;
            background: #f8f8f8;
        }

        h2 {
            color: #ff4500;
        }

        .direccion label, .pago label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        .direccion input, .pago input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pago select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        .resumen {
            background: white;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
        }

        .resumen table {
            width: 100%;
            border-collapse: collapse;
        }

        .resumen th, .resumen td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .btn-confirmar {
            background-color: #ff4500;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-confirmar:hover {
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
    </style>
</head>
<body>

    <?php include 'php/navbar.php'; ?>

    <div class="contenedor3">
        <!-- Sección de Dirección y Método de Pago -->
        <div class="seccion">
            <h2>📍 Dirección de Envío</h2>
            <form class="direccion">
                <label for="direccion">Selecciona una dirección:</label>
                <select id="direccion">
                    <option value="<?php echo $direccion_guardada; ?>"><?php echo $direccion_guardada; ?></option>
                    <option value="nueva">Ingresar una nueva dirección</option>
                </select>

                <input type="text" id="nuevaDireccion" placeholder="Escribe tu nueva dirección" style="display: none;">
            </form>

            <h2>💳 Método de Pago</h2>
            <form class="pago">
                <label for="tarjeta">Número de Tarjeta:</label>
                <input type="text" id="tarjeta" placeholder="1234 5678 9123 4567">

                <label for="vencimiento">Fecha de Vencimiento:</label>
                <input type="month" id="vencimiento">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" placeholder="123">
            </form>
        </div>

        <!-- Sección de Resumen del Pedido -->
        <div class="seccion resumen">
            <h2>🛒 Resumen del Pedido</h2>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                </tr>
                <?php foreach ($productos_carrito as $producto): ?>
                    <tr>
                        <td><?php echo $producto["nombre"]; ?></td>
                        <td><?php echo $producto["cantidad"]; ?></td>
                        <td>$<?php echo number_format($producto["precio"], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Subtotal:</strong></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>IVA (16%):</strong></td>
                    <td>$<?php echo number_format($iva, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total a Pagar:</strong></td>
                    <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </table>
            <button class="btn-confirmar">Confirmar Pedido</button>
            <button class="btn-confirmar" onclick="window.location.href='carrito.php'">Volver</button>

        </div>
    </div>

    <?php include 'php/footer.php'; ?>

    <script>
        document.getElementById('direccion').addEventListener('change', function() {
            let nuevaDireccion = document.getElementById('nuevaDireccion');
            if (this.value === 'nueva') {
                nuevaDireccion.style.display = 'block';
            } else {
                nuevaDireccion.style.display = 'none';
            }
        });

        document.querySelector('.btn-confirmar').addEventListener('click', function() {
            alert("¡Pedido confirmado!");
        });
    </script>    <!-- Sección de Suscripción -->
    <section class="suscripcion">
        <h2>Suscríbete para recibir ofertas exclusivas</h2>
        <input type="email" placeholder="Ingresa tu correo">
        <button>Suscribirme</button>
    </section>
@endsection