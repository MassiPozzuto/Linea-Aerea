<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">

    <title>Registro de Sesión</title>
</head>

<body>
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="../img/gettyimages-528363573-091201.jpg" alt="Imagen de registro" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Registro de Sesión</h3>

                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="form3Example1m">Nombre:</label>
                                                <input type="text" id="form3Example1m" class="form-control form-control-lg">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="form3Example1n">Apellido:</label>
                                                <input type="text" id="form3Example1n" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example8">Email:</label>
                                        <input type="text" id="form3Example8" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example9">Contraseña: </label>
                                        <div class="input-group">
                                            <input type="password" id="form3Example9" class="form-control form-control-lg">
                                            <button id="togglePassword" class="btn btn-outline-secondary" type="button">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <p class="warning" style="color: red; display: none;">La contraseña debe
                                            contener al menos un número.</p>
                                        <p class="warning" style="color: red; display: none;">La contraseña debe
                                            contener al menos una letra mayúscula.</p>
                                        <p id="lengthCounter" style="display: none;">Longitud de contraseña: <span id="lengthValue">0</span></p>
                                    </div>

                                    <script>
                                        const passwordInput = document.getElementById('form3Example9');
                                        const togglePasswordButton = document.getElementById('togglePassword');
                                        const warnings = document.querySelectorAll('.warning');
                                        const lengthValue = document.getElementById('lengthValue');

                                        togglePasswordButton.addEventListener('click', () => {
                                            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
                                        });

                                        passwordInput.addEventListener('input', () => {
                                            const password = passwordInput.value;
                                            const hasUppercase = /[A-Z]/.test(password);
                                            const hasNumber = /\d/.test(password);

                                            warnings[0].style.display = hasNumber ? 'none' : 'block';
                                            warnings[1].style.display = hasUppercase ? 'none' : 'block';

                                            lengthValue.textContent = password.length;
                                            lengthCounter.style.display = 'block';
                                            lengthValue.style.color = password.length > 8 ? 'green' : 'black';
                                        });
                                    </script>
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example9">Teléfono:</label>
                                        <input type="text" id="form3Example9" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example90">DNI:</label>
                                        <input type="text" id="form3Example90" class="form-control form-control-lg">
                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="button" class="btn btn-light btn-lg me-2">Restablecer</button>
                                        <button type="button" class="btn btn-warning btn-lg">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>