<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
  <title><?php echo $page; ?> • Racedo Airways</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Viex Inc.">

  <link rel="icon" sizes="192x192" href="../img/racedo logo sin texto.png">

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <!-- BOOTSTRAP -->
  <!--<script src="../js/bootstrap.bundle.js"></script>-->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- JQUERY -->
  <script src="../js/jquery.min.js"></script>
  <!-- CSS -->
  <link href="../css/main.css" rel="stylesheet">
  <?php if($section == "info"){ ?>
     <link rel="stylesheet" href="../css/info.scss">
  <?php }else{?>
    <link href="../css/<?php echo $section ?>.css" rel="stylesheet">
    <?php }?>

  

  <!-- SELECT2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</head>

<body>

  <?php
  // Traigo el header
  require_once('../includes/header.php');


  if($section == "home"){
  ?>
    <div class="container__images-home">
      <img src="../img/aeropuerto3_optimizado.jpg" alt="">
    </div>
  <?php 
  }?>

  <!-- Empieza el contenido especifico -->
  <div class="container">
    <?php require_once($section . ".php") ?>
  </div>
  <!-- Termina el contenido especifico -->

  <script src="../js/main.js" type="text/javascript"></script>
</body>

</html>