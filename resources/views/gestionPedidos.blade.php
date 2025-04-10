@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestion de Pedidos')
@section('css-gestionPedidos')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
    }

    /* 🔹 Barra lateral */
    .sidebar {
        width: 250px;
        background: linear-gradient(135deg, #232526, #414345);
        color: white;
        height: 100vh;
        padding-top: 20px;
        position: fixed;
        box-shadow: 5px 0 10px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease-in-out;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 15px;
        font-size: 22px;
        text-transform: uppercase;
        border-bottom: 2px solid #ff8a00;
        padding-bottom: 10px;
        font-weight: bold;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 12px;
        transition: background 0.3s, transform 0.2s;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        font-size: 16px;
    }

    .sidebar ul li i {
        width: 25px;
        text-align: center;
        font-size: 18px;
        margin-right: 10px;
    }

    .sidebar ul li:hover {
        background: #ff8a00;
        transform: scale(1.05);
    }

    /* 🔹 Contenido principal */
    .content {
        margin-left: 250px;
        padding: 20px;
        width: 100%;
        min-height: 100vh;
        background: #f4f6f9;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2a5298;
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* 🔹 Tabla de pedidos */
    .container {
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        border-left: 5px solid #ff8a00;
        animation: slideUp 0.5s ease-in-out;
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background: #ff8a00;
        color: white;
    }

    .estado-pendiente { background: #e74c3c; color: white; padding: 5px; border-radius: 5px; }
    .estado-proceso { background: #f1c40f; color: white; padding: 5px; border-radius: 5px; }
    .estado-enviado { background: #3498db; color: white; padding: 5px; border-radius: 5px; }
    .estado-entregado { background: #2ecc71; color: white; padding: 5px; border-radius: 5px; }

    .btn-detalles, .btn-actualizar {
        background: #ff8a00;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    .btn-detalles:hover, .btn-actualizar:hover {
        background: #e57c00;
        transform: scale(1.1);
    }

    /* 🔹 Modal Detalles */
    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        width: 350px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        text-align: center;
    }

    .modal img {
        width: 100px;
        margin-bottom: 10px;
    }

    .close {
        background: red;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        border: none;
    }

    /* 🔹 Mensaje de actualización */
    .mensaje {
        position: fixed;
        top: 20px;
        right: -300px;
        background: #27ae60;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: right 0.5s ease-in-out;
    }
</style>
@endsection
@section('contenidogestionPedidos')
<div class="content">
    <div class="container">
        <h2>Gestión de Pedidos</h2>
        <table>
            <thead>
                <tr>
                    <th>Pedido ID</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1001</td>
                    <td>04/03/2025</td>
                    <td>$599.00</td>
                    <td class="estado-pendiente">Pendiente</td>
                    <td>
                        <button class="btn-detalles" onclick="mostrarDetalles(1)">Ver Detalles</button>
                        <button class="btn-actualizar" onclick="actualizarEstado(this)">Actualizar</button>
                    </td>
                </tr>
                <tr>
                    <td>#1002</td>
                    <td>04/03/2025</td>
                    <td>$799.00</td>
                    <td class="estado-enviado">Enviado</td>
                    <td>
                        <button class="btn-detalles" onclick="mostrarDetalles(2)">Ver Detalles</button>
                        <button class="btn-actualizar" onclick="actualizarEstado(this)">Actualizar</button>
                    </td>
                </tr>
                <tr>
                    <td>#1003</td>
                    <td>05/03/2025</td>
                    <td>$450.00</td>
                    <td class="estado-entregado">Entregado</td>
                    <td>
                        <button class="btn-detalles" onclick="mostrarDetalles(3)">Ver Detalles</button>
                        <button class="btn-actualizar" onclick="actualizarEstado(this)">Actualizar</button>
                    </td>
                </tr>
                <tr>
                    <td>#1004</td>
                    <td>06/03/2025</td>
                    <td>$350.00</td>
                    <td class="estado-pendiente">Pendiente</td>
                    <td>
                        <button class="btn-detalles" onclick="mostrarDetalles(4)">Ver Detalles</button>
                        <button class="btn-actualizar" onclick="actualizarEstado(this)">Actualizar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Detalles -->
<div id="modal" class="modal">
    <img id="modal-img" src="" alt="Producto">
    <p><strong id="producto-name">Producto:</strong></p>
    <p><strong id="producto-price">Precio:</strong></p>
    <button class="close" onclick="cerrarDetalles()">Cerrar</button>
</div>

<script>
    function mostrarDetalles(productId) {
        const productos = [
            { name: "Cómic Spider-Man", price: "$599.00", img: "img/comic-spider.webp" },
            { name: "Figura de Batman", price: "$799.00", img: "img/figura-batman.jpg" },
            { name: "Cómic X-Men", price: "$450.00", img: "img/comic-xmen.jpg" },
            { name: "Figura de Iron Man", price: "$350.00", img: "img/figura-iron.webp" }
        ];

        const producto = productos[productId - 1];

        document.getElementById("modal-img").src = producto.img;
        document.getElementById("producto-name").textContent = "Producto: " + producto.name;
        document.getElementById("producto-price").textContent = "Precio: " + producto.price;

        document.getElementById("modal").style.display = "block";
    }

    function cerrarDetalles() {
        document.getElementById("modal").style.display = "none";
    }

    function actualizarEstado(btn) {
        const estadoCell = btn.closest("tr").querySelector("td.estado-pendiente, td.estado-enviado, td.estado-entregado");

        if (estadoCell.classList.contains("estado-pendiente")) {
            estadoCell.classList.remove("estado-pendiente");
            estadoCell.classList.add("estado-enviado");
            estadoCell.textContent = "Enviado";
        } else if (estadoCell.classList.contains("estado-enviado")) {
            estadoCell.classList.remove("estado-enviado");
            estadoCell.classList.add("estado-entregado");
            estadoCell.textContent = "Entregado";
        } else {
            estadoCell.classList.remove("estado-entregado");
            estadoCell.classList.add("estado-pendiente");
            estadoCell.textContent = "Pendiente";
        }
    }
</script>
@endsection
