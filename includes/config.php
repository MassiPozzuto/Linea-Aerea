<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

define('RUTA', '/Linea-Aerea');
define('CANT_REG_PAG', 30);

$connectionInfo = array( "Database"=>"Linea-Aerea");
$conn = sqlsrv_connect( "DESKTOP-QB22C4J\SQLEXPRESS", $connectionInfo);

if (!$conn) {
  echo "Conexión no se pudo establecer.<br />";
  die( print_r( sqlsrv_errors(), true));
}

session_start();

if ((isset($_COOKIE['email']) || isset($_COOKIE['password'])) && !isset($_SESSION['user'])) {
  $sqlLogin = "SELECT users.* FROM users 
                  WHERE users.email='" . $_COOKIE['email'] . "' AND users.password='" . $_COOKIE['password'] . "' AND users.deleted_at IS NULL";
  $resultLogin = sqlsrv_query($conn, $sqlLogin);
  if (sqlsrv_num_rows($resultLogin) === 1) {
    $_SESSION['user'] = sqlsrv_fetch_array($resultLogin, SQLSRV_FETCH_ASSOC);
  }
}


// Change character set to utf8
//sqlsrv_set_charset($conn, "utf8");