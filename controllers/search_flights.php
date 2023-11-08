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
    $mesDeSalida = date("m", strtotime($_POST['fecha_salida']));
    if(strtotime($fechaActual) > strtotime($_POST['fecha_salida'])){
        ////La fecha ingresada es antes que la actualidad
        echo "No puede volar en el pasado. <br>";
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
    $sqlVuelosIda = "SELECT v.id, v.fecha_partida, v.fecha_arribo, v.escalas, v.precio_base,a.ubicacion AS ubi_arpto_ori, a2.ubicacion AS ubi_arpto_dest, a.nombre AS nom_arpto_ori, 
                        a2.nombre AS nom_arpto_dest FROM Vuelos v
                    INNER JOIN Aeropuertos a ON v.id_aero_origen = a.id
                    INNER JOIN Aeropuertos a2 ON v.id_aero_destino = a2.id
                    WHERE id_aero_origen = $lugarOrigen AND id_aero_destino = $lugarDestino AND MONTH(fecha_partida) = $mesDeSalida AND fecha_partida >= GETDATE()
                    ORDER BY v.fecha_partida";
    $resultVuelosIda = sqlsrv_query($conn, $sqlVuelosIda);

    $i = 0;
    while ($row = sqlsrv_fetch_array($resultVuelosIda, SQLSRV_FETCH_ASSOC)) {
        // Obtén una cadena formateada de la fecha (por ejemplo, 'Y-m-d')
        $arrayVuelosIda[$i] = $row;
        $arrayVuelosIda[$i]['fecha_partida'] = $row['fecha_partida']->format('Y-m-d');       
        $i++;
    }

    if ($tipoVuelo == "ida-vuelta") {
        if (isset($_POST['fecha_regreso'])) {
            $mesDeRegreso = date("m", strtotime($_POST['fecha_regreso']));
            if (strtotime($_POST['fecha_salida']) > strtotime($_POST['fecha_regreso']) || strtotime($fechaActual) > strtotime($_POST['fecha_regreso'])) {
                ////La fecha de vuelta es anterior a la de salida o es el pasado
                echo "No puede regresar en el pasado. <br>";
            }

            $sqlVuelosVuelta = "SELECT v.id, v.fecha_partida, v.fecha_arribo, v.escalas, v.precio_base,a.ubicacion AS ubi_arpto_ori, a2.ubicacion AS ubi_arpto_dest, a.nombre 
                                    AS nom_arpto_ori, a2.nombre AS nom_arpto_dest FROM Vuelos v
                                INNER JOIN Aeropuertos a ON v.id_aero_origen = a.id
                                INNER JOIN Aeropuertos a2 ON v.id_aero_destino = a2.id 
                                WHERE id_aero_origen = $lugarDestino AND id_aero_destino = $lugarOrigen AND MONTH(fecha_partida) = $mesDeRegreso AND fecha_partida >= GETDATE()
                                ORDER BY fecha_partida";
            $resultVuelosVuelta = sqlsrv_query($conn, $sqlVuelosVuelta);

            $i = 0;
            while ($row = sqlsrv_fetch_array($resultVuelosVuelta, SQLSRV_FETCH_ASSOC)) {
                $arrayVuelosVuelta[$i] = $row;
                $arrayVuelosVuelta[$i]['fecha_partida'] = $row['fecha_partida']->format('Y-m-d');
                $i++;
            }
        }
    }

} else {
    //Algun dato no existe 
}

function crearCalendario($fecha, $dataVuelos)
{
    // Verifica que la fecha tenga el formato correcto (DD/MM/YYYY)
    $fechaObj = DateTime::createFromFormat('d/m/Y', $fecha);
    
    $fechasSeleccionables = array();
    foreach ($dataVuelos as $item) {
        $fechasSeleccionables[] = explode("-", $item['fecha_partida'])[2];
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
    $i = 0;
    $cantVeces = 0;

    for ($row = 1; $row <= $totalWeeks; $row++) {
        for ($col = 0; $col < 7; $col++) {
            $dayIndex = ($row - 1) * 7 + $col + 1;
            $cantVeces++;
            if(in_array($dayCounter, $fechasSeleccionables) && $firstDay <  $cantVeces){
                echo '<li class="calendar__day day-selectable '. (($day == $dayCounter) ? 'day-selected' : null) . '" id="flight_' . $dataVuelos[$i]['id'] . '" data-day="' . $dataVuelos[$i]['fecha_partida'] . '">
                        <div>';
                $daySelectable = true;
            } else {
                echo '<li class="calendar__day ' . (($day == $dayCounter && $firstDay <  $cantVeces) ? 'day-selected' : null) . '">
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
                echo '<div class="day__selectable-data" >
                        <div class="day__data-price">'. $dataVuelos[$i]['precio_base'] .'</div>
                        <div class="day__data-coin">ARS</div>
                    </div>';
                $i++;
            }

            echo '</li>';
        }
    }

}

function formatearFecha($fecha, $tipo = 1){
    $fecha = date("Y-m-d", strtotime($fecha)); // Aseguramos que la fecha esté en formato "Y-m-d"
    // Array de nombres de meses en español
    $meses = array(1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril", 5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto", 9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"
    );

    if($tipo == 1){
        // Dividimos la fecha en año, mes y día
        list($anio, $mes, $dia) = explode("-", $fecha);
        // Obtenemos el nombre del mes en español
        $mesTexto = $meses[intval($mes)];
        return "$dia de $mesTexto de $anio";
    } else {
        // Dividimos la fecha en año, mes y día
        $fechaSeparada = explode("-", $fecha);
        // Obtenemos el nombre del mes en español
        $mesTexto = $meses[intval($fechaSeparada[1])];
        return "$mesTexto " . $fechaSeparada[0];
    }
}

$page = "Vuelo buscado";
$section = "search_flights";
require_once "../views/layout.php";