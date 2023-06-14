<?php
require_once '../../config/config.php';
class Prestamo {
    private $codigo;
    private $monto;
    private $tasa;
    private $frecuencia;
    private $dni;
    private $estado;

    public function __construct($codigo, $monto, $tasa, $frecuencia, $dni, $estado) {
        $this->codigo = $codigo;
        $this->monto = $monto;
        $this->tasa = $tasa;
        $this->frecuencia = $frecuencia;
        $this->dni = $dni;
        $this->estado = $estado;
    }
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function getFrecuencia() {
        return $this->frecuencia;
    }

    public function setFrecuencia($frecuencia) {
        $this->frecuencia = $frecuencia;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getTasa() {
        return $this->tasa;
    }

    public function setTasa($tasa) {
        $this->tasa = $tasa;
    }

    // Obtener todos los préstamos de un usuario por DNI
    public static function findAllByDni($dni) {
        $conn = getConnection();

        $stmt = $conn->prepare("SELECT * FROM prestamos WHERE dni_usuario = :dni");
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        $result = array();
        while ($row = $stmt->fetch()) {
            $prestamo = new Prestamo(
                $row['codigo_prestamo'],
                $row['monto'],
                $row['tasa'], 
                $row['frecuencia'],
                $row['dni_usuario'],
                $row['estado']
            );
            $result[] = $prestamo;
        }

        return $result;
    }

    // Crear un nuevo préstamo en la base de datos
    public static function crear($monto, $frecuencia, $dni) {
        $conn = getConnection();
        $stmt = $conn->prepare("INSERT INTO prestamos (codigo_prestamo,monto,tiempo,tasa,frecuencia, dni_usuario, estado) VALUES (null,:monto,null,null, :frecuencia, :dni, 'pendiente')");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':frecuencia', $frecuencia);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
    }
        public static function findAll() {
        $conn = getConnection();

        $stmt = $conn->prepare("SELECT * FROM prestamos");
        $stmt->execute();

        $result = array();
        while ($row = $stmt->fetch()) {
            $prestamo = new Prestamo(
                $row['codigo_prestamo'],
                $row['monto'],
                $row['tasa'],
                $row['frecuencia'],
                $row['dni_usuario'],
                $row['estado']
            );
            $result[] = $prestamo;
        }

        return $result;
    }
}

?>
