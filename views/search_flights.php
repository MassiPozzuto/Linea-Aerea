<?php 
if((!empty($arrayIdsVuelosIda) || $tipoVuelo == "ida-vuelta" && !empty($arrayIdsVuelosVuelta))) { ?>

    <!-- IDA -->
    <div class="section__calendar" id="calendar_ida" calendar-date="11/2023">
        <div class="container__data-calendar">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14.639 10.258l4.83 -1.294a2 2 0 1 1 1.035 3.863l-14.489 3.883l-4.45 -5.02l2.897 -.776l2.45 1.414l2.897 -.776l-3.743 -6.244l2.898 -.777l5.675 5.727z"></path>
                    <path d="M3 21h18"></path>
                </svg>
            </span>
            <span class="data__calendar-title">IDA</span>
            <span><?php echo formatearFecha($_POST['fecha_salida']); ?></span>
        </div>

        <div class="calendar">
            <div class="calendar__title">
                <p><?php echo formatearFecha2($_POST['fecha_salida']); ?></p>
            </div>
            <div class="calendar__days-name">
                <div>lun</div>
                <div>mar</div>
                <div>mié</div>
                <div>jue</div>
                <div>vie</div>
                <div>sáb</div>
                <div>dom</div>
            </div>
            <ol class="calendar__days" id="calendar__days-ida">
                <?php crearCalendario(date("d/m/Y", strtotime($_POST['fecha_salida'])), $arrayIdsVuelosIda, $resultVuelosIda) ?>
            </ol>
        </div>
    </div>

    <?php 
    if($tipoVuelo == "ida-vuelta") { ?>
    <!-- VUELTA -->
    <div class="section__calendar" id="calendar_vuelta" calendar-date="02/2024">
        <div class="container__data-calendar">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-arrival" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M15.157 11.81l4.83 1.295a2 2 0 1 1 -1.036 3.863l-14.489 -3.882l-1.345 -6.572l2.898 .776l1.414 2.45l2.898 .776l-.12 -7.279l2.898 .777l2.052 7.797z"></path>
                    <path d="M3 21h18"></path>
                </svg>
            </span>
            <span class="data__calendar-title">VUELTA</span>
            <span><?php echo formatearFecha($_POST['fecha_regreso']); ?></span>
        </div>

        <div class="calendar">
            <div class="calendar__title">
                <p><?php echo formatearFecha2($_POST['fecha_regreso']); ?></p>
            </div>
            <div class="calendar__days-name">
                <div>lun</div>
                <div>mar</div>
                <div>mié</div>
                <div>jue</div>
                <div>vie</div>
                <div>sáb</div>
                <div>dom</div>
            </div>
            <ol class="calendar__days" id="calendar__days-vuelta">
                <?php crearCalendario(date("d/m/Y", strtotime($_POST['fecha_regreso'])), $arrayIdsVuelosVuelta, $resultVuelosVuelta) ?>
            </ol>
        </div>
    </div>
    <?php 
    } 
} else { ?>
    <h1>No encontramos vuelos para dichas fechas</h1>

<?php 
} ?>

<script src="../js/main.js" type="text/javascript"></script>
<script src="../js/search_flights.js" type="text/javascript"></script>