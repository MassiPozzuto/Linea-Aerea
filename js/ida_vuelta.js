// Checkbox de ida e ida y vuelta
const idaCheckbox = document.getElementById('checkbox_ida');
const idaVueltaCheckbox = document.getElementById('checkbox_ida-vuelta');

idaCheckbox.addEventListener('change', function() {
    if (this.checked) {
        idaVueltaCheckbox.checked = false;

        $("#fecha_regreso").parent().remove()
        $("#label-fecha_salida").html("Fecha")

    } else if (!this.checked) {
        this.checked = true
    }

    
});
idaVueltaCheckbox.addEventListener('change', function() {
    if (this.checked) {
        idaCheckbox.checked = false;

        $("#fecha_salida").parent().after(`<div class="form-group item__data-flight">
                                                <label class="form-label" >Regreso</label>
                                                <input type="date" name="fecha_regreso" id="fecha_regreso">
                                            </div>`);
    } else if (!this.checked) {
        this.checked = true
    }

    
});
