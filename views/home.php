<div class="container__form-reserve">
    <ul class="container__submenu-reserve">
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "flights") ? "active" : null;?>" id="submenu__reserve-flights"><a href="#"><i class="bi bi-airplane-fill"></i> <span>VUELOS</span></a></li>
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "checkin") ? "active" : null;?>" id="submenu__reserve-checkin"><a href="#"><i class="bi bi-bag-check-fill"></i> <span>CHECK IN</span></a></li>
        <li class="submenu__reserve-item <?php echo ($_GET["activeTab"] == "flightStatus") ? "active" : null;?>" id="submenu__reserve-flight-status"><a href="#"><i class="bi bi-clock-history"></i> <span>ESTADO DE VUELO</span></a></li>
    </ul>

    <div class="container__forms">
        <form action="" method="POST" id="form__reserve">
            <?php 
            if($_GET["activeTab"] == "flights") { ?>
                <div class="container__type-flight">
                    <div class="form-group container__checkbox-ida">
                        <input type="checkbox" name="checkbox_ida" id="checkbox_ida">
                        <span>Ida</span>
                    </div>
                    <div class="form-group container__checkbox-ida-vuelta">
                        <input type="checkbox" name="checkbox_ida-vuelta" id="checkbox_ida-vuelta" checked>
                        <span>Ida y vuelta</span>
                    </div>
                </div>

                <div class="container__data-flight">
                    <div class="form-group item__data-flight">
                        <label class="form-label" >Origen</label>
                        <input type="date" name="lugar_origen" id="">
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label" >Destino</label>
                        <input type="date" name="lugar_destino" id="">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" id="label-fecha_salida">Partida</label>
                        <input type="date" name="fecha_salida" id="fecha_salida">
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label" >Regreso</label>
                        <input type="date" name="fecha_regreso" id="fecha_regreso">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" >Pasajeros</label>
                        <input type="number" name="cant_pasajes" id="" value="1" min="1" max="9">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" >Clase</label>
                        <select name="clase" id="">
                            <option value="economica" selected>Economica</option>
                            <option value="business">Business</option>
                            <option value="primera">Primera Clase</option>
                        </select>
                    </div>
                </div>

                <div class="form-group container__submit-flight">
                    <button type="submit">Buscar vuelos</button>
                </div>
                
            <?php 
            } else if ($_GET["activeTab"] == "checkin") { ?>
                <div class="container__data-flight">
                    <div class="form-group item__data-flight">
                        <label class="form-label" >Código de reserva</label>
                        <input type="text" name="" id="">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" >Pasajero/a</label>
                        <input type="text" name="cant_pasajes" id="" value="1" min="1" max="9">
                    </div>
                </div>

                <div class="form-group container__submit-flight">
                    <button type="submit">Comenzar Check-In</button>
                </div>
            <?php 
            } else if ($_GET["activeTab"] == "flightStatus") { ?>


            <?php 
            } ?>
        </form>
    </div>

</div>

<script src="../js/home.js" type="text/javascript"></script>