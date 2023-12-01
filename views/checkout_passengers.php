<?php
if (!isset($error)) { ?>

    <form action="#poner_pagina_para_pagar_je" method="POST" id="form__checkout-passengers">

        <input type="text" name="class" id="form-class-flights" value="<?php echo $clase ?>" hidden>
        <input type="text" name="type_flights" id="form-type-flights" value="<?php echo $tipoVuelo ?>" hidden>
        <input type="number" name="flights-ida" id="form-flights-ida" value="<?php echo $rowVuelos[0] ?>" hidden>
        <?php
        if ($tipoVuelo == 'ida-vuelta') { ?>
            <input type="number" name="flights-vuelta" id="form-flights-vuelta" value="<?php echo $rowVuelos[1] ?>" hidden>
        <?php
        } ?>

        <div class="container__all-passengers" id="info_passengers-<?php echo $cantPasajes ?>">
            <div class="title-passenger">
                <h3>Datos de los pasajeros</h3>
            </div>

            <?php
            for ($i = 1; $i <= $cantPasajes; $i++) { ?>
                <div class="container__passenger">
                    <div class="subtitle-passenger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" stroke-width="0" fill="currentColor" />
                        </svg>
                        <span>Pasajero <?php echo $i; ?></span>
                    </div>
                    <div class="container__passenger-inputs">
                        <div class="form-group-double">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="" name="passenger_name-<?php echo $i ?>" class="form-input">
                                <p class="errormessage__form"></p>
                            </div>
                            <div class="form-group">
                                <label>Apellido</label>
                                <input type="text" id="" name="passenger_surname-<?php echo $i ?>" class="form-input">
                                <p class="errormessage__form"></p>
                            </div>
                        </div>
                        <div class="form-group-double">
                            <div class="form-group group-for-nacionality">
                                <label>Nacionalidad</label>
                                <select class="select-nacionality" name="passenger_from-<?php echo $i ?>" id="">
                                    <option value="argentina" selected>Argentina</option>
                                    <option value="uruguay">Uruguay</option>
                                    <option value="argentina">Argentinqwerwergergergergerfgergergergertgertgrgeerga</option>
                                    <option value="brasil">Brasil</option>
                                </select>
                                <p class="errormessage__form"></p>
                            </div>
                            <div class="form-group">
                                <label>DNI/Pasaporte</label>
                                <input type="text" id="" name="passenger_dni-<?php echo $i ?>" class="form-input input-no-flechas">
                                <p class="errormessage__form"></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>

        <div class="">
            <div class="title-passenger">
                <h3>Datos de la reserva</h3>
            </div>
            <div class="container__passenger  container__passenger-inputs">
                <div class="form-group-double">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="" name="reserve_email" class="form-input">
                        <p class="errormessage__form"></p>
                    </div>
                    <div class="form-group">
                        <label>Confirmá tu email</label>
                        <input type="text" id="" name="reserve_email-confirm" class="form-input">
                        <p class="errormessage__form"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="number" id="" name="reserve_tel" class="form-input input-no-flechas">
                    <p class="errormessage__form"></p>
                </div>
            </div>
        </div>

        <div class="container__btn-submit">
            <button type="submit">Ir a pagar</button>
        </div>
    </form>

    <aside>
        <div class="container__purchase-info">
            <p class="purchase__info-title">Información de tu compra</p>
            <div class="purchase__info-detail">
                <span class="purchase__info-subtitle">Precio total final</span>
                <span class="purchase__info-price">ARS 1.225.903</span>
            </div>
        </div>

        <div class="container__itinerary">
            <div class="itinerary__title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" />
                </svg>
                <span>Itinerario</span>
            </div>
            <div class="itinerary__info">
                <div class="itinerary__info-ida">
                    <span class="itinerary__info-subtitle">IDA</span>
                    <span class="itinerary__info-CUA"><?php echo $rowVuelos[0]['CUA_ori'] . '-' . $rowVuelos[0]['CUA_dest'] ?></span>
                    <span class="itinerary__info-date"><?php echo $rowVuelos[0]['fecha_partida']->format('d/m/Y') ?></span>
                </div>
                <?php
                if ($tipoVuelo == 'ida-vuelta') { ?>
                    <div class="itinerary__info-vuelta">
                        <span class="itinerary__info-subtitle">VUELTA</span>
                        <span class="itinerary__info-CUA"><?php echo $rowVuelos[1]['CUA_ori'] . '-' . $rowVuelos[1]['CUA_dest'] ?></span>
                        <span class="itinerary__info-date"><?php echo $rowVuelos[1]['fecha_partida']->format('d/m/Y') ?></span>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </aside>

<?php
} else { ?>

    <h1>Ocurrió un error inesperado. Intentalo más tarde</h1>


<?php
} ?>

<script src="../js/main.js" type="text/javascript"></script>
<script src="../js/checkout_passengers.js" type="text/javascript"></script>