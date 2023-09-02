loadAirports();

function loadAirports() {
    $.ajax({
        url: "../api/get_airports.php",
        type: "POST",
        dataType: "JSON",
        success: function (data) {
            console.log(data);
        
            let aeropuertos = data.aeropuertos;
            let code_html_origen = "";
            let code_html_destino = "";
            let i = 1;

            aeropuertos.forEach((aeropuerto) => {
                code_html_origen += `
                    <option value="${i}" id="aeropuerto_origen_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;

                code_html_destino += `
                    <option value="${i}" id="aeropuerto_destino_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;
                i++
            });
        
            $("#lugar_origen").append(code_html_origen);
            $("#lugar_destino").append(code_html_destino);
        }
    });
}







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
                        <label class="form-label">Origen</label>
                        <select class="form__reserve-input" name="lugar_origen" id="lugar_origen">
                            <option value="Origen" hidden disabled selected>Origen</option>
                        </select>
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label">Destino</label>
                        <select class="form__reserve-input" name="lugar_destino" id="lugar_destino" style="padding: 12px;">
                            <option value="Destino" hidden disabled selected>Destino</option>
                        </select>
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label" id="label-fecha_salida">Partida</label>
                        <input type="date" class="form__reserve-input" name="fecha_salida" id="fecha_salida">
                    </div>
                    <div class="form-group item__data-flight">
                        <label class="form-label">Regreso</label>
                        <input type="date" class="form__reserve-input" name="fecha_regreso" id="fecha_regreso">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label">Pasajeros</label>
                        <input type="number" class="form__reserve-input" name="cant_pasajes" id="" value="1" min="1" max="9">
                    </div>

                    <div class="form-group item__data-flight">
                        <label class="form-label">Clase</label>
                        <select class="form__reserve-input" name="clase" id="">
                            <option value="economica" selected>Economica</option>
                            <option value="business">Business</option>
                            <option value="primera">Primera Clase</option>
                        </select>
                    </div>
                </div>

                <div class="form-group container__submit-flight">
                    <button type="submit">Buscar vuelos</button>
                </div>`)
        loadAirports();
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


// Checkbox de ida e ida y vuelta. Lugar de origen y de destino
var valueOrigenPrevio = 0;
var valueDestinoPrevio = 0;

document.getElementById('form__reserve').addEventListener('click', (event) => {
    const idaCheckbox = document.getElementById('checkbox_ida');
    const idaVueltaCheckbox = document.getElementById('checkbox_ida-vuelta');

    
    if (event.target == idaCheckbox) {
        if (idaCheckbox.checked) {
            idaVueltaCheckbox.checked = false;
    
            $("#fecha_regreso").parent().remove()
            $("#label-fecha_salida").html("Fecha")
    
        } else if (!idaCheckbox.checked) {
            idaCheckbox.checked = true
        }
    } else if (event.target == idaVueltaCheckbox) {
        if (idaVueltaCheckbox.checked) {
            idaCheckbox.checked = false;
    
            $("#fecha_salida").parent().after(`<div class="form-group item__data-flight">
                                                    <label class="form-label">Regreso</label>
                                                    <input type="date" class="form__reserve-input" name="fecha_regreso" id="fecha_regreso">
                                                </div>`);
        } else if (!idaVueltaCheckbox.checked) {
            idaVueltaCheckbox.checked = true
        }
    } else if (event.target.className.includes("select-airport")) {
        const lugarOrigen = document.getElementById("lugar_origen");
        const lugarDestino = document.getElementById("lugar_destino");

        if (event.target.value != 0) {
            
            if (event.target == lugarOrigen) {
                if (valueDestinoPrevio != 0) {
                    $(lugarDestino.options[valueDestinoPrevio]).prop('disabled', false);
                }
                
                $(lugarDestino.options[event.target.value]).prop('disabled', true);
                valueDestinoPrevio = event.target.value;
            } else if (event.target == lugarDestino) {
                if (valueOrigenPrevio != 0) {
                    $(lugarOrigen.options[valueOrigenPrevio]).prop('disabled', false);
                }

                $(lugarOrigen.options[event.target.value]).prop('disabled', true);
                valueOrigenPrevio = event.target.value;
            }
        }
    }
})


