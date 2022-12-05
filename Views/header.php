<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="header">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <h2 class="navbar-brand"><?php if ($_SESSION['rol'] == 1) {
                                                echo "Administrador ";
                                            } elseif ($_SESSION['rol'] == 2) {
                                                echo "Instructor ";
                                            } elseif ($_SESSION['rol'] == 3) {
                                                echo "Aprendiz ";
                                            }
                                            echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                        if ($_SESSION['rol'] == 1) {
                        ?>
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    Usuario
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>Usuario/">consulta</a></li>
                                        <?php
                                        if (strncasecmp($_SERVER['REQUEST_URI'] , "/sistemavotacion/Usuario", 23) === 0) {
                                            ?>
                                            <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuarioSesion(<?php echo $_SESSION['id'];?>)">editar</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    Proceso
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>proceso/">consulta</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    Ficha
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>ficha/">consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php
                        } elseif ($_SESSION['rol'] == 2) {
                        ?>
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    Usuario
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>Usuario/">consulta</a></li>
                                        <?php
                                        if ($_SERVER['REQUEST_URI'] == "/sistemavotacion/Usuario/") {
                                            ?>
                                            <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuarioSesion(<?php echo $_SESSION['id'];?>)">editar</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    Proceso
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>proceso/">consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php
                        } elseif ($_SESSION['rol'] == 3) {
                        ?>
                            <?php
                            ?>
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    Usuario
                                    <ul>
                                    <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuario(<?php echo $_SESSION['id'];?>)">editar</a></li>
                                        <?php
                                        if ($_SERVER['REQUEST_URI'] == "/sistemavotacion/Usuario/") {
                                            ?>
                                            <li><a class="nav-link" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuario(<?php echo $_SESSION['id'];?>)">editar</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    Proceso
                                    <ul>
                                        <li><a class="nav-link" href="<?php echo constant('URL') ?>proceso/">consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php

                        }
                        ?>
                        <div class="container-fluid h-10">
                            <div class="row w-10 align-items-center">
                                <div class="col text-center">
                                    <a class="btn btn-outline-danger" href="<?php echo constant('URL') . 'usuario/cerrarsesion'; ?>">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="modal fade" id="actualizar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar tarjeton</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="frameactializar"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function seleccionarUsuario(id) {
            document.getElementById("frameactializar").innerHTML = "";
            document.getElementById("frameactializar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Usuario/seleccionar/';?>"+id+"/"+1+"\" style=\"display:block; width:100%; height:50vh;\"></iframe>";
        }
    </script>
    <br><br><br><br><br>
</body>

</html>