<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjetones</title>
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div class="container-lg">
        <h1>Tarjetones</h1>
        <h5><?php echo $this->mensaje; ?></h5>
        <div class="container-lg border rounded-top">
            <button class="btn btn-outline-dark m-2 float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <div class="modal fade" id="nuevo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo tarjeton</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="<?php echo constant('URL') . 'Tarjeton/registrar/0/' . $this->proceso . '/' . $this->ficha; ?>" style="display:block; width:100%; height:50vh;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Numero tarjeton</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody-proceso">
                    <?php
                    include_once 'models/procesoModel.php';
                    foreach ($this->datos as $row) {
                        $tarjeton = new TarjetonModel();
                        $tarjeton = $row;
                    ?>
                        <tr id="fila-<?php echo $tarjeton->id; ?>">
                            <td> <?php echo $tarjeton->numero; ?></td>
                            <td> <?php echo $tarjeton->nombre; ?></td>
                            <td> <?php echo $tarjeton->apellido; ?></td>
                            <td> <?php echo $tarjeton->descripcion; ?></td>
                            <td><button class="btn btn-outline-primary m-0" data-bs-toggle="modal" data-bs-target="#actualizar" onclick="seleccionarTarjeton(<?php echo $tarjeton->id;?>)">Editar</button></td>
                            <td><a onclick="eliminar(<?php echo $tarjeton->id.','.$this->proceso;?>)" class="btn btn-outline-danger m-0" data-id="<?php echo $tarjeton->id;?>">Eliminar</a></td>
                        </tr>
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
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require 'views/footer.php'; ?>
    <script>
        function seleccionarTarjeton(id) {
            document.getElementById("frameactializar").innerHTML = "";
            document.getElementById("frameactializar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Tarjeton/seleccionar/';?>"+id+"\" style=\"display:block; width:100%; height:45vh;\"></iframe>";
        }
        function eliminar(id,proceso) {
            swal("Deseas eliminar el tarjeton?", {
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
                    location.href ='<?php echo constant('URL') . 'Tarjeton/eliminar/';?>'+proceso+'/'+id;
                } else {
                    
                }
                });
        }
    </script>
</body>

</html>