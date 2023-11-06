<?php
require_once "../includes/config.php";
require_once "../includes/utilities.php";

if((isset($_POST["checkbox_ida"]) || isset($_POST["checkbox_ida-vuelta"])) && isset($_POST["lugar_origen"]) && isset($_POST["lugar_destino"]) && isset($_POST["fecha_salida"]) && isset($_POST["cant_pasajeros"]) && isset($_POST["clase"])){

    $tipoVuelo = (isset($_POST["checkbox_ida"])) ? "ida" : "ida-vuelta";
    $lugarOrigen = $_POST["lugar_origen"];
    $lugarDestino = $_POST["lugar_destino"];
    $cantPasajes = $_POST["cant_pasajeros"];
    $clase = $_POST["clase"];

    $fechaActual = date("Y-m-d");
    $rangoFechaSalida[0] = date("Y-m-d", strtotime($_POST['fecha_salida']));
    $rangoFechaSalida[1] = date("Y-m-d", strtotime($_POST['fecha_salida']. "- 15 days"));
    $rangoFechaSalida[2] = date("Y-m-d", strtotime($_POST['fecha_salida'] . "+ 15 days"));
    if(strtotime($fechaActual) > strtotime($rangoFechaSalida[0])){
        ////La fecha ingresada es antes que la actualidad
        echo "No puede volar en el pasado. <br>";
    }
    if( (strtotime($rangoFechaSalida[1]) - strtotime($fechaActual)) < 0){
        // La fecha de salida -15 dias da una fecha menor a la actualidad
        $rangoFechaSalida[1] = $fechaActual;
    }
    
    if($cantPasajes < 1 || $cantPasajes > 9){
        ////Cantidad de pasajes invalida
    }
    if($clase != 'economica' && $clase != 'business' && $clase != 'primera'){
        ////El tipo de clase es incorrecto
    }
    if($lugarOrigen == 0 || $lugarDestino == 0){
        ////No ingreso uno o ningun aeropuerto

    }
    if($lugarOrigen == $lugarDestino){
        ////El lugar de origen es el mismo que el de destino
    }

    $sqlDataAeropuertos = "SELECT CUA FROM Aeropuertos WHERE id = '$lugarOrigen' OR id = '$lugarDestino'";
    $resultDataAeropuertos = sqlsrv_query($conn, $sqlDataAeropuertos);
    $i = 0;
    $CUAs = [];
    while($row = sqlsrv_fetch_array($resultDataAeropuertos, SQLSRV_FETCH_ASSOC)){
        $CUAs[$i] = $row['CUA'];
        $i++;
    }
    //Cambio el formato de fechas porque SQLSERVER es la pija mas grande que existe en la historia
    $rangoFechaSalida[1] = date("Y-d-m", strtotime($rangoFechaSalida[1]));
    $rangoFechaSalida[2] = date("Y-d-m", strtotime($rangoFechaSalida[2]));
    $sqlVuelosIda = "SELECT v.id, v.fecha_partida, v.fecha_arribo, v.escalas, a.ubicacion AS ubi_arpto_ori, a2.ubicacion AS ubi_arpto_dest, a.nombre AS nom_arpto_ori, 
                        a2.nombre AS nom_arpto_dest FROM Vuelos v
                    INNER JOIN Aeropuertos a ON v.id_aero_origen = a.id
                    INNER JOIN Aeropuertos a2 ON v.id_aero_destino = a2.id
                    WHERE id_aero_origen = $lugarOrigen AND id_aero_destino = $lugarDestino AND fecha_partida BETWEEN '" . $rangoFechaSalida[1] . "' AND '" . $rangoFechaSalida[2] . "'";
    $resultVuelosIda = sqlsrv_query($conn, $sqlVuelosIda);
    $arrayIdsVuelosIda = array();
    while ($row = sqlsrv_fetch_array($resultVuelosIda, SQLSRV_FETCH_ASSOC)) {
        // Obtén una cadena formateada de la fecha (por ejemplo, 'Y-m-d')
        $cadenaFecha = $row['fecha_partida']->format('Y-m-d');
        $prueba = explode(' ', $cadenaFecha);
        $prueba2 = explode('-', $prueba[0]);
        $arrayIdsVuelosIda[] = $prueba2[2];
    }

    if ($tipoVuelo == "ida-vuelta") {
        if (isset($_POST['fecha_regreso'])) {
            $rangoFechaRegreso[0] = date("Y-m-d", strtotime($_POST['fecha_regreso']));
            $rangoFechaRegreso[1] = date("Y-m-d", strtotime($_POST['fecha_regreso'] . "- 15 days"));
            $rangoFechaRegreso[2] = date("Y-m-d", strtotime($_POST['fecha_regreso'] . "+ 15 days"));

            if (strtotime($rangoFechaSalida[0]) > strtotime($rangoFechaRegreso[0]) || strtotime($fechaActual) > strtotime($rangoFechaRegreso[0])) {
                ////La fecha de vuelta es anterior a la de salida o es el pasado
                echo "No puede regresar en el pasado. <br>";
            }

            $sqlVuelosVuelta = "SELECT * FROM Vuelos WHERE id_aero_origen = $lugarDestino AND id_aero_destino = $lugarOrigen AND fecha_partida BETWEEN '" . $rangoFechaSalida[1] . "' AND '" . $rangoFechaSalida[2] . "'";
            $resultVuelosVuelta = sqlsrv_query($conn, $sqlVuelosVuelta);

            $arrayIdsVuelosVuelta = array();
            while ($row = sqlsrv_fetch_array($resultVuelosVuelta, SQLSRV_FETCH_ASSOC)) {
                // Obtén una cadena formateada de la fecha (por ejemplo, 'Y-m-d')
                $cadenaFecha = $row['fecha_partida']->format('Y-m-d');
                $prueba = explode(' ', $cadenaFecha);
                $prueba2 = explode('-', $prueba[0]);
                $arrayIdsVuelosVuelta[] = $prueba2[2];
            }
        }
    }

} else {
    //Algun dato no existe 
}

