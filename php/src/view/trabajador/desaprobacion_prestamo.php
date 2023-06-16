<?php
session_start();

// Verificar si el usuario está autenticado y es un trabajador
if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}

// Asegurarse de que el ID del préstamo está presente en la URL
if (!isset($_GET['id'])) {
    header("Location: prestamos.php");
    exit();
}

$id = $_GET['id'];

// Buscar al usuario en la base de datos
require_once '../../models/usuario.php';
$trabajador = Usuario::findByDNI($_SESSION['dni']);

// Buscar el préstamo en la base de datos
require_once '../../models/prestamo.php';
$prestamo = Prestamo::findById($id);

if (!$prestamo) {
    die('El préstamo no existe');
}

// Desaprobar el préstamo
$prestamo->updateDesaprobar($id);

// Redirigir al usuario a la página de préstamos
header("Location: prestamos.php");
exit();
?>
