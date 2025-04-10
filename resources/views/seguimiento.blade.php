@extends('layouts.plantillaUsu')
@section('Titulo', 'Segumiento')

@section('css-inicio')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection
$pedidos = [
    [
        "id" => "ORD12345",
        "fecha" => "2025-03-04",
        "total" => 1150.00,
        "estado" => "En camino",
        "productos" => [
            ["nombre" => "Figura Spider-Man", "cantidad" => 1, "precio" => 650],
            ["nombre" => "Cómic Batman #1", "cantidad" => 2, "precio" => 250]
        ]
    ],
    [
        "id" => "ORD67890",
        "fecha" => "2025-02-28",
        "total" => 450.00,
        "estado" => "Entregado",
        "productos" => [
            ["nombre" => "Cómic Superman #1", "cantidad" => 1, "precio" => 450]
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Pedidos</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, #4b0082, #ff4500);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .contenedor4 {
            max-width: 900px;
            margin: auto;
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #ff4500;
            color: white;
        }

        .btn-detalles {
            background: #4b0082;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-detalles:hover {
            background: #ff4500;
            transform: scale(1.05);
        }

        #detallesPedido {
            display: none;
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

    <div class="contenedor4">
        <h2>📦 Seguimiento de Pedidos</h2>
        <table>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido["id"]; ?></td>
                <td><?php echo $pedido["fecha"]; ?></td>
                <td>$<?php echo number_format($pedido["total"], 2); ?></td>
                <td><?php echo $pedido["estado"]; ?></td>
                <td>
                    <button class="btn-detalles" onclick="mostrarDetalles('<?php echo $pedido["id"]; ?>')">Ver Detalles</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div id="detallesPedido" class="contenedor">
            <h3>🛒 Detalles del Pedido</h3>
            <table id="tablaDetalles">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </table>
            <h3>📍 Ubicación del Paquete</h3>
            <div id="mapaEnvio" style="width: 100%; height: 300px; border-radius: 10px; margin-top: 20px;"></div>
        </div>
    </div>

    <?php include 'php/footer.php'; ?>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        const pedidos = <?php echo json_encode($pedidos); ?>;
        var map = L.map('mapaEnvio').setView([20.5888, -100.3922], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([20.5888, -100.3922]).addTo(map)
            .bindPopup("<b>Querétaro</b><br>Ubicación del paquete.")
            .openPopup();

        function mostrarDetalles(idPedido) {
            let pedido = pedidos.find(p => p.id === idPedido);
            let tabla = document.getElementById("tablaDetalles");
            tabla.innerHTML = `
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            `;

            pedido.productos.forEach(p => {
                let row = `<tr>
                    <td>${p.nombre}</td>
                    <td>${p.cantidad}</td>
                    <td>$${p.precio}</td>
                </tr>`;
                tabla.innerHTML += row;
            });

            document.getElementById("detallesPedido").style.display = "block";
            setTimeout(() => { map.invalidateSize(); }, 300);
        }
    </script>
    <section class="suscripcion">
        <h2>Suscríbete para recibir ofertas exclusivas</h2>
        <input type="email" placeholder="Ingresa tu correo">
        <button>Suscribirme</button>
    </section>
@endsection