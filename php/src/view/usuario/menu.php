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

// Buscar los préstamos del usuario en la base de datos
require_once '../../models/prestamos.php';
$prestamos = Prestamo::findAllByDni($dni);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menú</title>
    <link rel="stylesheet" href="../../css1/fuente.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Menú</h1>
            </div>
            <div class="user-info">
                <p>Bienvenido, <?= $usuario->getNombre() ?> (<?= $usuario->getEmail() ?>) DNI: <?= $usuario->getDni() ?></p>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="create_prestamo.php">Crear préstamo</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <h2>Mis préstamos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Código de préstamo</th>
                        <th>Monto del préstamo</th>
                        <th>Tasa</th>
                        <th>Frecuencia de pagos</th>
                        <th>Estado del préstamo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamos as $prestamo) { ?>
                        <tr>
                            <td><?= $prestamo->getCodigo() ?></td>
                            <td><?= $prestamo->getMonto() ?></td>
                            <td><?= $prestamo->getTasa() ?> %</td>
                            <td><?= $prestamo->getFrecuencia() ?></td>
                            <td><?= $prestamo->getEstado() ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
