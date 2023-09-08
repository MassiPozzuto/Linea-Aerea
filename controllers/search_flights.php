<?php
require_once "../includes/config.php";

if(!empty($_POST)){
    
    $_POST['fechaSalida'] = date("Y-m-d", strtotime($_POST['fechaSalida']));

    if($_POST['fechaRegreso'] != null){
        $_POST['fechaRegreso'] = date("Y-m-d", strtotime($_POST['fechaRegreso']));
    }

    if($_POST['lugarOrigen'] != $_POST['lugarDestino']){

    } else {
        //Mismo origen que destino
    }
}

$page = "Informacion";
$section = "search_flights";
require_once "../views/layout.php";