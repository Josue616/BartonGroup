<?php
require_once '../../models/usuario.php';

if (!isset($_GET['dni'])) {
    header("Location: total_usuarios.php");
    exit();
}

$dni = $_GET['dni'];
Usuario::deleteByDNI($dni);

header("Location: total_usuarios.php");
exit();
?>
