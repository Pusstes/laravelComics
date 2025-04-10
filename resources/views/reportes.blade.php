@extends('layouts.plantillaAdmin')
@section('Titulo', 'Reportes')
@section('css-Reportes')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    body { display: flex; background: #f4f6f9; }

    .sidebar { width: 250px; background: linear-gradient(135deg, #232526, #414345); color: white; height: 100vh; padding-top: 20px; position: fixed; box-shadow: 5px 0 10px rgba(0, 0, 0, 0.3); }
    .sidebar h2 { text-align: center; margin-bottom: 15px; font-size: 22px; border-bottom: 2px solid #ff8a00; padding-bottom: 10px; }
    .sidebar ul { list-style: none; padding: 0; }
    .sidebar ul li { padding: 12px; transition: background 0.3s, transform 0.2s; }
    .sidebar ul li a { text-decoration: none; color: white; display: flex; align-items: center; font-size: 16px; }
    .sidebar ul li:hover { background: #ff8a00; transform: scale(1.05); }

    .content { margin-left: 250px; padding: 20px; width: 100%; }
    h2 { text-align: center; margin-bottom: 20px; color: #2a5298; }

    .filtros { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
    select, button { padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ddd; }
    .btn-filtrar { background: #ff8a00; color: white; cursor: pointer; border: none; }
    .btn-filtrar:hover { background: #e57c00; transform: scale(1.05); }

    .reporte-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); margin-bottom: 20px; }
    .grafico { max-width: 800px; margin: auto; }
    .tabla-container { max-width: 600px; margin: auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
    th { background: #2a5298; color: white; }

    .export-buttons { text-align: center; margin-top: 20px; }
    .btn-export { padding: 10px 15px; margin: 5px; border: none; border-radius: 5px; cursor: pointer; }
    .btn-pdf { background: red; color: white; }
    .btn-excel { background: green; color: white; }
    .btn-csv { background: blue; color: white; }
    .btn-export:hover { transform: scale(1.1); }
</style>
@endsection
@section('contenidoReportes')
<div class="content">
    <h2>Reporte de Análisis</h2>

    <div class="filtros">
        <select id="categoria">
            <option value="ventas">Ventas</option>
            <option value="clientes">Clientes Frecuentes</option>
            <option value="tendencias">Tendencias de Compra</option>
        </select>
        <select id="periodo">
            <option value="mensual">Mensual</option>
            <option value="anual">Anual</option>
        </select>
        <button class="btn-filtrar">Filtrar</button>
    </div>

    <div class="reporte-container">
        <h3>Reporte de Ventas</h3>
        <div class="grafico">
            <canvas id="ventasChart"></canvas>
        </div>
    </div>

    <div class="reporte-container">
        <h3>Clientes Frecuentes</h3>
        <div class="tabla-container">
            <table id="clientesTabla">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Compras</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Juan Pérez</td><td>15</td></tr>
                    <tr><td>Ana López</td><td>12</td></tr>
                    <tr><td>Carlos Ramírez</td><td>10</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="reporte-container">
        <h3>Tendencias de Compra</h3>
        <div class="grafico">
            <canvas id="tendenciasChart"></canvas>
        </div>
    </div>

    <div class="export-buttons">
        <button class="btn-export btn-pdf">Exportar a PDF</button>
        <button class="btn-export btn-excel">Exportar a Excel</button>
        <button class="btn-export btn-csv">Exportar a CSV</button>
    </div>
</div>

<script>
    const ventasData = [5000, 7000, 8000, 6000, 7500];
    const tendenciasData = [30, 50, 40, 60, 55];
    const clientesData = [
        { cliente: "Juan Pérez", compras: 15 },
        { cliente: "Ana López", compras: 12 },
        { cliente: "Carlos Ramírez", compras: 10 }
    ];

    // Gráfico de Ventas
    const ventasChart = new Chart(document.getElementById("ventasChart"), {
        type: "bar",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
            datasets: [{ label: "Ventas", data: ventasData, backgroundColor: "blue" }]
        }
    });

    // Gráfico de Tendencias
    const tendenciasChart = new Chart(document.getElementById("tendenciasChart"), {
        type: "line",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
            datasets: [{ label: "Tendencias", data: tendenciasData, borderColor: "red", fill: false }]
        }
    });

    // Filtrar datos
    $(".btn-filtrar").click(function() {
        const categoria = $("#categoria").val();
        const periodo = $("#periodo").val();

        if (categoria === "ventas") {
            ventasChart.data.datasets[0].data = ventasData;
            tendenciasChart.data.datasets[0].data = tendenciasData;
        } else if (categoria === "clientes") {
            $("#clientesTabla tbody").html(`
                <tr><td>Juan Pérez</td><td>15</td></tr>
                <tr><td>Ana López</td><td>12</td></tr>
                <tr><td>Carlos Ramírez</td><td>10</td></tr>
            `);
        }
        ventasChart.update();
        tendenciasChart.update();
    });

    // Exportar a CSV
    function downloadCSV(csv, filename) {
        const blob = new Blob([csv], { type: "text/csv" });
        saveAs(blob, filename);
    }

    // Exportar a Excel
    function downloadExcel() {
        const ws = XLSX.utils.table_to_sheet(document.querySelector("#clientesTabla"));
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Clientes");
        XLSX.writeFile(wb, "clientes.xlsx");
    }

    // Exportar a PDF
    $(".btn-pdf").click(function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFont("helvetica", "normal");
        doc.text("Reporte de Análisis", 20, 20);
        doc.text("Clientes Frecuentes", 20, 40);

        const clientes = $("#clientesTabla tbody").html();
        const rows = [];
        $(clientes).find("tr").each(function() {
            const row = [];
            $(this).find("td").each(function() {
                row.push($(this).text());
            });
            rows.push(row);
        });

        doc.autoTable({
            head: [["Cliente", "Compras"]],
            body: rows,
        });

        doc.save("reporte_analisis.pdf");
    });

    // Eventos de los botones de exportación
    $(".btn-csv").click(function() {
        let csv = "Cliente,Compras\n";
        clientesData.forEach(client => {
            csv += `${client.cliente},${client.compras}\n`;
        });
        downloadCSV(csv, "clientes.csv");
    });

    $(".btn-excel").click(function() {
        downloadExcel();
    });
</script>
@endsection
