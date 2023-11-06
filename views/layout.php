<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
  <title><?php echo $page; ?> - Racedo Airways</title>
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
  } else if($section == "search_flights") { ?>
    <div class="submenu__flights" id="submenu__flights">
      <div class="submenu__flights-info">
          <div class="mini-container__cuas submenu__flights-item">
              <i class="bi bi-airplane-fill"></i> 
              <span><?php echo $CUAs[0]; ?> - <?php echo $CUAs[1]; ?></span>
          </div>
          <div class="mini-container__dates ">
              <div class="submenu__flights-item">
                  <i class="bi bi-calendar"></i> 
                  <span><?php echo reformatearFecha($rangoFechaSalida[0]) ?></span>
              </div>
              
              <?php 
              if(isset($rangoFechaRegreso[0])) {
              ?>
                  <div class="submenu__flights-item">
                      <i class="bi bi-calendar"></i> 
                      <span><?php echo reformatearFecha($rangoFechaRegreso[0]) ?></span>
                  </div>
              <?php 
              }
              ?>
          </div>
          <div class="mini-container__more submenu__flights-item">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-standing" viewBox="0 0 16 16">
                  <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0Z"/>
              </svg> 
              <span><?php echo ($cantPasajes > 1) ? $cantPasajes . " Pasajes" : $cantPasajes . " Pasaje"; ?>, <?php echo ucfirst($clase); ?></span>
          </div>
      </div>
      <button type="button" class="submenu__flights-btn"><i class="bi bi-caret-down"></i> <span>Editar búsqueda</span></button>
    </div>
  <?php 
  } ?>

  <!-- Empieza el contenido especifico -->
  <div class="container">
    <?php require_once($section . ".php") ?>
  </div>
  <!-- Termina el contenido especifico -->

  <script src="../js/main.js" type="text/javascript"></script>
</body>

</html>