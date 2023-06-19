<?php

class Usuario {
    private $dni;
    private $nombre;
    private $email;
    private $password;

    public function __construct($dni, $nombre, $email, $password) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function update() {
        require_once '../../config/config.php';
    
        $conn = getConnection();
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = :nombre, email = :email WHERE dni = :dni");
    
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':dni', $this->dni);
    
        $stmt->execute();
    }
    

    public static function findByDNI($dni) {
        require_once '../../config/config.php';

        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Usuario($row['dni'], $row['nombre'], $row['email'], $row['password']);
    }
    public static function findAll() {
        require_once '../../config/config.php';
    
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
    
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario($row['dni'], $row['nombre'], $row['email'], $row['password']);
        }
    
        return $usuarios;
    }
    public function getPrestamos() {
        require_once '../../config/config.php';
    
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM prestamos WHERE dni_usuario = :dni");
        $stmt->bindParam(':dni', $this->dni);
        $stmt->execute();
    
        $prestamos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prestamos[] = $row;
        }
    
        return $prestamos;
    }
    public static function deleteByDNI($dni) {
        require_once '../../config/config.php';
    
        $conn = getConnection();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE dni = :dni");
        $stmt->bindParam(':dni', $dni);
        
        $stmt->execute();
    }
    
    
}

?>
