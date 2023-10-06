<div class="container__form-reserve">
    <ul class="container__submenu-reserve">
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "flights") ? "active" : null; ?>" id="submenu__reserve-flights"><a href=""><i class="bi bi-airplane-fill"></i> <span>VUELOS</span></a></li>
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "checkin") ? "active" : null; ?>" id="submenu__reserve-checkin"><a href=""><i class="bi bi-bag-check-fill"></i> <span>CHECK IN</span></a></li>
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "flightStatus") ? "active" : null; ?>" id="submenu__reserve-flight-status"><a href=""><i class="bi bi-clock-history"></i> <span>ESTADO DE VUELO</span></a></li>
    </ul>

    <div class="container__forms">
        <form action="" method="POST" id="form__reserve">
            <?php
            if ($_GET["activeTab"] == "flights") { ?>
                <div class="container__type-flight">
                    <div class="form-group container__checkbox-ida">
                        <input type="checkbox" name="checkbox_ida" id="checkbox_ida" value="ida">
                        <span>Ida</span>
                        <p class="errormessage__form" style="display: none;"></p>
                    </div>
                    <div class="form-group container__checkbox-ida-vuelta">
                        <input type="checkbox" name="checkbox_ida-vuelta" id="checkbox_ida-vuelta" value="ida-vuelta" checked>
                        <span>Ida y vuelta</span>
                        <p class="errormessage__form" style="display: none;"></p>
                    </div>
                </div>

                <div class="container__data-flight">
                    <div class="form-group item__data-flight">
                        <label class="form-label">Origen</label>
                        <select class="form__reserve-input select-airport" name="lugar_origen" id="lugar_origen">
                            <option value="0" id="origen_no_seleccionado" hidden disabled selected>Origen</option>
                        </select>
                        <p class="errormessage__form"></p>
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label">Destino</label>
                        <select class="form__reserve-input select-airport" name="lugar_destino" id="lugar_destino">
                            <option value="0" id="destino_no_seleccionado" hidden disabled selected>Destino</option>
                        </select>
                        <p class="errormessage__form"></p>
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" id="label-fecha_salida">Partida</label>
                        <input type="date" class="form__reserve-input" name="fecha_salida" id="fecha_salida">
                        <p class="errormessage__form"></p>
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label">Regreso</label>
                        <input type="date" class="form__reserve-input" name="fecha_regreso" id="fecha_regreso">
                        <p class="errormessage__form"></p>
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label">Pasajeros</label>
                        <input type="number" class="form__reserve-input" name="cant_pasajeros" id="cant_pasajeros" value="1" min="1" max="9">
                        <p class="errormessage__form"></p>
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label">Clase</label>
                        <select class="form__reserve-input" name="clase" id="clase">
                            <option value="economica" selected>Economica</option>
                            <option value="business">Business</option>
                            <option value="primera">Primera Clase</option>
                        </select>
                        <p class="errormessage__form"></p>
                    </div>
                </div>

                <div class="form-group container__submit-flight">
                    <button type="submit">Buscar vuelos</button>
                </div>

            <?php
            } else if ($_GET["activeTab"] == "checkin") { ?>
            <form method="POST" action="checkin.php">
                <div class="container__data-flight">
                    <div class="form-group item__data-flight">
                        <label class="form-label">Código de reserva</label>
                        <input type="text" name="vueloid" id="rescode" placeholder="Código de reserva">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label">Numero de documento</label>
                        <input type="text"  name="dni" id="dni" placeholder="Documento">
                    </div>
                </div>

                <div class="form-group container__submit-flight">
                    <button type="submit" id="checkinbutton">Comenzar Check-In</button>
                </div>
                </form>
            <?php
            } else if ($_GET["activeTab"] == "flightStatus") { ?>


            <?php
            } ?>
        </form>
    </div>

</div>

<script src="../js/home.js" type="text/javascript"></script>