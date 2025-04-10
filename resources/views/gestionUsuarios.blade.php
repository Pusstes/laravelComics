@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestión de Usuarios')
@section('css-gestionUsuarios')
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

    /* 🔹 Tabla de usuarios */
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

    .btn-historial, .btn-bloquear {
        background: #ff8a00;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    .btn-historial:hover, .btn-bloquear:hover {
        background: #e57c00;
        transform: scale(1.1);
    }

    /* 🔹 Modal Historial */
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
        z-index: 999;
    }

    .close {
        background: red;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        border: none;
    }

    /* 🔹 Estilos para las imágenes del historial */
    .product-images {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .product-images img {
        width: 48%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* 🔹 Mensaje de acción */
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
@section('contenidogestionUsuarios')
<div class="content">
    <div class="container">
        <h2>Gestión de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Historial de Compras</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kevin Ordaz</td>
                    <td>elkevin@example.com</td>
                    <td><button class="btn-historial" onclick="mostrarHistorial()">Ver Historial</button></td>
                    <td><button class="btn-bloquear" onclick="bloquearUsuario(this)">Bloquear</button></td>
                </tr>
                <tr>
                    <td>Mariano Orduña</td>
                    <td>elmariana@example.com</td>
                    <td><button class="btn-historial" onclick="mostrarHistorial()">Ver Historial</button></td>
                    <td><button class="btn-bloquear" onclick="bloquearUsuario(this)">Bloquear</button></td>
                </tr>
                <tr>
                    <td>Laia Durán</td>
                    <td>laiaduran@example.com</td>
                    <td><button class="btn-historial" onclick="mostrarHistorial()">Ver Historial</button></td>
                    <td><button class="btn-bloquear" onclick="bloquearUsuario(this)">Bloquear</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Historial -->
<div id="modal" class="modal">
    <p><strong>Historial de Compras:</strong></p>
    <ul>
        <li>Cómic Spider-Man - $599.00</li>
        <li>Figura de Batman - $799.00</li>
    </ul>
    <div class="product-images">
        <img src="img/comic-spider.webp" alt="Cómic Spider-Man">
        <img src="img/figura-batman.jpg" alt="Figura de Batman">
    </div>
    <button class="close" onclick="cerrarHistorial()">Cerrar</button>
</div>

<script>
    function mostrarHistorial() {
        document.getElementById("modal").style.display = "block";
    }

    function cerrarHistorial() {
        document.getElementById("modal").style.display = "none";
    }

    function bloquearUsuario(btn) {
        if (btn.innerText === "Bloquear") {
            btn.innerText = "Desbloquear";
            btn.style.background = "red";
        } else {
            btn.innerText = "Bloquear";
            btn.style.background = "#ff8a00";
        }
    }
</script>
@endsection
