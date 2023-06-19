<?php
    require_once '../../config/config.php';
    require_once '../../models/prestamo.php';

    $prestamos_aprobados = Prestamo::findAll();
    $total_aprobados = 0;
    $suma_montos = 0;
    foreach ($prestamos_aprobados as $prestamo) {
        if ($prestamo->getEstado() == 'aprobado') {
            $total_aprobados++;
            $suma_montos += $prestamo->getMonto();
        }
    }

    $prestamos_pendientes = Prestamo::findAll();
    $total_pendientes = 0;
    foreach ($prestamos_pendientes as $prestamo) {
        if ($prestamo->getEstado() == 'pendiente') {
            $total_pendientes++;
        }
    }

    $prestamos_rechazados = Prestamo::findAll();
    $total_rechazados = 0;
    foreach ($prestamos_rechazados as $prestamo) {
        if ($prestamo->getEstado() == 'rechazado') {
            $total_rechazados++;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Préstamos</title>
    <link rel="stylesheet" href="../../css1/estadisticas.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <h2>Préstamos aprobados</h2>
            <canvas id="aprobadosChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>Préstamos pendientes</h2>
            <canvas id="pendientesChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>Préstamos rechazados</h2>
            <canvas id="rechazadosChart"></canvas>
        </div>
    </div>

    <script>
        var aprobadosData = <?php echo $total_aprobados; ?>;
        var pendientesData = <?php echo $total_pendientes; ?>;
        var rechazadosData = <?php echo $total_rechazados; ?>;

        var ctx1 = document.getElementById('aprobadosChart').getContext('2d');
        var ctx2 = document.getElementById('pendientesChart').getContext('2d');
        var ctx3 = document.getElementById('rechazadosChart').getContext('2d');

        var aprobadosChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Aprobados'],
                datasets: [{
                    label: '# de Préstamos Aprobados',
                    data: [aprobadosData],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        var pendientesChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Pendientes'],
                datasets: [{
                    label: '# de Préstamos Pendientes',
                    data: [pendientesData],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            }
        });

        var rechazadosChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Rechazados'],
                datasets: [{
                    label: '# de Préstamos Rechazados',
                    data: [rechazadosData],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>
    <div style="text-align: center; margin: 1rem;">
        <a href="prestamos.php" style="text-decoration: none; color: #333333;">Volver</a>
    </div>
</body>
</html>
