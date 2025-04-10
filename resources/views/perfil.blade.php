@extends('layouts.plantillaUsu')
@section('Titulo', 'Perfil')

@section('css-index')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(90deg, #4b0082, rgb(0, 0, 0));
        color: white;
        text-align: center;
        padding: 20px;
    }

    .contenedor1 {
        max-width: 700px;
        margin: auto;
        background: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(165, 156, 156, 0.3);
        animation: fadeIn 1s ease-in-out;
    }

    h2 {
        color: #ff4500;
    }

    .formulario {
        text-align: left;
    }

    .formulario label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .formulario input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn-guardar {
        background-color: #ff4500;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 15px;
        width: 100%;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-guardar:hover {
        background-color: #4b0082;
        transform: scale(1.05);
    }

    .historial {
        margin-top: 20px;
    }

    .tabla {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .tabla th, .tabla td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .tabla th {
        background-color: #4b0082;
        color: white;
    }

    .estado {
        font-weight: bold;
        padding: 5px;
        border-radius: 5px;
    }

    .estado.enviado { background: #2ecc71; color: white; }
    .estado.preparacion { background: #f1c40f; color: black; }
    .estado.entregado { background: #3498db; color: white; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    nav ul li a {
        color: white;
    }
</style>
@endsection

@section('contenidoPerfil')
<div class="contenedor1">
    <h2>👤 Mi Perfil</h2>

    <form class="formulario">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" id="nombre" value="Gael Arriaga Felipe" readonly>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" value="gael@example.com" readonly>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" value="Querétaro, México" readonly>

        <button type="button" class="btn-guardar" id="editarPerfil">Editar Información</button>
    </form>

    <div class="historial">
        <h2>📦 Historial de Compras</h2>
        <table class="tabla">
            <tr>
                <th>ID Compra</th>
                <th>Fecha</th>
                <th>Total (MXN)</th>
                <th>Estado</th>
            </tr>
            <tr>
                <td>#1001</td>
                <td>2025-02-20</td>
                <td>$850</td>
                <td><span class="estado enviado">Enviado</span></td>
            </tr>
            <tr>
                <td>#1002</td>
                <td>2025-02-25</td>
                <td>$450</td>
                <td><span class="estado preparacion">Entrega en preparación</span></td>
            </tr>
            <tr>
                <td>#1003</td>
                <td>2025-03-01</td>
                <td>$1200</td>
                <td><span class="estado entregado">Entregado</span></td>
            </tr>
        </table>
    </div>
</div>

<script>
    document.getElementById('editarPerfil').addEventListener('click', function () {
        let inputs = document.querySelectorAll('.formulario input');
        let btn = this;

        if (btn.textContent === "Editar Información") {
            inputs.forEach(input => input.removeAttribute('readonly'));
            btn.textContent = "Guardar Cambios";
            btn.style.backgroundColor = "#2ecc71";
        } else {
            inputs.forEach(input => input.setAttribute('readonly', true));
            btn.textContent = "Editar Información";
            btn.style.backgroundColor = "#ff4500";
            alert("¡Cambios guardados correctamente!");
        }
    });
</script>
@endsection
