<?php
session_start();

// Verificar si el usuario está autenticado y es un trabajador
if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

// Recuperar el DNI del usuario de la sesión
$dni = $_SESSION['dni'];

// Buscar al usuario en la base de datos
require_once '../../models/usuario.php';
$trabajador = Usuario::findByDNI($dni);

// Buscar todos los préstamos en la base de datos
require_once '../../models/prestamo.php';
$prestamos = Prestamo::findAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menú de Trabajador</title>
    <link rel="stylesheet" href="../../css1/prestamos.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Barton Groups</h1>
            </div>
            <div class="user-info">
                <p>Bienvenido, <?= $trabajador->getNombre() ?> (<?= $trabajador->getEmail() ?>) DNI: <?= $trabajador->getDni() ?></p>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="menu.php">Menú</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <h2>Prestamos solicitados</h2>
            <table>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Código</th>
                    <th>Monto</th>
                    <th>Tasa</th>
                    <th>Frecuencia</th>
                    <th>DNI del solicitante</th>
                    <th>Estado</th>
                </tr>
                <?php foreach ($prestamos as $prestamo): ?>
                    <tr>
                        <td style="display:none;"><?= $prestamo->getId() ?></td>
                        <td><?= $prestamo->getCodigo() ?></td>
                        <td><?= $prestamo->getMonto() ?></td>
                        <td><?= $prestamo->getTasa() ?> %</td>
                        <td><?= $prestamo->getFrecuencia() ?></td>
                        <td><?= $prestamo->getDni() ?></td>
                        <td><?= $prestamo->getEstado() ?></td>
                        <td><a href="export_word.php?codigo=<?= $prestamo->getCodigo() ?>&monto=<?= $prestamo->getMonto() ?>&tasa=<?= $prestamo->getTasa() ?>&frecuencia=<?= $prestamo->getFrecuencia() ?>&dni=<?= $prestamo->getDni() ?>&estado=<?= $prestamo->getEstado() ?>">Exportar a Word</a></td>
                        <td><a href="aprobacion_prestamo.php?id=<?= $prestamo->getId() ?>">Aprobar</a></td>
			<td><a href="desaprobacion_prestamo.php?id=<?= $prestamo->getId() ?>">Rechazar</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
