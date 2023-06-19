<?php
session_start();

if (!isset($_SESSION['dni']) || $_SESSION['user_type'] !== 'trabajador') {
    header("Location: ../../index.php");
    exit();
}
$dni = $_SESSION['dni'];
require_once '../../models/usuario.php';
$trabajador = Usuario::findByDNI($dni);
$usuarios = Usuario::findAll();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="../../css1/prestamos.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Barton Groups</h1>
            </div>
            <div class="user-info">
                <p>Bienvenido,
                    <?= $trabajador->getNombre() ?> (
                    <?= $trabajador->getEmail() ?>) DNI:
                    <?= $trabajador->getDni() ?>
                </p>
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
            <h2>Usuarios</h2>
            <table>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Historial Crediticio</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($usuarios as $usuario):
                    $prestamos = $usuario->getPrestamos();
                    ?>
                    <tr>
                        <td>
                            <?= $usuario->getDni() ?>
                        </td>
                        <td>
                            <?= $usuario->getNombre() ?>
                        </td>
                        <td>
                            <?= $usuario->getEmail() ?>
                        </td>
                        <td>
                            <?php
                            foreach ($prestamos as $prestamo) {
                                echo "Código: " . $prestamo['codigo_prestamo'] . " Monto: " . $prestamo['monto'] . " Estado: " . $prestamo['estado'] . "<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="editar_usuario.php?dni=<?= $usuario->getDni() ?>">Editar</a> |
                            <a href="eliminar_usuario.php?dni=<?= $usuario->getDni() ?>" class="delete-link">Eliminar</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>    
        </div>
    </div>
</body>
<script>
    const deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const confirmDelete = window.confirm('¿Estás seguro de que quieres eliminar a este usuario?');

            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });
</script>

</html>
