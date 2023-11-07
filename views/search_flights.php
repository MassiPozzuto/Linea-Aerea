<div class="submenu__flights" id="submenu__flights">
    <div class="submenu__flights-info">
        <div class="mini-container__cuas submenu__flights-item">
            <i class="bi bi-airplane-fill"></i>
            <span><?php echo $CUAs[0]; ?> - <?php echo $CUAs[1]; ?></span>
        </div>
        <div class="mini-container__dates ">
            <div class="submenu__flights-item">
                <i class="bi bi-calendar"></i>
                <span><?php echo reformatearFecha($_POST['fecha_salida']) ?></span>
            </div>

            <?php
            if (isset($_POST['fecha_regreso'])) {
            ?>
                <div class="submenu__flights-item">
                    <i class="bi bi-calendar"></i>
                    <span><?php echo reformatearFecha($_POST['fecha_regreso']) ?></span>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="mini-container__more submenu__flights-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-standing" viewBox="0 0 16 16">
                <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0Z" />
            </svg>
            <span><?php echo ($cantPasajes > 1) ? $cantPasajes . " Pasajes" : $cantPasajes . " Pasaje"; ?>, <?php echo ucfirst($clase); ?></span>
        </div>
    </div>
    <button type="button" class="submenu__flights-btn"><i class="bi bi-caret-down"></i> <span>Editar búsqueda</span></button>
</div>

<div class="container">
    <?php
    if ((!empty($arrayIdsVuelosIda) || $tipoVuelo == "ida-vuelta" && !empty($arrayVuelosVuelta))) { ?>

        <!-- IDA -->
        <div class="section__calendar" id="calendar_ida" calendar-date="11/2023">
            <div class="container__data-calendar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-departure" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14.639 10.258l4.83 -1.294a2 2 0 1 1 1.035 3.863l-14.489 3.883l-4.45 -5.02l2.897 -.776l2.45 1.414l2.897 -.776l-3.743 -6.244l2.898 -.777l5.675 5.727z"></path>
                    <path d="M3 21h18"></path>
                </svg>
                <span class="data__calendar-title">IDA</span>
                <span><?php echo formatearFecha($_POST['fecha_salida'], 1); ?></span>
            </div>

            <div class="calendar">
                <div class="calendar__title">
                    <p><?php echo formatearFecha($_POST['fecha_salida'], 2); ?></p>
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
                    <?php crearCalendario(date("d/m/Y", strtotime($_POST['fecha_salida'])), $arrayVuelosIda) ?>
                </ol>
            </div>
        </div>

        <?php
        if ($tipoVuelo == "ida-vuelta") { ?>
            <!-- VUELTA -->
            <div class="section__calendar" id="calendar_vuelta" calendar-date="02/2024">
                <div class="container__data-calendar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-arrival" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15.157 11.81l4.83 1.295a2 2 0 1 1 -1.036 3.863l-14.489 -3.882l-1.345 -6.572l2.898 .776l1.414 2.45l2.898 .776l-.12 -7.279l2.898 .777l2.052 7.797z"></path>
                        <path d="M3 21h18"></path>
                    </svg>
                    <span class="data__calendar-title">VUELTA</span>
                    <span><?php echo formatearFecha($_POST['fecha_regreso'], 1); ?></span>
                </div>

                <div class="calendar">
                    <div class="calendar__title">
                        <p><?php echo formatearFecha($_POST['fecha_regreso'], 2); ?></p>
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
                        <?php crearCalendario(date("d/m/Y", strtotime($_POST['fecha_regreso'])), $arrayVuelosVuelta) ?>
                    </ol>
                </div>
            </div>

        <?php
        }
    } else { ?>
        <h1>No encontramos vuelos para dichas fechas</h1>
    <?php
    } ?>
</div>

<div class="footer_data-flights">
    <div class="container__data-flights">
        <div class="data__flights-ida">
            <label class="data__flights-type">IDA</label>
            <label class="data__flights-airport"><?php echo $arrayVuelosIda[0]['ubi_arpto_ori'] ?></label>
            <label class="data__flights-day"><?php echo date("d/m/Y", strtotime($_POST['fecha_salida'])) ?></label>
            <label class="data__flights-price">ARS 182.268</label>
        </div>
        <div class="data__flights-vuelta">
            <label class="data__flights-type">VUELTA</label>
            <label class="data__flights-airport"><?php echo $arrayVuelosVuelta[0]['ubi_arpto_ori'] ?></label>
            <label class="data__flights-day"><?php echo date("d/m/Y", strtotime($_POST['fecha_regreso'])) ?></label>
            <label class="data__flights-price">ARS 369.501</label>
        </div>
    </div>

    <div class="container__data-specific">
        <div class="container__total-value">
            <label class="total__value-title">Total por pasajero/a</label>
            <label class="total__value-number">ARS 551.769</label>
        </div>
        <div class="container__view-flights">
            <button type="button" class="btn__view-flights">Ver vuelos</button>
        </div>
    </div>
</div>


<script src="../js/main.js" type="text/javascript"></script>
<script src="../js/search_flights.js" type="text/javascript"></script>