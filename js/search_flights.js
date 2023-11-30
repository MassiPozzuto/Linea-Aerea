var calendarioIda = document.getElementById('calendar_ida');
var calendarioVuelta = document.getElementById('calendar_vuelta') || null;

validFlights()

var vuelosIdaSeleccionables = calendarioIda.querySelectorAll('.day-selectable');
// Agrega un evento de clic a cada elemento
vuelosIdaSeleccionables.forEach(function (elemento) {
    elemento.addEventListener('click', function () {
        var vueloSeleccionado = calendarioIda.querySelector('.day-selected');

        if (vueloSeleccionado != elemento) {
            vueloSeleccionado.classList.remove("day-selected")
            elemento.classList.add("day-selected")

            var idVueloIda = elemento.id.split("_")[1]
            document.getElementById('form-flights-ida').value = idVueloIda

            validFlights()

            //Fecha del header del calendario
            let diaSeleccionado = elemento.getAttribute('data-day').split('-')
            let textHeaderCalendar = document.getElementById('calendar__departure-date').innerText.split(" ")
            let newTextHeaderCalendar = `${diaSeleccionado[2]} de ${textHeaderCalendar[2]} de ${textHeaderCalendar[4]}`
            document.getElementById('calendar__departure-date').innerText = newTextHeaderCalendar

            //Fecha del footer general
            document.getElementById('footer__departure-date').innerText = `${diaSeleccionado[2]}/${diaSeleccionado[1]}/${diaSeleccionado[0]}`

            //Precio en el footer
            let precio = elemento.querySelector('.day__data-price').innerText
            let precioVuelta = document.getElementById('footer__return-price') || 0;
            if (precioVuelta != 0) {
                precioVuelta = precioVuelta.innerText.split(" ")[1].replace(/\./g, '')
            }
            document.getElementById('footer__departure-price').innerText = `ARS ${formatearNumeroConPuntos(precio)}`
            document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio) + parseInt(precioVuelta))}`
        }
    });
});

if (calendarioVuelta) {
    var vuelosVueltaSeleccionables = calendarioVuelta.querySelectorAll('.day-selectable');
    // Agrega un evento de clic a cada elemento
    vuelosVueltaSeleccionables.forEach(function (elemento) {
        elemento.addEventListener('click', function () {
            var vueloSeleccionado = calendarioVuelta.querySelector('.day-selected');
    
            if (vueloSeleccionado != elemento) {
                vueloSeleccionado.classList.remove("day-selected")
                elemento.classList.add("day-selected")

                var idVueloVuelta = elemento.id.split("_")[1]
                document.getElementById('form-flights-vuelta').value = idVueloVuelta

                validFlights()  

                //Fecha del header del calendario
                let diaSeleccionado = elemento.getAttribute('data-day').split('-')
                let textHeaderCalendar = document.getElementById('calendar__return-date').innerText.split(" ")
                let newTextHeaderCalendar = `${diaSeleccionado[2]} de ${textHeaderCalendar[2]} de ${textHeaderCalendar[4]}`
                document.getElementById('calendar__return-date').innerText = newTextHeaderCalendar
    
                //Fecha del footer general
                document.getElementById('footer__return-date').innerText = `${diaSeleccionado[2]}/${diaSeleccionado[1]}/${diaSeleccionado[0]}`
    
                //Precio en el footer
                let precio = elemento.querySelector('.day__data-price').innerText
                let precioIda = document.getElementById('footer__departure-price').innerText.split(" ")[1]
                document.getElementById('footer__return-price').innerText = `ARS ${formatearNumeroConPuntos(precio)}`
                document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio) + parseInt(precioIda.replace(/\./g, '')))}`
            }
        });
    });
}


function validFlights() {
    // Traer el vuelo de ida seleccionado que sea valido (o sea, aquel que sea seleccionable y lo este)
    var vueloIdaValido = calendarioIda.querySelector('.day-selectable.day-selected');

    //Valido si existe el vuelo
    if (vueloIdaValido) {
        //Si existe dicho vuelo, entonces:
        //Traigo el precio del vuelo que esta seleccionado y lo coloco en el footer
        let precio = vueloIdaValido.querySelector('.day__data-price').innerText
        document.getElementById('footer__departure-price').innerText = `ARS ${formatearNumeroConPuntos(precio)}`

        //Verifico si existe el calendario para seleciconar vuelos de vuelta
        if (calendarioVuelta) {
            //Si existe:
            let vueloVueltaValido = calendarioVuelta.querySelector('.day-selectable.day-selected');
            if (vueloVueltaValido) {
                //Si hay un vuelo seleccionado:
                //Traigo el precio de dicho vuelo
                let precioVuelta = vueloVueltaValido.querySelector('.day__data-price').innerText
                //Reemplazo el valor que representa el precio del vuelo de vuelta y el del total en el footer
                document.getElementById('footer__return-price').innerText = `ARS ${formatearNumeroConPuntos(precioVuelta)}`
                document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio) + parseInt(precioVuelta.replace(/\./g, '')))}`
            } else {
                //Si no hay un vuelo seleccionado: no hago nada más
                return null
            }
        } else {
            //Si no existe:
            //Coloco en el elemento que contiene el precio total el precio del vuelo de ida
            document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio))}`
        }

        //Muestro el footer
        document.querySelector('.footer_data-flights').style.display = 'flex'
    }
}

function formatearNumeroConPuntos(numero) {
    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}



document.getElementById('form__view-flights').addEventListener('submit', (e) => {
    e.preventDefault()
    var isValid = true

    let vueloIdaSeleccionado = e.target.querySelector('input[name="flights-ida"]')
    if (!vueloIdaSeleccionado.value) {
        //No tiene un vuelo de ida seleccionado
        isValid = false
    } else if (isNaN(vueloIdaSeleccionado.value)) {
        //No es un valor numerico
        isValid = false
    }

    if (calendarioVuelta) {
        let vueloVueltaSeleccionado = e.target.querySelector('input[name="flights-vuelta"]')
        if (!vueloVueltaSeleccionado.value) {
            //No tiene un vuelo de ida seleccionado
            isValid = false
        } else if (isNaN(vueloVueltaSeleccionado.value)) {
            //No es un valor numerico
            isValid = false
        }
    }

    console.log(vueloIdaSeleccionado.value)
    if (isValid) {
        e.target.submit()
    }

})