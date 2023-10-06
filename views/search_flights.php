
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
<!--
<div class="submenu__flights">

    <div class="submenu__flights-info">
        <div class="mini-container__cuas submenu__flights-item">
            <i class="bi bi-airplane-fill"></i> 
            <span><?php echo $CUAs[0]; ?> - <?php echo $CUAs[1]; ?></span>
        </div>
    </div>

    <div class="submenu__flights-info">
        <div class="mini-container__dates ">
            <div class="submenu__flights-item item-more">
                <i class="bi bi-calendar"></i> 
                <span><?php echo date("d/m", strtotime($rangoFechaSalida[0])) ?></span>
            </div>
            <div class="submenu__flights-item item-more">
                <i class="bi bi-calendar"></i> 
                <span><?php echo date("d/m", strtotime($rangoFechaRegreso[0])) ?></span>
            </div>
        </div>
        <div class="mini-container__more submenu__flights-item item-more">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-standing" viewBox="0 0 16 16">
                <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0Z"/>
            </svg> 
            <span><?php echo $cantPasajes ?></span>
        </div>
    </div>

    <div class="submenu__flights-info">
        <button type="button" class="submenu__flights-btn"><i class="bi bi-caret-down"></i> <span></span></button>
    </div>

</div>-->


<script src="../js/main.js" type="text/javascript"></script>
<script src="../js/search_flights.js" type="text/javascript"></script>