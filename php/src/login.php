<?php
require_once 'config/config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$conn = getConnection();
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['dni'] = $user['dni'];
    
    if ($user['es_trabajador'] == 1) {
        $_SESSION['user_type'] = 'trabajador';
        header("Location: view/trabajador/prestamos.php");
    } else {
        $_SESSION['user_type'] = 'normal';
        header("Location: view/usuario/menu.php");
    }
    exit();
} else {
    echo "Email o contraseña incorrectos";
}
?>
