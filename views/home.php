<?php
include '../controllers/checkauth.php';
?>

<div class="container__form-reserve">
    <ul class="container__submenu-reserve">
        <li class="submenu__reserve-item active"><a href=""><i class="bi bi-airplane-fill"></i> <span>VUELOS</span></a></li>
        <li class="submenu__reserve-item"><a href=""><i class="bi bi-bag-check-fill"></i> <span>CHECK IN</span></a></li>
        <li class="submenu__reserve-item"><a href=""><i class="bi bi-clock-history"></i> <span>ESTADO DE VUELO</span></a></li>
    </ul>

    <div class="container__forms">
        <form action="" method="POST">
            <div class="container__type-flight">
                <div class="form-group container__checkbox-ida">
                    <input type="checkbox" name="checkbox_ida" id="">
                    <span>Ida</span>
                </div>
                <div class="form-group container__checkbox-ida-vuelta">
                    <input type="checkbox" name="checkbox_ida-vuelta" id="" checked>
                    <span>Ida y vuelta</span>
                </div>
            </div>

            <div class="container__data-flight">
                <div class="form-group item__data-flight">
                    <label class="form-label" for="form2Example17">Origen</label>
                    <input type="date" name="fecha_salida" id="">
                </div>
                <div class="form-group item__data-flight">
                    <label class="form-label" for="form2Example17">Destino</label>
                    <input type="date" name="fecha_vuelta" id="">
                </div>

                <div class="form-group item__data-flight">
                    <label class="form-label" for="form2Example17">Pasajeros</label>
                    <input type="number" name="cant_pasajes" id="" value="1" min="1" max="9">
                </div>

                <div class="form-group item__data-flight">
                    <label class="form-label" for="form2Example17">Clase</label>
                    <select name="clase" id="">
                        <option value="economica" selected>Economica</option>
                        <option value="business">Business</option>
                        <option value="primera">Primera Clase</option>
                    </select>
                </div>
            </div>

            <div class="form-group container__submit-flight">
                <button type="submit">Buscar vuelos</button>
            </div>
        </form>
    </div>

</div>