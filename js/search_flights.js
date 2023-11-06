/*const date_ida = document.getElementById("calendar_ida").getAttribute("calendar-date")
const date_vuelta = document.getElementById("calendar_vuelta").getAttribute("calendar-date")

const [month_ida, year_ida] = date_ida.split('/');
const [month_vuelta, year_vuelta] = date_vuelta.split('/');

// Obtén el elemento del calendario
const calendario_ida = document.getElementById('calendar__days-ida');
const calendario_vuelta = document.getElementById('calendar__days-vuelta');

createDinamicCalender(calendario_ida, month_ida, year_ida)
createDinamicCalender(calendario_vuelta, month_vuelta, year_vuelta)

function createDinamicCalender(calendario, month, year) {
    // Limpia el calendario antes de crear uno nuevo
    calendario.innerHTML = '';
    
    //Obtener el numero de día del primero (0 al 6) y obtener el numero del ultimo día del mes
    const firstDay = new Date(`${year}-${month}-01`).getDay();
    const lastDay = new Date(year, month, 0).getDate();

    // Obtén el primer día de la semana del mes anterior
    const firstDayPrevious = new Date(year, month - 1, 1).getDay();
    const prevMonthDays = new Date(year, month - 1, 0).getDate();
    
    // Calcula el número de semanas necesarias (casi siempre es 5, pero en algunos febreros son 4, ej: feb. 2021)
    const totalWeeks = Math.ceil((lastDay + firstDay) / 7) + 1;
    
    // Llena el calendario con los días del mes
    let dayCounter = 1;
    let dayCounterNextMonth = 1;
    
    for (let row = 1; row < totalWeeks; row++) {
        for (let col = 1; col < 8; col++) {
            const calendarDay = document.createElement('li');
            calendarDay.classList.add('calendar__day');
    
            // Calcula el índice del día en el calendario
            const dayIndex = (row - 1) * 7 + col;

            if (dayIndex < firstDayPrevious) {
                // Días del mes anterior
                const prevMonthDay = prevMonthDays - (firstDayPrevious - dayIndex) + 1;
                calendarDay.textContent = prevMonthDay;
                calendarDay.classList.add('inactive');
            } else if (dayCounter <= lastDay) {
                // Días del mes actual
                calendarDay.textContent = dayCounter;
                dayCounter++;
            } else {
                // Días del mes siguiente
                calendarDay.textContent = dayCounterNextMonth++;
                calendarDay.classList.add('inactive');
            }
    
            calendario.appendChild(calendarDay);
        }
    }
}*/