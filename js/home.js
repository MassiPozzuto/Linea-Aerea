//$(document).ready(function () { });


var url = new URL(window.location);

var activeTab = url.searchParams.get('activeTab');

if (activeTab == 'flights') {
    loadAirports();
    disabledAirports();
    checkboxIdaYVuelta();
    minFechas();
}

// Logica de checkbox  de Ida e Ida y Vuelta
function checkboxIdaYVuelta() {
    const idaCheckbox = document.getElementById('checkbox_ida');
    const idaVueltaCheckbox = document.getElementById('checkbox_ida-vuelta');

    idaCheckbox.addEventListener('change', (event) => {
        if (idaCheckbox.checked) {
            idaVueltaCheckbox.checked = false;

            $("#fecha_regreso").parent().remove()
            $("#label-fecha_salida").html("Fecha")

            //document.getElementById("fecha_salida").max = "";
        } else if (!idaCheckbox.checked) {
            idaCheckbox.checked = true
        }
    })

    idaVueltaCheckbox.addEventListener('change', (event) => {
        if (idaVueltaCheckbox.checked) {
            idaCheckbox.checked = false;

            $("#fecha_salida").parent().after(`<div class="form-group item__data-flight">
                                                    <label class="form-label">Regreso</label>
                                                    <input type="date" class="form__reserve-input" name="fecha_regreso" id="fecha_regreso">
                                                    <p class="errormessage__form"></p>
                                                </div>`);
            
            if (!isNaN(Date.parse(document.getElementById("fecha_salida").value))) {
                document.getElementById("fecha_regreso").min = document.getElementById("fecha_salida").value;
            }
        } else if (!idaVueltaCheckbox.checked) {
            idaVueltaCheckbox.checked = true
        }
    })
}


// Logica de aeropuerto de origen y de destino
var valueOrigenPrevio = 0;
var valueDestinoPrevio = 0;

function disabledAirports() {
    const lugarOrigen = document.getElementById("lugar_origen");
    const lugarDestino = document.getElementById("lugar_destino");

    lugarOrigen.addEventListener('change', (event) => {
        if (lugarOrigen.value != 0) {
            if (valueDestinoPrevio != 0) {
                $(`#aeropuerto_destino_${valueDestinoPrevio}`).prop('disabled', false);
            }
            
            $(`#aeropuerto_destino_${lugarOrigen.value}`).prop('disabled', true);
            valueDestinoPrevio = lugarOrigen.value;
        }
    })

    lugarDestino.addEventListener('change', (event) => {
        if (lugarDestino.value != 0) {
            if (valueOrigenPrevio != 0) {
                $(`#aeropuerto_origen_${valueOrigenPrevio}`).prop('disabled', false);
            }

            $(`#aeropuerto_origen_${lugarDestino.value}`).prop('disabled', true);
            valueOrigenPrevio = lugarDestino.value;
        }
    })
}

