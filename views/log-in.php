<?php
include '../controllers/login.php';
?>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap.css">

<section class="vh-100" style="background-color: #73B1FF;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="background-color: #ffffff">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="../img/gettyimages-528363573-091201.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="login.php" method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicio de Sesión</h5>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Correo Electronico:</label>
                    <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Contraseña:</label>
                    <input type="password" id="form2Example27" name="password" class="form-control form-control-lg" />
                    <a class="small text-muted" href="#!">No recordas la contraseña?</a>
                  </div>

                  <div class="d-grid gap-2">
                    <button class="btn btn-dark btn-lg btn-block" type="button">Iniciar sesión</button>
                  </div>
                  <br>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes cuenta? <a href="register.php" style="color: #393f81;">Registrate Acá </a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>