
$.ajax({
    url: "../api/get_airports.php",
    type: "POST",
    dataType: "JSON",
    success: function (data) {
        console.log(data);
        
        let aeropuertos = data.aeropuertos;
        let code_html_origen = "";
        let code_html_destino = "";

        aeropuertos.forEach((aeropuerto) => {
            code_html_origen += `
            <option value="${aeropuerto.ubicacion}" id="aeropuerto_origen_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;

            code_html_destino += `
            <option value="${aeropuerto.ubicacion}" id="aeropuerto_destino_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;
        });
        
        $("#lugar_origen").append(code_html_origen);
        $("#lugar_destino").append(code_html_origen);
        /*$.fn.select2.defaults.set("language", "es");
        $("#lugar_origen").select2({ width: 170 });
        $("#lugar_destino").select2({ width: 170 });*/
    }
});

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
                        <select class="" name="lugar_origen" id="lugar_origen" >
                            <option value="Origen" hidden disabled selected>Origen</option>
                            <?php 
                            foreach($aeropuertos as $aeropuerto){ ?>
                                <option value="<?php echo $aeropuerto['id'] ?>"><?php echo utf8_encode($aeropuerto['ubicacion']) ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label" >Destino</label>
                        <select class="" name="lugar_destino" id="lugar_destino" >
                            <option value="Destino" hidden disabled selected>Destino</option>
                            <?php 
                            foreach($aeropuertos as $aeropuerto){ ?>
                                <option value="<?php echo $aeropuerto['id'] ?>"><?php echo utf8_encode($aeropuerto['ubicacion']) ?></option>
                            <?php }
                            ?>
                        </select>
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
                </div>`)
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


// Checkbox de ida e ida y vuelta
document.getElementById('form__reserve').addEventListener('click', (event) => {
    const idaCheckbox = document.getElementById('checkbox_ida');
    const idaVueltaCheckbox = document.getElementById('checkbox_ida-vuelta');

    if(event.target.id == "checkbox_ida"){
        if (idaCheckbox.checked) {
            idaVueltaCheckbox.checked = false;
    
            $("#fecha_regreso").parent().remove()
            $("#label-fecha_salida").html("Fecha")
    
        } else if (!idaCheckbox.checked) {
            idaCheckbox.checked = true
        }
    } else if (event.target.id == "checkbox_ida-vuelta"){
        if (idaVueltaCheckbox.checked) {
            idaCheckbox.checked = false;
    
            $("#fecha_salida").parent().after(`<div class="form-group item__data-flight">
                                                    <label class="form-label" >Regreso</label>
                                                    <input type="date" name="fecha_regreso" id="fecha_regreso">
                                                </div>`);
        } else if (!idaVueltaCheckbox.checked) {
            idaVueltaCheckbox.checked = true
        }
    }
})


