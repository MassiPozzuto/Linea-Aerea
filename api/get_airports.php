<?php
require_once "../includes/config.php";

$result = sqlsrv_query($conn, "SELECT id, ubicacion FROM Aeropuertos ORDER BY ubicacion ASC;");

if(!$result){
    echo "Error en la conexión";
    die(print_r(sqlsrv_errors()));
}

$i = 0;
$aeropuertos = [];
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
    $row['ubicacion'] = utf8_encode($row['ubicacion']);
    $aeropuertos[$i] = $row;
    $i++;
}

$message = [
    'message' => "Hecho",
    'status' => 200,
    'aeropuertos' => $aeropuertos
];

header("Content-Type: application/json; charset=utf-8");
return print_r(json_encode($message));
?>