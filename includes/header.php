<header>
    
    <button class="btn list_menu"><i class="bi bi-list" id="icon-list"></i></button>
    
    <div class="container__logo">
        <img src="../img/racedo logo.png" alt="Logo empresa" width="85px">
    </div>

    <ul class="container__list-buttons">
        <li class="container__btn-home">
            <a href="home.php?activeTab=flights">RESERVAR</a>
        </li>
        <li class="container_dropdown" id="container_dropdown-manage">
            <a href="" class="">GESTIONAR</a>
            <ul class="container__dropdown--header dropdown dropdown-manage">
                <li><a href="">Información de mi reserva</a></li>
                <li><a href="">Cambio de asiento</a></li>
                <li><a href="">Cambio de clase</a></li>
                <li><a href="">Cancelar reserva</a></li>
            </ul>

        </li>
        <li class="container_dropdown" id="container_dropdown-info">
            <a href="" class="">INFORMACION</a>
            <ul class="container__dropdown--header dropdown dropdown-info">
<<<<<<< HEAD
                <li><a href="">Quienes somos</a></li>
                <li><a href="">Nuestra flota</a></li>
=======
                <li><a href="views/quienessomos.php">Quienes somos</a></li>
                <li><a href="">La flota de aviones</a></li>
>>>>>>> 1494812117f56e551a49e4f236f1d5bd4670e10c
                <li><a href="">Gastronomia de los vuelos</a></li>
            </ul>

        </li>
        <li>
            <a href="">AYUDA</a>
        </li>

    </ul>

    <div class="container__profile container_dropdown" id="container_dropdown-profile2">
        <a href="../controllers/profile.php" class="btn-profile">
            <i class="bi bi-person-circle"></i>
        </a>
        <ul class="container__dropdown--header dropdown dropdown-profile2">
            <li><a href="">Mi información</a></li>
            <li><a href="">Editar información</a></li>
            <li><a href="">Cerrar sesión</a></li>
        </ul>
    </div>
</header>
