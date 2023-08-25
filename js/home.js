// Contenido de los formularios dependiendo de la pagina
const itemVuelos = document.getElementById('submenu__reserve-flights');
const itemCheckIn = document.getElementById('submenu__reserve-checkin');
const itemEstadoVuelo = document.getElementById('submenu__reserve-flight-status');
      
itemVuelos.addEventListener('click', function(event) {
    if(!$(itemVuelos).hasClass("active")){
        $(itemCheckIn).removeClass("active")
        $(itemEstadoVuelo).removeClass("active")
        $(itemVuelos).addClass("active")
        
        if(window.history.pushState)
            window.history.pushState(null, null, "http://127.0.0.1/Linea-Aerea/controllers/home.php?activeTab=flights");

        $("#form__reserve").empty()

        $("#form__reserve").append(
                `<div class="container__type-flight">
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
                <script src="../js/ida_vuelta.js" type="text/javascript"></script>`)
    }
});

itemCheckIn.addEventListener('click', function(event) {
    if(!$(itemCheckIn).hasClass("active")){
        $(itemVuelos).removeClass("active")
        $(itemEstadoVuelo).removeClass("active")
        $(itemCheckIn).addClass("active")

        if(window.history.pushState)
            window.history.pushState(null, null, "http://127.0.0.1/Linea-Aerea/controllers/home.php?activeTab=checkin");

        $("#form__reserve").empty()

        $("#form__reserve").append(
                `<div class="container__data-flight">
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
                </div>`)
    }
});

itemEstadoVuelo.addEventListener('click', function(event) {
    if(!$(itemEstadoVuelo).hasClass("active")){
        $(itemVuelos).removeClass("active")
        $(itemCheckIn).removeClass("active")
        $(itemEstadoVuelo).addClass("active")

        if(window.history.pushState)
            window.history.pushState(null, null, "http://127.0.0.1/Linea-Aerea/controllers/home.php?activeTab=flightStatus");

        $("#form__reserve").empty()
    }
});


