// Menu desplegable
const btn_list = document.querySelector('.list_menu')
const list_menu = document.querySelector('.container__list-buttons')

btn_list.addEventListener('click', () => {
    list_menu.classList.toggle('activo')

    $('#icon-list').toggleClass("bi-list bi-x-lg")
})


// Dropdowns header
if ($(".list_menu").css("display") == "none") {
    //Dropdown por hover
    $(".container_dropdown").hover(
        function () {
            id = this.id.split("-")[1]
            $(".dropdown-" + id).stop(true).delay(300).slideDown(250)
        }, function () {
            $(".dropdown-" + id).stop(true).delay(0).slideUp(250)
        }
    )
} else {
    //Dropdown por click
    $(".container_dropdown").click(function (e) {
        var id = this.id.split("-")[1]
        $(this).children().first().attr("href", "#")

        //Todos los dropdowns
        dropdowns = $(".dropdown")
        for (i = 0; i < dropdowns.length; i++) {
            var btn_dropdown = $(dropdowns[i]).parent().children().first()

            if (dropdowns[i] != $(".dropdown-" + id)[0]) {
                // Cerrar los dropdowns abiertos, si es que hay
                $(dropdowns[i]).slideUp(250)

                if (btn_dropdown.hasClass("btn_dropdown-active")) {
                    btn_dropdown.removeClass("btn_dropdown-active")
                }
            } else {
                // Abrir el dropdown seleccionado
                $(".dropdown-" + id).slideToggle(250)
                console.log(id)
                if (id != "profile2") {
                    if (btn_dropdown.hasClass("btn_dropdown-active")) {
                        btn_dropdown.removeClass("btn_dropdown-active")
                        btn_dropdown.addClass("btn_dropdown-disabled")
                    } else {
                        btn_dropdown.removeClass("btn_dropdown-disabled")
                        btn_dropdown.addClass("btn_dropdown-active")
                    }

                }
            }
        }
    })
}



const failValidation = (input, msj) => {
    const form_group = input.parentElement;
    const msj_error = form_group.querySelector("p");
    msj_error.style.display = "block";
    msj_error.innerText = msj;

    form_group.classList.remove("success")
    form_group.classList.add("fail")
};
const successValidation = (input) => {
    const form_group = input.parentElement;
    const msj_error = form_group.querySelector("p");
    msj_error.style.display = "none";
    msj_error.innerText = "";

    form_group.classList.remove("fail")
    form_group.classList.add("success")
};

const alertMsj = (msj, type, time = 2000) => {
    const alertMsjHTML = `<div class="alert_msj msj_${type}">
                            <span>${msj}</span>
                            <span id="border_msj"></span>
                        </div>`
    document.querySelector('body').insertAdjacentHTML('afterend', alertMsjHTML);

    setTimeout(() => {
        // Eliminar la alerta después de 1 segundo
        document.querySelector('.alert_msj').remove()
    }, time);

    // Ajustar la animación del borde según el tiempo
    document.getElementById('border_msj').style.animationDuration = `${time + 3}ms`;
};

