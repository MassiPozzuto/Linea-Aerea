document.getElementById('form__checkout-passengers').addEventListener('submit', (e) => {
    e.preventDefault()

    if (validations()) {
        //Hago submit
        e.target.submit()
    }

})

function validations() {
    var isValid = true;
    var email = document.querySelector('input[name="reserve_email"]');
    var confirmEmail = document.querySelector('input[name="reserve_email-confirm"]');
    var phoneNumber = document.querySelector('input[name="reserve_tel"]');

    // Validar correo electrónico
    if (!email.value.trim()) {
        isValid = false;
        failValidation(email, 'Por favor, ingrese su correo electrónico.');

    } else if (!isValidEmail(email.value)) {
        isValid = false;
        failValidation(email, 'Por favor, ingrese un correo electrónico válido.');
    }

    // Validar confirmación del correo electrónico
    if (!confirmEmail.value.trim()) {
        isValid = false;
        failValidation(confirmEmail, 'Por favor, confirme su correo electrónico.');

    } else if (!isValidEmail(confirmEmail.value)) {
        isValid = false;
        failValidation(confirmEmail, 'Por favor, ingrese un correo electrónico válido.');

    } else if (email.value.trim() !== confirmEmail.value.trim()) {
        isValid = false;
        failValidation(confirmEmail, 'Los correos electrónicos no coinciden. Por favor, inténtelo de nuevo.');
    }

    // Validar número de teléfono
    if (!phoneNumber.value.trim()) {
        isValid = false;
        failValidation(phoneNumber, 'Por favor, ingrese su número de teléfono.');
        
    } else if (!isValidPhoneNumber(phoneNumber)) {
        isValid = false;
        failValidation(phoneNumber, 'Por favor, ingrese un número de teléfono válido.');
    }

    let cantPasajeros = document.querySelector('.container__all-passengers').id.split("-")[1]
    // Iterar sobre los pasajeros
    for (var i = 1; i <= cantPasajeros; i++) {
        var passengerName = document.querySelector('input[name="passenger_name-' + i + '"]');
        var passengerSurname = document.querySelector('input[name="passenger_surname-' + i + '"]');
        var passengerFrom = document.querySelector('select[name="passenger_from-' + i + '"]');
        var passengerDni = document.querySelector('input[name="passenger_dni-' + i + '"]');

        // Validar campos del pasajero
        if (!passengerName.value.trim()) {
            isValid = false;
            failValidation(passengerName, 'Por favor, ingrese el nombre del pasajero ' + i);
        }

        if (!passengerSurname.value.trim()) {
            isValid = false;
            failValidation(passengerSurname, 'Por favor, ingrese el apellido del pasajero ' + i);
        }

        if (!passengerFrom.value.trim()) {
            isValid = false;
            failValidation(passengerFrom, 'Por favor, seleccione la nacionalidad del pasajero ' + i);
        }

        if (!isValidDni(passengerDni.value)) {
            isValid = false;
            failValidation(passengerDni, 'Por favor, ingrese el DNI/Pasaporte del pasajero ' + i);
        }
    }

    // Continuar con la lógica si todos los campos son válidos
    return isValid
}

// Función para validar el formato del correo electrónico
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Función para validar el formato del número de teléfono
function isValidPhoneNumber(phoneNumber) {
    var phoneRegex = /^\d{10}$/; // Suponiendo un formato de 10 dígitos
    return phoneRegex.test(phoneNumber);
}

// Función para validar el formato del DNI
function isValidDni(dni) {
    var dniRegex = /^\d{7,8}$/; // Ajustar según el formato del DNI
    return dniRegex.test(dni);
}