function loadAirports() {
    $.ajax({
        url: "../api/get_airports.php",
        type: "POST",
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
        
            let aeropuertos = data.aeropuertos;
            let code_html_origen = "";
            let code_html_destino = "";
            let i = 1;

            aeropuertos.forEach((aeropuerto) => {
                code_html_origen += `
                    <option value="${aeropuerto.id}" id="aeropuerto_origen_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;

                code_html_destino += `
                    <option value="${aeropuerto.id}" id="aeropuerto_destino_${aeropuerto.id}">${aeropuerto.ubicacion}</option>`;
                i++
            });
        
            $("#lugar_origen").append(code_html_origen);
            $("#lugar_destino").append(code_html_destino);
        }
    });
}

// Logica de fechas de salida y llegada
function minFechas() {
    var fechaSalida = document.getElementById("fecha_salida")
    var fechaRegreso = document.getElementById("fecha_regreso")

    let hoy = new Date();
    let dd = hoy.getDate();
    let mm = hoy.getMonth() + 1;
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    fechaSalida.min = hoy.getFullYear() + '-' + mm + '-' + dd;
    fechaRegreso.min = hoy.getFullYear() + '-' + mm + '-' + dd;

    fechaSalida.addEventListener('change', (event) => {
        fechaRegreso = document.getElementById("fecha_regreso")
        if (fechaRegreso != null) {
            if (!isNaN(Date.parse(event.target.value))) {
                if (event.target.value > fechaRegreso.value && fechaRegreso.value != "") {
                    fechaRegreso.value = event.target.value
                }
                fechaRegreso.min = event.target.value;
            } else {
                fechaRegreso.min = hoy.getFullYear() + '-' + mm + '-' + dd;
            }
        }
    })
}




// Contenido de los formularios dependiendo de la pagina
const itemVuelos = document.getElementById('submenu__reserve-flights');
const itemCheckIn = document.getElementById('submenu__reserve-checkin');
const itemEstadoVuelo = document.getElementById('submenu__reserve-flight-status');
    
itemVuelos.addEventListener('click', function (event) {
    event.preventDefault();
    if(!$(itemVuelos).hasClass("active")){
        $(itemCheckIn).removeClass("active")
        $(itemEstadoVuelo).removeClass("active")
        $(itemVuelos).addClass("active")
        
        url.searchParams.set("activeTab", "flights")
        if(window.history.pushState)
            window.history.pushState(null, null, url.href);

        $("#form__reserve").empty()

        $("#form__reserve").append(
                `<div class="container__type-flight">
                    <div class="form-group container__checkbox-ida">
                        <input type="checkbox" name="checkbox_ida" id="checkbox_ida">
                        <span>Ida</span>
                        <p class="errormessage__form"></p>
                    </div>
                    <div class="form-group container__checkbox-ida-vuelta">
                        <input type="checkbox" name="checkbox_ida-vuelta" id="checkbox_ida-vuelta" checked>
                        <span>Ida y vuelta</span>
                        <p class="errormessage__form"></p>
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
                </div>`)
        
        loadAirports();
        minFechas();
        disabledAirports();
        checkboxIdaYVuelta();
    }
});
itemCheckIn.addEventListener('click', function (event) {
    event.preventDefault();
    if(!$(itemCheckIn).hasClass("active")){
        $(itemVuelos).removeClass("active")
        $(itemEstadoVuelo).removeClass("active")
        $(itemCheckIn).addClass("active")

        url.searchParams.set("activeTab", "checkin")
        if(window.history.pushState)
            window.history.pushState(null, null, url.href);

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
itemEstadoVuelo.addEventListener('click', function (event) {
    event.preventDefault();
    if(!$(itemEstadoVuelo).hasClass("active")){
        $(itemVuelos).removeClass("active")
        $(itemCheckIn).removeClass("active")
        $(itemEstadoVuelo).addClass("active")

        url.searchParams.set("activeTab", "flightStatus")
        if(window.history.pushState)
            window.history.pushState(null, null, url.href);

        $("#form__reserve").empty()
    }
});


document.getElementById("form__reserve").addEventListener("submit", (event) => {
    event.preventDefault();
    
    var puntosValidacion = 0;
    if (activeTab == "flights") {
        var idaCheckbox = document.getElementById('checkbox_ida');
        var idaVueltaCheckbox = document.getElementById('checkbox_ida-vuelta');
        var lugarOrigen = document.getElementById("lugar_origen");
        var lugarDestino = document.getElementById("lugar_destino");
        var cantPasajeros = document.getElementById("cant_pasajeros");
        var clase = document.getElementById("clase");

        var fechaSalida = document.getElementById("fecha_salida");
        if (idaVueltaCheckbox.checked && !idaCheckbox.checked) {
            var fechaRegreso = document.getElementById("fecha_regreso");

            correctaValidacion(idaCheckbox);
            correctaValidacion(idaVueltaCheckbox);
            puntosValidacion++;
            
            if (Date.parse(fechaRegreso.value) < Date.parse(fechaSalida.value)) {
                //Vuelve antes de irse
                fallaValidacion(fechaRegreso, "Ingrese una fecha valida")
            } else {
                correctaValidacion(fechaRegreso);
                puntosValidacion++;
                
                if (fechaSalida.value == "") {
                    //No ingreso fecha de salida
                    fallaValidacion(fechaSalida, "Ingrese una fecha valida")
                } else {
                    correctaValidacion(fechaSalida);
                    puntosValidacion++;
                }
                if (fechaRegreso.value == "") {
                    //No ingreso fecha de vuelta
                    fallaValidacion(fechaRegreso, "Ingrese una fecha valida")
                } else {
                    correctaValidacion(fechaRegreso);
                    puntosValidacion++;
                }
            }  
        } else if ((!idaVueltaCheckbox.checked && !idaCheckbox.checked) || (idaVueltaCheckbox.checked && idaCheckbox.checked)){
            //Estan los dos checkbox activos o los dos desactivados
            fallaValidacion(idaVueltaCheckbox, "Ingrese una opción valida")
        }
        
        if (lugarOrigen.value == lugarDestino.value && lugarOrigen.value != 0 && lugarDestino.value != 0) {
            //Ingreso los mismos aeropuertos
            fallaValidacion(lugarDestino, "No puede viajar al mismo aeropuerto de origen")
        } else {
            correctaValidacion(lugarDestino);
            puntosValidacion++;

            if (lugarOrigen.value == 0) {
                //No ingreso un aeropuerto de origen
                fallaValidacion(lugarOrigen, "Ingrese un aeropuerto")
            } else {
                correctaValidacion(lugarOrigen);
                puntosValidacion++;
            }
            if (lugarDestino.value == 0) {
                //No ingreso un aeropuerto de destino
                fallaValidacion(lugarDestino, "Ingrese un aeropuerto")
            } else {
                correctaValidacion(lugarDestino);
                puntosValidacion++;
            }
        }
        

        if (cantPasajeros.value < 1 || cantPasajeros.value > 9) {
            //Numero de pasajeros invalido
            fallaValidacion(cantPasajeros, "Ingrese entre 1 y 9 pasajeros")
        } else {
            correctaValidacion(cantPasajeros);
            puntosValidacion++;
        }

        if (clase.value != "economica" && clase.value != "business" && clase.value != "primera") {
            //Clase invalida
            fallaValidacion(cantPasajeros, "Ingrese una clase valida")
        } else {
            correctaValidacion(clase);
            puntosValidacion++;
        }

        if (idaVueltaCheckbox.checked) {
            if (puntosValidacion == 9) {
                console.log("Los datos ingresados son validos :)")

                /*let datos = {
                    'lugarOrigen': lugarOrigen.options[lugarOrigen.value].id,
                    'lugarDestino': lugarDestino.options[lugarDestino.value].id,
                    'fechaSalida': fechaSalida.value,
                    'fechaRegreso' : fechaRegreso.value,
                    'cantPasajeros': cantPasajeros.value,
                    'clase': clase.value
                };*/
                
                event.target.submit();
            }
        } else if (idaCheckbox.checked) {
            if (puntosValidacion == 5) {
                console.log("Los datos ingresados son validos :)")

                /*let datos = {
                    'lugarOrigen': lugarOrigen.options[lugarOrigen.value].id,
                    'lugarDestino': lugarDestino.options[lugarDestino.value].id,
                    'fechaSalida': fechaSalida.value,
                    'cantPasajeros': cantPasajeros.value,
                    'clase': clase.value
                };*/

                event.target.submit()
            }
        }

    }

});

const fallaValidacion = (input, msj) => {
    const form = input.parentElement;
    const warning = form.querySelector("p");
    warning.innerText = msj;
    form.classList.remove("success");
    form.classList.add("fail");
};
const correctaValidacion = (input) => {
    const form = input.parentElement;
    const warning = form.querySelector("p");
    warning.innerText = null;
    form.classList.remove("fail");
    form.classList.add("success");
};

/*function submitForm(datos) {
    $.ajax({
        url: "../api/search_flights.php",
        type: "POST",
        data: datos,
        dataType: "JSON",
        success: function (data) {
            console.log(data)
        }
    });
}*/
