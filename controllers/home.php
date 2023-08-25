<?php


$page = "Inicio";
$section = "home";

if(!isset($_GET["activeTab"])){
    $_GET["activeTab"] = "flights";
}

require_once "../views/layout.php";
?>