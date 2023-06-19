<?php
session_start();

if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

$dni = $_SESSION['dni'];

require_once '../../models/usuario.php';
$trabajador = Usuario::findByDNI($dni);
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
                    <li><a href="estadisticas.php">Estadísticas</a></li>
                    <li><a href="total_usuarios.php">Usuarios</a></li>
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
                    <th>Acciones</th>
                </tr>
                <?php foreach ($prestamos as $prestamo): 
                    $dni_solicitante = $prestamo->getDni();

                    $solicitante = Usuario::findByDNI($dni_solicitante);
                
                    $correo_solicitante = $solicitante->getEmail();
                ?>
                    <tr>
                        <td style="display:none;"><?= $prestamo->getId() ?></td>
                        <td><?= $prestamo->getCodigo() ?></td>
                        <td><?= $prestamo->getMonto() ?></td>
                        <td><?= $prestamo->getTasa() ?> %</td>
                        <td><?= $prestamo->getFrecuencia() ?></td>
                        <td><?= $prestamo->getDni() ?></td>
                        <td><?= $prestamo->getEstado() ?></td>
                        <td>
                            <a href="export_word.php?codigo=<?= $prestamo->getCodigo() ?>&monto=<?= $prestamo->getMonto() ?>&tasa=<?= $prestamo->getTasa() ?>&frecuencia=<?= $prestamo->getFrecuencia() ?>&dni=<?= $prestamo->getDni() ?>&estado=<?= $prestamo->getEstado() ?>">Exportar a Word</a>
                            <a href="export_contrato.php?codigo=<?= $prestamo->getCodigo() ?>&monto=<?= $prestamo->getMonto() ?>&tasa=<?= $prestamo->getTasa() ?>&frecuencia=<?= $prestamo->getFrecuencia() ?>&dni=<?= $prestamo->getDni() ?>&estado=<?= $prestamo->getEstado() ?>">Exportar Contrato</a>
                            <a href="aprobacion_prestamo.php?id=<?= $prestamo->getId() ?>">Aprobar</a>
                            <a href="desaprobacion_prestamo.php?id=<?= $prestamo->getId() ?>">Rechazar</a>
                            <a href="enviar_notificacion.php?correo=<?= $correo_solicitante ?>">Enviar Notificación</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>


        </div>
    </div>
</body>
</html>

