<?php
require_once "../includes/config.php";

if(!isset($_GET["activeTab"])){
    $_GET["activeTab"] = "flights";
}

$page = "Inicio";
$section = "home";
require_once "../views/layout.php";
?>