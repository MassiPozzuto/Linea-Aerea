<?php
require '../includes/config.php';

$tipoVuelo = (isset($_POST['type_flights'])) ? $_POST['type_flights'] : null;
$cantPasajes = (isset($_POST['amt_tickets'])) ? (int)$_POST['amt_tickets'] : 0;
$clase = (isset($_POST['class'])) ? $_POST['class'] : 'economica';

$idVueloIda = (isset($_POST['flights-ida'])) ? (int)$_POST['flights-ida'] : 0;
$idVueloVuelta = (isset($_POST['flights-vuelta'])) ? (int)$_POST['flights-vuelta'] : 0;

$sqlGetItinerary =
    "SELECT 
        v.id,
        v.fecha_partida,
        v.duration,
        v.escalas,
        v.precio_base * (1 + (
            SELECT SUM(porcentaje)
            FROM Impuestos -- Coloca aquí los IDs de las tarifas deseadas
        )) AS precio_final,
        a.ubicacion AS ubi_arpto_ori,
        a.CUA AS CUA_ori,
        a2.CUA AS CUA_dest,
        a2.ubicacion AS ubi_arpto_dest,
        a.nombre AS nom_arpto_ori,
        a2.nombre AS nom_arpto_dest,
        e.id_aeropuerto AS id_aeropuerto_escala,
        e.nro_escala
    FROM  Vuelos v
    INNER JOIN Aeropuertos a ON v.id_aero_origen = a.id
    INNER JOIN Aeropuertos a2 ON v.id_aero_destino = a2.id
    LEFT JOIN Escalas e ON v.id = e.id_vuelo
    WHERE v.id = ? OR v.id = ? AND v.fecha_partida > GETDATE()
    ORDER BY v.fecha_partida;";

// Preparar la consulta
$stmt = sqlsrv_prepare($conn, $sqlGetItinerary, array($idVueloIda, $idVueloVuelta));
// Ejecutar la consulta
if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
}

$rowVuelos = array();
$numRows = 0; //hago esto porque no funca el sqlsrv_num_rows
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $rowVuelos[] = $row;
    $numRows++;
}

// Verificar el número de filas
if (($numRows != 1 && $tipoVuelo == 'ida') || ($numRows != 2 && $tipoVuelo == 'ida-vuelta')) {
    //Algo esta mal en los resultados solicitados
    $error = "Ocurrió un error, no se pudieron encontrar los vuelos deseados";
} 


$page = "Informacion personal";
$section = "checkout_passengers";
require_once "../views/layout.php";