@extends('layouts.plantillaAdmin')
@section('Titulo', 'Panel de Control')
@section('css-index')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Estilos de la barra lateral */
        .sidebar {
            width: 250px;
            background: #1f1f1f;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            background: #ff8a00;
            padding-left: 15px;
            transition: 0.3s;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            flex-grow: 1;
            background: #f4f4f4;
        }

        .welcome {
            text-align: center;
            padding: 50px;
            background: linear-gradient(90deg, #ff8a00, #e52e71);
            color: white;
            border-radius: 10px;
            animation: slideIn 1s ease-in-out;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 150px;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.1);
        }

        .card i {
            font-size: 30px;
            color: #ff8a00;
        }

        .charts {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .chart-container {
            width: 48%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('contenidoInicioAdmin')
<main class="main-content">
    <section class="welcome">
        <h1>¡Bienvenido al Panel de Administración! 🎉</h1>
        <p>Administra tu tienda de cómics y figuras de acción con facilidad.</p>
        <div class="stats">
            <div class="card">
                <i class="fas fa-box"></i>
                <h3>250</h3>
                <p>Productos</p>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h3>120</h3>
                <p>Pedidos Activos</p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>500</h3>
                <p>Clientes Registrados</p>
            </div>
        </div>
    </section>

    <!-- Gráficos -->
    <section class="charts">
        <div class="chart-container">
            <h3>Ventas por Mes</h3>
            <canvas id="ventasChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>Pedidos por Estado</h3>
            <canvas id="pedidosChart"></canvas>
        </div>
    </section>
</main>
</div>

<script>
$(document).ready(function() {
    $(".welcome").hide().fadeIn(1500); // Animación de entrada
});

// Gráfico de ventas por mes
const ventasCtx = document.getElementById('ventasChart').getContext('2d');
new Chart(ventasCtx, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Ventas ($)',
            data: [1200, 1500, 1100, 1800, 2000, 1700],
            backgroundColor: '#ff8a00'
        }]
    }
});

// Gráfico de pedidos por estado
const pedidosCtx = document.getElementById('pedidosChart').getContext('2d');
new Chart(pedidosCtx, {
    type: 'pie',
    data: {
        labels: ['Enviados', 'Preparando', 'Cancelados'],
        datasets: [{
            label: 'Pedidos',
            data: [60, 30, 10],
            backgroundColor: ['#ff8a00', '#e52e71', '#666']
        }]
    }
});
</script>
@endsection
