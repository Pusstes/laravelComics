@extends('layouts.plantillaAdmin')
@section('Titulo', 'Configuración')
@section('css-configuracion')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    body { display: flex; background: #f4f6f9; }

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

    .sidebar h2 { text-align: center; margin-bottom: 15px; font-size: 22px; border-bottom: 2px solid #ff8a00; padding-bottom: 10px; }
    .sidebar ul { list-style: none; padding: 0; }
    .sidebar ul li { padding: 12px; transition: background 0.3s, transform 0.2s; }
    .sidebar ul li a { text-decoration: none; color: white; display: flex; align-items: center; font-size: 16px; }
    .sidebar ul li i { width: 25px; text-align: center; font-size: 18px; margin-right: 10px; }
    .sidebar ul li:hover { background: #ff8a00; transform: scale(1.05); }

    /* 🔹 Contenido */
    .content { margin-left: 250px; padding: 20px; width: 100%; }
    h2 { text-align: center; margin-bottom: 20px; color: #2a5298; }

    /* 🔹 Sección de Configuración */
    .config-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); margin-bottom: 20px; }

    /* 🔹 Botones */
    button { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 5px; transition: transform 0.2s; }
    .btn-add { background: #28a745; color: white; }
    .btn-delete { background: #dc3545; color: white; }
    .btn-save { background: #007bff; color: white; }
    .btn-save:hover, .btn-add:hover, .btn-delete:hover { transform: scale(1.05); }

    /* 🔹 Tablas */
    table { width: 100%; border-collapse: collapse; margin-top: 20px; border-radius: 10px; overflow: hidden; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: center; transition: background 0.3s; }
    th { background: #2a5298; color: white; }
    tr:hover td { background: #f1f1f1; }

    /* 🔹 Estilos de Entrada */
    input[type="text"], input[type="email"], textarea, select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="email"]:focus, textarea:focus, select:focus {
        border-color: #2a5298;
    }

</style>
@endsection
@section('contenidoConfiguracion')
<!-- Contenido principal -->
<div class="content">
    <h2>Configuración del Sistema</h2>

    <!-- Métodos de Pago -->
    <div class="config-container">
<h3>Métodos de Pago</h3>
<input type="text" id="nuevoMetodo" placeholder="Nuevo método de pago">
<button class="btn-add" onclick="agregarMetodo()">Agregar</button>
<table id="tablaMetodos">
    <thead>
        <tr>
            <th>Aprobadas</th>
            <th>Método</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img src="img/credito.jpeg" alt="Tarjeta de Crédito" width="200" height="150"></td>
            <td>Tarjeta de Crédito</td>
            <td><button class="btn-delete" onclick="eliminarMetodo(this)">Eliminar</button></td>
        </tr>
        <tr>
            <td><img src="img/paypal.png" alt="PayPal" width="200" height="150"></td>
            <td>PayPal</td>
            <td><button class="btn-delete" onclick="eliminarMetodo(this)">Eliminar</button></td>
        </tr>
    </tbody>
</table>
</div>

    <!-- Personalización de Mensajes -->
    <div class="config-container">
        <h3>Personalización de Mensajes</h3>
        <textarea id="mensajeCompra" rows="4">Gracias por tu compra, tu pedido será procesado.</textarea>
        <button class="btn-save" onclick="guardarMensaje()">Guardar Mensaje</button>
    </div>

    <!-- Asignación de Roles -->
    <div class="config-container">
        <h3>Asignar Roles y Permisos</h3>
        <input type="email" id="emailUsuario" placeholder="Correo del usuario">
        <select id="rolUsuario">
            <option value="Administrador">Administrador</option>
            <option value="Editor">Editor</option>
            <option value="Visualizador">Visualizador</option>
        </select>
        <button class="btn-add" onclick="asignarRol()">Asignar</button>
        <table id="tablaRoles">
            <thead>
                <tr>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>admin@example.com</td><td>Administrador</td><td><button class="btn-delete" onclick="eliminarRol(this)">Eliminar</button></td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Agregar método de pago
    function agregarMetodo() {
        let metodo = document.getElementById("nuevoMetodo").value;
        if (metodo.trim() !== "") {
            let table = document.getElementById("tablaMetodos").getElementsByTagName("tbody")[0];
            let row = table.insertRow();
            row.innerHTML = `<td>${metodo}</td><td><button class="btn-delete" onclick="eliminarMetodo(this)">Eliminar</button></td>`;
            document.getElementById("nuevoMetodo").value = "";
        }
    }

    // Eliminar método de pago
    function eliminarMetodo(btn) {
        btn.closest("tr").remove();
    }

    // Asignar rol a usuario
    function asignarRol() {
        let email = document.getElementById("emailUsuario").value;
        let rol = document.getElementById("rolUsuario").value;
        if (email.trim() !== "") {
            let table = document.getElementById("tablaRoles").getElementsByTagName("tbody")[0];
            let row = table.insertRow();
            row.innerHTML = `<td>${email}</td><td>${rol}</td><td><button class="btn-delete" onclick="eliminarRol(this)">Eliminar</button></td>`;
            document.getElementById("emailUsuario").value = "";
        }
    }

    // Eliminar usuario de roles
    function eliminarRol(btn) {
        btn.closest("tr").remove();
    }

    // Guardar mensaje de compra
    function guardarMensaje() {
        let mensaje = document.getElementById("mensajeCompra").value;
        alert("Mensaje guardado: " + mensaje);
    }
</script>
@endsection
