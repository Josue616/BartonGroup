<?php

require_once '../../models/prestamo.php';

$prestamos = Prestamo::findAll();

// Obtener el DNI del primer préstamo en la lista
$dni = isset($prestamos[0]) ? $prestamos[0]->getDni() : 'sin_dni';

header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=prestamos_{$dni}.csv");

$output = fopen('php://output', 'w');

// Puedes añadir los encabezados de las columnas si quieres
fputcsv($output, array('ID', 'Código', 'Monto', 'Tasa', 'Frecuencia', 'DNI', 'Estado'));

foreach ($prestamos as $prestamo) {
    fputcsv($output, array(
        $prestamo->getId(),
        $prestamo->getCodigo(),
        $prestamo->getMonto(),
        $prestamo->getTasa(),
        $prestamo->getFrecuencia(),
        $prestamo->getDni(),
        $prestamo->getEstado()
    ));
}

fclose($output);