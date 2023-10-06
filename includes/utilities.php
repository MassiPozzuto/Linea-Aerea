<?php
function reformatearFecha($fecha) {
    // Crear un objeto DateTime a partir de la fecha ingresada
    $fechaObj = date_create_from_format('Y-m-d', $fecha);

    if (!$fechaObj) {
        return false; // La fecha ingresada no es válida
    }

    // Obtener el día de la semana en formato abreviado (mié.) en español
    $diasSemana = [
        'Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'
    ];
    $diaSemana = $diasSemana[intval($fechaObj->format('w'))];

    // Obtener el día y el mes en formato dd/mm
    $diaMes = $fechaObj->format('d/m');

    // Obtener el año actual en formato yy
    $anoActual = date('y');

    // Obtener el año de la fecha en formato yy
    $anoFecha = $fechaObj->format('y');

    // Comprobar si el año de la fecha es el mismo que el año actual
    if ($anoFecha == $anoActual) {
        return "$diaSemana. $diaMes";
    } else {
        return "$diaSemana. $diaMes/$anoFecha";
    }
}