function crearCalendario($fecha, $fechasSeleccionables = [])
{
    // Verifica que la fecha tenga el formato correcto (DD/MM/YYYY)
    $fechaObj = DateTime::createFromFormat('d/m/Y', $fecha);
    if (!$fechaObj || $fechaObj->format('d/m/Y') !== $fecha) {
        echo 'Ingresa una fecha válida en el formato DD/MM/YYYY';
        return;
    }

    // Obtén el mes y el año de la fecha ingresada
    $day = $fechaObj->format('d');
    $month = $fechaObj->format('m');
    $year = $fechaObj->format('Y');

    // Obtén el primer día de la semana del mes anterior
    $firstDay = date('w', strtotime("$year-$month-01")) - 1;
    $prevMonthDays = date('t', strtotime("$year-$month-01 -1 month"));

    // Calcula el número de semanas necesarias
    $lastDay = date('t', strtotime("$year-$month-01"));
    $totalWeeks = ceil(($lastDay + $firstDay) / 7);

    // Imprime el calendario
    $dayCounter = 1;
    $dayCounterNextMonth = 1;

    for ($row = 1; $row <= $totalWeeks; $row++) {
        for ($col = 0; $col < 7; $col++) {
            $dayIndex = ($row - 1) * 7 + $col + 1;
            
            if(in_array($dayCounter, $fechasSeleccionables)){
                echo '<li class="calendar__day day-selectable '. (($day == $dayCounter) ? 'day-selected' : null) .'">
                        <div>';
                $daySelectable = true;
            } else {
                echo '<li class="calendar__day ' . (($day == $dayCounter) ? 'day-selected' : null) . '">
                        <div>';
                $daySelectable = false;
            }

            if ($dayIndex <= $firstDay) {
                $prevMonthDay = $prevMonthDays - ($firstDay - $dayIndex);
                echo $prevMonthDay . '</div>';
            } elseif ($dayCounter <= $lastDay) {
                echo $dayCounter . '</div>';
                $dayCounter++;
            } else {
                echo $dayCounterNextMonth . '</div>';
                $dayCounterNextMonth++;
            }

            if($daySelectable){
                echo '<div class="day__selectable-data">
                        <div class="day__data-price">133091</div>
                        <div class="day__data-coin">ARS</div>
                    </div>';
            }

            echo '</li>';
        }
    }

}


$page = "Vuelo buscado";
$section = "search_flights";
require_once "../views/layout.php";