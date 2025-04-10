@extends('layouts.plantillaAdmin')
@section('Titulo', 'Gestión de Productos')
@section('css-gestionProductos')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        animation: fadeInBody 1s ease-in-out;
    }

    @keyframes fadeInBody {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .sidebar {
        width: 260px;
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
        font-size: 24px;
        text-transform: uppercase;
        border-bottom: 3px solid #ff8a00;
        padding-bottom: 10px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 14px;
        transition: all 0.3s;
        border-radius: 5px;
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
        transition: all 0.3s ease-in-out;
    }

    .content {
        margin-left: 260px;
        padding: 25px;
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

    .container {
        max-width: 750px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        border-left: 6px solid #ff8a00;
        animation: slideUp 0.5s ease-in-out;
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .btn-add {
        display: block;
        width: 100%;
        background: #ff8a00;
        color: white;
        padding: 14px;
        text-align: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .btn-add:hover {
        background: #e57c00;
        transform: scale(1.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        overflow: hidden;
        border-radius: 10px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 14px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background: #ff8a00;
        color: white;
    }

    .btn {
        padding: 8px 14px;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-edit {
        background: #3498db;
        color: white;
    }

    .btn-edit:hover {
        background: #217dbb;
        transform: scale(1.1);
    }

    .btn-delete {
        background: #e74c3c;
        color: white;
    }

    .btn-delete:hover {
        background: #c0392b;
        transform: scale(1.1);
    }

    tr {
        transition: 0.3s;
    }

    tr:hover {
        background: #f9f9f9;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: -300px;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: right 0.3s ease-in-out;
    }

    .notification.show {
        right: 20px;
    }

    .recuadro-productos {
        background: white;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .recuadro-productos:hover {
        transform: scale(1.02);
    }

    .recuadro-productos h2 {
        color: black;
        font-size: 22px;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 15px;
    }
</style>
@endsection
@section('contenidogestionProductos')
<div class="content">
    <h2>Gestión de Productos</h2>
    <div class="container recuadro-productos">
        <button class="btn-add">Agregar Producto</button>
        <table id="productos-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Cómic Marvel</td>
                    <td>$200</td>
                    <td>Comics</td>
                    <td>
                        <button class="btn-edit" onclick="editarProducto(this)">Editar</button>
                        <button class="btn-delete" onclick="eliminarProducto(this)">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Figura Star Wars</td>
                    <td>$500</td>
                    <td>Figuras</td>
                    <td>
                        <button class="btn-edit" onclick="editarProducto(this)">Editar</button>
                        <button class="btn-delete" onclick="eliminarProducto(this)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="notification" class="notification">Producto agregado</div>

<script>
    function showNotification(message) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    function agregarProducto() {
        let table = document.getElementById("productos-table").getElementsByTagName('tbody')[0];
        let newRow = table.insertRow();
        let idCell = newRow.insertCell(0);
        let productoCell = newRow.insertCell(1);
        let precioCell = newRow.insertCell(2);
        let categoriaCell = newRow.insertCell(3);
        let accionesCell = newRow.insertCell(4);

        idCell.textContent = table.rows.length;
        productoCell.textContent = "Nuevo Producto";
        precioCell.textContent = "$0";
        categoriaCell.textContent = "Desconocida";
        accionesCell.innerHTML = `
            <button class="btn-edit" onclick="editarProducto(this)">Editar</button>
            <button class="btn-delete" onclick="eliminarProducto(this)">Eliminar</button>
        `;

        showNotification('Producto agregado');
    }

    function editarProducto(button) {
        let row = button.closest('tr');
        let producto = prompt("Editar nombre del producto", row.cells[1].textContent);
        if (producto) {
            row.cells[1].textContent = producto;
            showNotification('Producto editado');
        }
    }

    function eliminarProducto(button) {
        let row = button.closest('tr');
        row.remove();
        showNotification('Producto eliminado');
    }

    document.querySelector('.btn-add').addEventListener('click', agregarProducto);
</script>
@endsection
