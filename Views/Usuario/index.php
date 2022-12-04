<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div class="container-lg">
        <h1>Usuarios</h1>
        <h5><?php echo $this->mensaje; ?></h5>
        <div class="container-lg border rounded-top">
            <input type="text" class="m-2" id="buscar" placeholder="Buscar">
            <button class="btn btn-outline-dark m-2 float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <div class="modal fade" id="nuevo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="<?php echo constant('URL') ?>Usuario/registrar/0" style="display:block; width:100%; height:50vh;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Identificacion</th>
                        <th>Rol</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>correo</th>
                        <th>estado</th>
                        <th>ficha</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    include_once 'models/usuarioModel.php';
                    $i = 1;
                    foreach($this->datos as $row) { 
                        $usuario = new UsuarioModel();
                        $usuario = $row;
                        if ($_SESSION['rol'] == 1) {
                            ?>
                                <tr id="fila-<?php echo $usuario->id; ?>">
                            <td> <?php echo $i; ?></td>
                            <td> <?php echo $usuario->identificacion; ?></td>
                            <td> <?php switch ($usuario->rol) {
                                case 1:
                                    echo 'Admin';
                                    break;
                                case 2:
                                    echo 'Inst';
                                    break;
                                case 3:
                                    echo 'Apren';
                                    break;    
                                default:
                                    echo 'Error';
                                    break;
                            } ?></td>
                            <td> <?php echo $usuario->nombre; ?></td>
                            <td> <?php echo $usuario->apellido; ?></td>
                            <td> <?php echo $usuario->correo; ?></td>
                            <td> <?php echo $usuario->estado; ?></td>
                            <td> <?php echo $usuario->numeroFicha; ?></td>
                            <?php 
                            if ($_SESSION['rol'] == 1) {
                            ?>
                                <td class="p-0"><button class="btn btn-outline-primary w-100 h-100 m-0" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuario(<?php echo $usuario->id;?>)">Editar</button></td>
                            <?php 
                            }
                            ?>
                            <td class="p-0"><form action="<?php echo constant('URL').'Usuario/desactivar/'.$usuario->id;?>" method="post"><input type="hidden" name="estado" value="<?php echo $usuario->estado;?>"><button type="submit" class="btn <?php if($usuario->estado){echo "btn-outline-danger";}else{echo "btn-outline-success";}?> w-100 h-100 m-0"><?php if($usuario->estado){echo "Desactivar";}else{echo "activar";}?></button></form></td>
                        </tr>
                            <?php 
                            } elseif ($_SESSION['rol'] == 2) {
                                if ($usuario->numeroFicha == $_SESSION['numeroFicha']) {
                                    ?>
                                    <tr id="fila-<?php echo $usuario->id; ?>">
                            <td> <?php echo $i; ?></td>
                            <td> <?php echo $usuario->identificacion; ?></td>
                            <td> <?php switch ($usuario->rol) {
                                case 1:
                                    echo 'Admin';
                                    break;
                                case 2:
                                    echo 'Inst';
                                    break;
                                case 3:
                                    echo 'Apren';
                                    break;    
                                default:
                                    echo 'Error';
                                    break;
                            } ?></td>
                            <td> <?php echo $usuario->nombre; ?></td>
                            <td> <?php echo $usuario->apellido; ?></td>
                            <td> <?php echo $usuario->correo; ?></td>
                            <td> <?php echo $usuario->estado; ?></td>
                            <td> <?php echo $usuario->numeroFicha; ?></td>
                            <?php 
                            if ($_SESSION['rol'] == 1) {
                            ?>
                                <td class="p-0"><button class="btn btn-outline-primary w-100 h-100 m-0" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarUsuario(<?php echo $usuario->id;?>)">Editar</button></td>
                            <?php 
                            }
                            ?>
                            <td class="p-0"><form action="<?php echo constant('URL').'Usuario/desactivar/'.$usuario->id;?>" method="post"><input type="hidden" name="estado" value="<?php echo $usuario->estado;?>"><button type="submit" class="btn <?php if($usuario->estado){echo "btn-outline-danger";}else{echo "btn-outline-success";}?> w-100 h-100 m-0"><?php if($usuario->estado){echo "Desactivar";}else{echo "activar";}?></button></form></td>
                        </tr>
                                    <?php
                                }
                            }
                        ?>
                        
                        
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
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
            document.getElementById("frameactializar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Usuario/seleccionar/';?>"+id+"/"+1+"\" style=\"display:block; width:100%; height:25vh;\"></iframe>";
        }
        function seleccionarUsuarioSesion() {
            document.getElementById("frameactializar").innerHTML = "";
            document.getElementById("frameactializar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Usuario/seleccionar/';?>"+<?php echo $_SESSION['id'];?>+"/"+2+"\" style=\"display:block; width:100%; height:45vh;\"></iframe>";
        }
        function eliminar(id) {
            swal("Deseas desactivar el usuario?", {
                buttons: {
                    no: {
                    text: "NO!",
                    value: false,
                    },
                    si: {
                    text: "Si",
                    value: true,
                    }
                },
                })
                .then((value) => {
                if (value) {
                    location.href ='<?php echo constant('URL') . 'usuario/desactivar/';?>'+proceso+'/'+id;
                } else {
                    
                }
                });
        }
        $(document).ready(() => {
            $('#buscar').on('input',function(evento) {
                evento.preventDefault();
                let clave = $('#buscar').val().trim();
                if (clave) {
                    $('table').find('tbody tr').hide();
                    $('table tbody tr').each(function() {
                        for (let i = 0; i < 8; i++) {
                            let datos = $(this).children().eq(i);
                            if (datos.text().toUpperCase().includes(clave.toUpperCase())) {
                                $(this).show();
                            }
                        }
                    });
                } else {
                    $('table').find('tbody tr').show();
                }
            });
        });
    </script>
    <?php require 'views/footer.php'; ?>
</body>
</html>