<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $codigo = $_GET['codigo'];
    $monto = $_GET['monto'];
    $tasa = $_GET['tasa'];
    $frecuencia = $_GET['frecuencia'];
    $dni = $_GET['dni'];
    $estado = $_GET['estado'];

    $content = "BARTON GROUP\n\n\nSolicitud de Prestamo\n\n\n\n\n\n\nCódigo: $codigo\nMonto: $monto\nTasa: $tasa\nFrecuencia: $frecuencia\nDNI del solicitante: $dni\nEstado: $estado\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n"
            . "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n______________                                     _______________"
            . "\n\n  ANALISTA                                             GERENTE";

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=prestamo_$dni.doc");
    echo $content;
}
?>
