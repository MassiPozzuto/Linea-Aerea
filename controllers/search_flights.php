<?php
require_once "../includes/config.php";

if((isset($_POST["checkbox_ida"]) || isset($_POST["checkbox_ida-vuelta"])) && isset($_POST["lugar_origen"]) && isset($_POST["lugar_destino"]) && isset($_POST["fechaSalida"]) && isset($_POST["cant_pasajeros"]) && isset($_POST["clase"])){
    
    $tipoVuelo = (isset($_POST["checkbox_ida"])) ? $_POST["checkbox_ida"] : $_POST["checkbox_ida-vuelta"];
    $lugarOrigen = $_POST["lugar_origen"];
    $lugarDestino = $_POST["lugar_destino"];
    $cantPasajes = $_POST["cant_pasajeros"];
    $clase = $_POST["clase"];
    $fechaSalida = date("Y-m-d", strtotime($_POST['fechaSalida']));

    

} else {
    //Algun dato no existe 
}

$page = "Informacion";
$section = "search_flights";
require_once "../views/layout.php";