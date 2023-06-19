<?php
    // Obtén el correo del usuario desde $_GET o $_POST
    $correo = $_GET['correo'];

    // Ejecuta el script Python y pasa el correo electrónico como un argumento
    $output = shell_exec("python3 enviar_notificacion.py $correo");
    
    // Redirecciona de vuelta a la página de préstamos
    header("Location: prestamos.php");
    exit();
?>
