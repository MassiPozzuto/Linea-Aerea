var calendarioIda = document.getElementById('calendar_ida');
var calendarioVuelta = document.getElementById('calendar_vuelta');

validFlights()

function validFlights() {
    var vueloIdaValido = calendarioIda.querySelector('.day-selectable.day-selected');
    var vueloVueltaValido = calendarioVuelta.querySelector('.day-selectable.day-selected');

    if (vueloIdaValido && vueloVueltaValido) {
        document.querySelector('.footer_data-flights').style.display = 'flex'
    }
}

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
        }
    });
});