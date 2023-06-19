<?php
session_start();

if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

$dni = $_GET['dni'];

require_once '../../models/usuario.php';
$usuario = Usuario::findByDNI($dni);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario->setNombre($_POST['nombre']);
    $usuario->setEmail($_POST['email']);
    $usuario->update();
}   

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../css1/prestamos.css">
</head>
<body>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form method="post">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?= $usuario->getDni() ?>" disabled>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $usuario->getNombre() ?>">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?= $usuario->getEmail() ?>">
            <input type="submit" value="Guardar">
        </form>
    </div>
</body>
</html>
