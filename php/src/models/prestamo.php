<?php
require_once '../../config/config.php';
class Prestamo {
    private $id;
    private $codigo;
    private $monto;
    private $tasa;
    private $frecuencia;
    private $dni;
    private $estado;

    public function __construct($id,$codigo, $monto, $tasa, $frecuencia, $dni, $estado) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->monto = $monto;
        $this->tasa = $tasa;
        $this->frecuencia = $frecuencia;
        $this->dni = $dni;
        $this->estado = $estado;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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
        $stmt = $conn->prepare("INSERT INTO prestamos (monto,tasa,frecuencia, dni_usuario, estado) VALUES (:monto,'', :frecuencia, :dni, 'pendiente')");
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
                $row['id'],
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
    public function update($codigo, $tasa, $id) {
        $conn = getConnection();

        $stmt = $conn->prepare("UPDATE prestamos SET codigo_prestamo = :codigo, tasa = :tasa, estado = 'aprobado' WHERE id = :id");
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':tasa', $tasa);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
    public function updateDesaprobar($id) {
        $conn = getConnection();

        $stmt = $conn->prepare("UPDATE prestamos SET estado = 'Rechazado' WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
    public static function findById($id) {
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM prestamos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch();
    $prestamo = new Prestamo(
        $row['id'],
        $row['codigo_prestamo'],
        $row['monto'],
        $row['tasa'],
        $row['frecuencia'],
        $row['dni_usuario'],
        $row['estado']
    );

    return $prestamo;
}
}
?>
