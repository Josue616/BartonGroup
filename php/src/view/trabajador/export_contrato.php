<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $codigo = $_GET['codigo'];
    $monto = $_GET['monto'];
    $tasa = $_GET['tasa'];
    $frecuencia = $_GET['frecuencia'];
    $dni = $_GET['dni'];
    $estado = $_GET['estado'];

    $content = "CONTRATO DE PRÉSTAMO\n\n"
            . "En Tacna, a \n\n"
            . "Entre el prestamista Lewis barton, con DNI 66104520,"
            . " en adelante denominado 'el Prestamista',\n\n"
            . "Y el prestatario con DNI $dni,"
            . " en adelante denominado 'el Prestatario',\n\n"
            . "Se acuerda lo siguiente:\n\n"
            . "1. El Prestamista otorga un préstamo al Prestatario por un monto de $monto.\n\n"
            . "2. El préstamo devengará un interés del $tasa%, a pagar en $frecuencia.\n\n"
            . "3. El Prestatario se compromete a pagar el préstamo en cuotas según lo acordado.\n\n"
            . "4. El estado del préstamo es $estado.\n\n\n\n\n\n"
            . "Firmas:\n\n"
            . "El Prestamista: ________________________\n\n\n\n"
            . "El Prestatario: ________________________";

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=contrato_prestamo_$dni.doc");
    echo $content;
}
?>