<?php
session_start();

// Verificar si el usuario está autenticado y es un trabajador
if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

$id = $_GET['id'];

// Buscar el préstamo por su ID
require_once '../../models/prestamo.php';
$prestamo = Prestamo::findById($id);

// Actualizar el préstamo si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tasa = $_POST['tasa'];
    $codigo = $_POST['codigo'];
    $estado = 'aprobado';
    $prestamo = Prestamo::findById($id);
    $prestamo->setTasa($tasa);
    $prestamo->setCodigo($codigo);
    $prestamo->setEstado($estado);
    $prestamo->update($codigo, $tasa, $id);
    header("Location: prestamos.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aprobar préstamo</title>
    <link rel="stylesheet" href="../../css1/tr.css">
</head>
<body>
    <h1>Aprobar préstamo</h1>
    <form method="POST">
        <label for="tasa">Tasa:</label>
        <input type="text" id="tasa" name="tasa" value="<?= $prestamo->getTasa() ?>"><br>

        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $prestamo->getCodigo() ?>"><br>

        <input type="submit" value="Aprobar">
    </form>
</body>
</html>
