<?php

$menuPrincipal = obtenerMenuPrincipal();
$galeriaFotos = obtenerFotos();

function obtenerMenuPrincipal()
{
    return ['Plato 1', 'Plato 2', 'Plato 3'];
}

function obtenerFotos()
{
    return ['../img/Airbus.p', 'foto2.jpg', 'foto3.jpg'];
}

$page = "Gastronomia";
$section = "gastronomia";
require_once "../views/layout.php";
