<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="<?php echo constant('URL'); ?>Usuario/iniciarSesion" method="post">
                                    <h2 class="fw-bold mb-2 text-uppercase">Iniciar sesion</h2>
                                    <p class="text-white-50 mb-5">Plataforma de votacion vocero</p>
                                    <div class="form-floating mb-4">
                                        <input type="text" name="user" class="form-control" id="typeEmailX" placeholder="Identificacion" required>
                                        <label for="typeEmailX" style="color:black">Email</label>
                                    </div>
                                    <div class="form-floating form-white mb-4">
                                        <input type="password" name="password" class="form-control form-control-lg" id="typePasswordX" placeholder="Contraseña" required>
                                        <label for="typePasswordX text-black" style="color:black">Password</label>
                                    </div>
                                    <p><button type="submit" class="btn btn-outline-light btn-lg px-5">Entrar</button></p>
                                    <p><?php echo $this->mensaje?></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>