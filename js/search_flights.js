var calendarioIda = document.getElementById('calendar_ida');
var calendarioVuelta = document.getElementById('calendar_vuelta');

validFlights()

var vuelosIdaSeleccionables = calendarioIda.querySelectorAll('.day-selectable');
// Agrega un evento de clic a cada elemento
vuelosIdaSeleccionables.forEach(function (elemento) {
    elemento.addEventListener('click', function () {
        var vueloSeleccionado = calendarioIda.querySelector('.day-selected');

        if (vueloSeleccionado != elemento) {
            vueloSeleccionado.classList.remove("day-selected")
            elemento.classList.add("day-selected")
            validFlights()
            //Falta actualizar lugares donde aparecen la fechas seleccionadas y precio
            //Fecha del header del calendario
            let diaSeleccionado = elemento.getAttribute('data-day').split('-')
            let textHeaderCalendar = document.getElementById('calendar__departure-date').innerText.split(" ")
            let newTextHeaderCalendar = `${diaSeleccionado[2]} de ${textHeaderCalendar[2]} de ${textHeaderCalendar[4]}`
            document.getElementById('calendar__departure-date').innerText = newTextHeaderCalendar

            //Fecha del footer general
            document.getElementById('footer__departure-date').innerText = `${diaSeleccionado[2]}/${diaSeleccionado[1]}/${diaSeleccionado[0]}`

            //Precio en el footer
            let precio = elemento.querySelector('.day__data-price').innerText
            let precioVuelta = document.getElementById('footer__return-price').innerText.split(" ")[1]
            document.getElementById('footer__departure-price').innerText = `ARS ${formatearNumeroConPuntos(precio)}`
            document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio) + parseInt(precioVuelta.replace(/\./g, '')))}`
        }
    });
});


var vuelosVueltaSeleccionables = calendarioVuelta.querySelectorAll('.day-selectable');
// Agrega un evento de clic a cada elemento
vuelosVueltaSeleccionables.forEach(function (elemento) {
    elemento.addEventListener('click', function () {
        var vueloSeleccionado = calendarioVuelta.querySelector('.day-selected');

        if (vueloSeleccionado != elemento) {
            vueloSeleccionado.classList.remove("day-selected")
            elemento.classList.add("day-selected")
            validFlights()
            //Falta actualizar lugares donde aparecen la fechas seleccionadas y precio
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

function validFlights() {
    var vueloIdaValido = calendarioIda.querySelector('.day-selectable.day-selected');
    var vueloVueltaValido = calendarioVuelta.querySelector('.day-selectable.day-selected');


    if (vueloIdaValido && vueloVueltaValido) {
        document.querySelector('.footer_data-flights').style.display = 'flex'
        //Precio en el footer
        let precio = vueloIdaValido.querySelector('.day__data-price').innerText
        let precioVuelta = vueloVueltaValido.querySelector('.day__data-price').innerText
        document.getElementById('footer__departure-price').innerText = `ARS ${formatearNumeroConPuntos(precio)}`
        document.getElementById('footer__return-price').innerText = `ARS ${formatearNumeroConPuntos(precioVuelta)}`
        document.getElementById('footer__total-price').innerText = `ARS ${formatearNumeroConPuntos(parseInt(precio) + parseInt(precioVuelta.replace(/\./g, '')))}`
    }
}

function formatearNumeroConPuntos(numero) {
    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
