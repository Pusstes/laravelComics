@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestion de Inventario')
@section('css-gestionInventario')
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
        letter-spacing: 1px;
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

    /* 🔹 Tabla de inventario */
    .container {
        max-width: 800px;
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

    .stock-suficiente {
        background: #2ecc71;
        color: white;
        padding: 5px;
        border-radius: 5px;
    }

    .stock-intermedio {
        background: #f1c40f;
        color: white;
        padding: 5px;
        border-radius: 5px;
    }

    .stock-bajo {
        background: #e74c3c;
        color: white;
        padding: 5px;
        border-radius: 5px;
    }

    .btn-orden {
        background: #ff8a00;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    .btn-orden:hover {
        background: #e57c00;
        transform: scale(1.1);
    }

    /* 🔹 Mensajes de confirmación */
    .mensaje {
        position: fixed;
        top: 20px;
        right: -300px;
        background: #27ae60;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        transition: right 0.5s ease-in-out;
    }

    .mensaje.error {
        background: #e74c3c;
    }
</style>
@endsection

@section('contenidogestionInventario')
<div class="content">
    <div class="container">
        <h2>Gestión de Inventario</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad Disponible</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaInventario">
                <tr>
                    <td>Figura de Batman</td>
                    <td>50</td>
                    <td class="stock-suficiente">Suficiente</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Cómic Spider-Man</td>
                    <td>10</td>
                    <td class="stock-intermedio">Intermedio</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Funko Pop Iron Man</td>
                    <td>2</td>
                    <td class="stock-bajo">Bajo</td>
                    <td><button class="btn-orden" onclick="ordenarProducto()">Generar Orden</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Mensaje de confirmación -->
<div id="mensaje" class="mensaje"></div>

<script>
    function ordenarProducto() {
        let mensaje = document.getElementById("mensaje");
        mensaje.innerHTML = "Orden generada correctamente";
        mensaje.className = "mensaje";
        mensaje.style.right = "20px";
        setTimeout(() => mensaje.style.right = "-300px", 3000);
    }
</script>
@endsection
