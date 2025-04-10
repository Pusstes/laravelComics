@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestion de Promociones')
@section('css-gestionPromociones')
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
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 15px;
        font-size: 22px;
        text-transform: uppercase;
        border-bottom: 2px solid #ff8a00;
        padding-bottom: 10px;
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
    }

    /* 🔹 Formulario de Promoción */
    .form-container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        border-left: 5px solid #ff8a00;
    }

    label {
        display: block;
        font-weight: bold;
        margin: 8px 0;
    }

    input {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn-guardar {
        background: #ff8a00;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        display: block;
        width: 100%;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn-guardar:hover {
        background: #e57c00;
        transform: scale(1.05);
    }

    /* 🔹 Tabla de Promociones */
    .tabla-container {
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
        border-left: 5px solid #2a5298;
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
        background: #2a5298;
        color: white;
    }

    .btn-editar {
        background: #1abc9c;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    .btn-editar:hover {
        background: #16a085;
        transform: scale(1.1);
    }
</style>
@endsection
@section('contenidogestionPromociones')
<!-- Contenido principal -->
<div class="content">
    <h2>Gestión de Promociones</h2>

    <!-- Formulario para crear promoción -->
    <div class="form-container">
        <label>Nombre de la Promoción:</label>
        <input type="text" id="nombrePromo">

        <label>Descuento (%):</label>
        <input type="number" id="descuentoPromo" min="1" max="100">

        <label>Productos Afectados (IDs separados por coma):</label>
        <input type="text" id="productosPromo">

        <label>Fecha de Inicio:</label>
        <input type="date" id="fechaInicio">

        <label>Fecha de Fin:</label>
        <input type="date" id="fechaFin">

        <button class="btn-guardar" onclick="guardarPromocion()">Guardar Promoción</button>
    </div>

    <!-- Tabla de promociones activas -->
<div class="tabla-container">
<h3>Promociones Activas</h3>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descuento</th>
            <th>Productos Afectados</th>
            <th>Fecha de Validez</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="tablaPromociones">
        <tr>
            <td>Descuento 10% en Cómics</td>
            <td>10%</td>
            <td>Cómics</td>
            <td>01/03/2025 - 31/03/2025</td>
            <td><button class="btn-aplicar">Aplicar</button></td>
        </tr>
        <tr>
            <td>Compra 2, Lleva 1 Gratis</td>
            <td>1 Producto Gratis</td>
            <td>Figuras de Acción</td>
            <td>05/03/2025 - 20/03/2025</td>
            <td><button class="btn-aplicar">Aplicar</button></td>
        </tr>
        <tr>
            <td>Descuento 15% en Pedido Mayor a $500</td>
            <td>15%</td>
            <td>Todos los productos</td>
            <td>06/03/2025 - 15/03/2025</td>
            <td><button class="btn-aplicar">Aplicar</button></td>
        </tr>
    </tbody>
</table>
</div>

<script>
    function guardarPromocion() {
        let nombre = document.getElementById("nombrePromo").value;
        let descuento = document.getElementById("descuentoPromo").value;
        let productos = document.getElementById("productosPromo").value;
        let inicio = document.getElementById("fechaInicio").value;
        let fin = document.getElementById("fechaFin").value;

        let nuevaFila = `<tr>
            <td>${nombre}</td>
            <td>${descuento}%</td>
            <td>${productos}</td>
            <td>${inicio} - ${fin}</td>
            <td><button class="btn-editar">Editar</button></td>
        </tr>`;

        document.getElementById("tablaPromociones").innerHTML += nuevaFila;
    }
</script>

@endsection
