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
                                                <label class="form-label" for="form3Example1m">Nombre</label>
                                                <input type="text" id="form3Example1m" class="form-control form-control-lg">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="form3Example1n">Apellido</label>
                                                <input type="text" id="form3Example1n" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example8">Dirección</label>
                                        <input type="text" id="form3Example8" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4 d-md-flex align-items-center">
                                        <h6 class="mb-0 me-4">Género:</h6>
                                        <div class="form-check form-check-inline me-4">
                                            <input class="form-check-input" type="radio" name="genderOptions" id="femaleGender" value="female">
                                            <label class="form-check-label" for="femaleGender">Mujer</label>
                                        </div>
                                        <div class="form-check form-check-inline me-4">
                                            <input class="form-check-input" type="radio" name="genderOptions" id="maleGender" value="male">
                                            <label class="form-check-label" for="maleGender">Hombre</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="genderOptions" id="otherGender" value="other">
                                            <label class="form-check-label" for="otherGender">Otro</label>
                                        </div>
                                    </div>
                    
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="stateSelect">Estado</label>
                                                <select class="form-select form-select-lg" id="stateSelect">
                                                    <option value="1">Selecciona un estado</option>
                                                    <option value="2">Opción 1</option>
                                                    <option value="3">Opción 2</option>
                                                    <option value="4">Opción 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="citySelect">Ciudad</label>
                                                <select class="form-select form-select-lg" id="citySelect">
                                                    <option value="1">Selecciona una ciudad</option>
                                                    <option value="2">Opción 1</option>
                                                    <option value="3">Opción 2</option>
                                                    <option value="4">Opción 3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example9">Fecha de Nacimiento</label>
                                        <input type="text" id="form3Example9" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example90">Código Postal</label>
                                        <input type="text" id="form3Example90" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example99">Curso</label>
                                        <input type="text" id="form3Example99" class="form-control form-control-lg">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="form3Example97">Correo Electrónico</label>
                                        <input type="text" id="form3Example97" class="form-control form-control-lg">
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
