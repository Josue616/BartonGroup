<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['dni']) || $_SESSION['user_type'] === 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

// Recuperar el DNI del usuario de la sesión
$dni = $_SESSION['dni'];

// Buscar al usuario en la base de datos
require_once '../../models/usuario.php';
$usuario = Usuario::findByDNI($dni);

// Crear un nuevo préstamo
require_once '../../models/prestamos.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = $_POST['monto'];
    $frecuencia = $_POST['frecuencia'];

    $prestamo = new Prestamo(null, $monto,null, $frecuencia, $dni, 'pendiente');
    Prestamo::crear($prestamo->getMonto(), $prestamo->getFrecuencia(), $prestamo->getDni());
    header("Location: menu.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Solicitar préstamo</title>
    <link rel="stylesheet" href="../../css1/fuente.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Solicitar préstamo</h1>
            </div>
            <div class="user-info">
                <p>Bienvenido, <?= $usuario->getNombre() ?> (<?= $usuario->getEmail() ?>) DNI: <?= $usuario->getDni() ?></p>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="menu.php">Menú</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <form method="POST">
                <label for="monto">Monto del préstamo:</label>
                <input type="number" id="monto" name="monto" required><br><br>

                <label for="frecuencia">Frecuencia de pagos:</label>
                <select id="frecuencia" name="frecuencia" required>
                    <option value="diario">Diarios</option>
                    <option value="semanal">Semanales</option>
                    <option value="mensual">Mensuales</option>
                </select><br><br>

                <button type="submit">Solicitar préstamo</button>
            </form>
        </div>
    </div>
</body>
</html>
