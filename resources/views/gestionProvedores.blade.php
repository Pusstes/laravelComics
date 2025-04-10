@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestión de Proveedores')
@section('css-gestionProvedores')
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
    .sidebar ul li { padding: 12px; transition: background 0.3s, transform 0.3s; }
    .sidebar ul li a { text-decoration: none; color: white; display: flex; align-items: center; font-size: 16px; }
    .sidebar ul li i { width: 25px; text-align: center; font-size: 18px; margin-right: 10px; }
    .sidebar ul li:hover { background: #ff8a00; transform: scale(1.05); }

    /* 🔹 Contenido */
    .content { margin-left: 250px; padding: 20px; width: 100%; }
    h2 { text-align: center; margin-bottom: 20px; color: #2a5298; }

    /* 🔹 Sección */
    .container { background: #ffffff; padding: 20px; border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); margin-bottom: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .container:hover { transform: translateY(-5px); box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2); }

    /* 🔹 Entrada de texto */
    input[type="text"], input[type="email"], select {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    input[type="text"]:focus, input[type="email"]:focus, select:focus {
        border-color: #ff8a00;
        outline: none;
    }

    /* 🔹 Botones */
    button {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
        transition: background 0.3s ease, transform 0.3s;
    }
    .btn-add { background: #28a745; color: white; }
    .btn-delete { background: #dc3545; color: white; }
    .btn-update { background: #007bff; color: white; }
    .btn-add:hover, .btn-delete:hover, .btn-update:hover {
        transform: scale(1.05);
        background: #ff8a00;
    }

    /* 🔹 Tablas */
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: center; transition: background 0.3s; }
    th { background: #2a5298; color: white; }
    tr:hover { background: #f1f1f1; }

    /* 🔹 Animación de carga de tablas */
    tbody {
        opacity: 0;
        animation: fadeIn 0.5s forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection
@section('contenidogestionProvedores')
 <!-- Contenido principal -->
 <div class="content">
    <h2>Gestión de Proveedores</h2>

    <!-- Registro de Proveedores -->
    <div class="container">
        <h3>Registro de Proveedores</h3>
        <input type="text" id="nombreProveedor" placeholder="Nombre del proveedor">
        <input type="text" id="telefonoProveedor" placeholder="Teléfono">
        <input type="email" id="correoProveedor" placeholder="Correo">
        <button class="btn-add" onclick="agregarProveedor()">Registrar</button>
        <table id="tablaProveedores">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Comics & Co.</td><td>123-456-7890</td><td>contacto@comicsco.com</td><td><button class="btn-delete" onclick="eliminarProveedor(this)">Eliminar</button></td></tr>
            </tbody>
        </table>
    </div>

    <!-- Seguimiento de Pedidos -->
    <div class="container">
        <h3>Seguimiento de Pedidos</h3>
        <select id="proveedorPedido">
            <option value="Comics & Co.">Comics & Co.</option>
            <option value="Anime Figures">Anime Figures</option>
        </select>
        <select id="estadoPedido">
            <option value="Pendiente">Pendiente</option>
            <option value="Entregado">Entregado</option>
            <option value="Pagado">Pagado</option>
        </select>
        <button class="btn-update">Actualizar Estado</button>
        <button class="btn-update">Ver Ubicación</button>
    </div>

    <!-- Evaluación de Proveedores -->
    <div class="container">
        <h3>Evaluación de Proveedores</h3>
        <select id="proveedorEvaluacion">
            <option value="Comics & Co.">Comics & Co.</option>
            <option value="Anime Figures">Anime Figures</option>
        </select>
        <label>Entregas a Tiempo:</label>
        <select>
            <option>Malo</option>
            <option>Bueno</option>
            <option>Excelente</option>
        </select>
        <label>Calidad del Producto:</label>
        <select>
            <option>Baja</option>
            <option>Media</option>
            <option>Alta</option>
        </select>
        <button class="btn-update">Guardar Evaluación</button>
    </div>
</div>

<script>
    // Agregar proveedor
    function agregarProveedor() {
        let nombre = document.getElementById("nombreProveedor").value;
        let telefono = document.getElementById("telefonoProveedor").value;
        let correo = document.getElementById("correoProveedor").value;

        if (nombre.trim() !== "" && telefono.trim() !== "" && correo.trim() !== "") {
            let table = document.getElementById("tablaProveedores").getElementsByTagName("tbody")[0];
            let row = table.insertRow();
            row.innerHTML = `<td>${nombre}</td><td>${telefono}</td><td>${correo}</td><td><button class="btn-delete" onclick="eliminarProveedor(this)">Eliminar</button></td>`;
        }
    }

    // Eliminar proveedor
    function eliminarProveedor(btn) {
        btn.closest("tr").remove();
    }
</script>
@endsection
