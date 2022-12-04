<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesos de eleccion</title>
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div class="container-lg">
        <h1>Procesos de eleccion</h1>
        <h5><?php echo $this->mensaje; ?></h5>
        <div class="container-lg border rounded-top">
            <input type="text" id="buscar" class="m-2" placeholder="Buscar">
            <button class="btn btn-outline-dark m-2 float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <div class="modal fade" id="nuevo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Proceso de elección</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="<?php echo constant('URL') ?>proceso/registrar/0" style="display:block; width:100%; height:40vh;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody-proceso">
                    <?php
                    include_once 'models/procesoModel.php';
                    foreach ($this->datos as $row) {
                        $proceso = new ProcesoModel();
                        $proceso = $row;
                    ?>
                        <tr id="fila-<?php echo $proceso->id; ?>">
                            <td> <?php echo $proceso->nombre; ?></td>
                            <td> <?php echo $proceso->estado; ?></td>
                            <td> <?php echo $proceso->fechaInicio; ?></td>
                            <td> <?php echo $proceso->fechaFin; ?></td>
                            <td><?php if ($proceso->estado != 3) { if ($proceso->fechaFin > date('Y-m-d')) { ?><button class="btn btn-outline-primary m-0" data-bs-toggle="modal" data-bs-target="#modal" onclick="seleccionarProceso(<?php echo $proceso->id;?>)">Editar</button></td><?php } }?>
                            <td><?php if ($proceso->estado != 3) { if ($proceso->fechaFin >= date('Y-m-d')) { ?><a href="<?php echo constant('URL') . 'tarjeton/render/' . $proceso->id.'/'. $proceso->ficha; ?>"  class="btn btn-outline-warning m-0">Tarjetones</a></td><?php } else {
                                ?><button class="btn btn-outline-success m-0" data-bs-toggle="modal" data-bs-target="#modal" onclick="resultado(<?php echo $proceso->id;?>)">Resultado</button></td><?php } } ?>
                                <?php if ($proceso->estado != 3) {?><td><a onclick="eliminar(<?php echo $proceso->id; ?>)" class="Eliminar btn btn-outline-danger" data-id="<?php echo $proceso->id; ?>">Cancelar</a></td><?php } else {?><td>Cancelado</td><?php } ?>
                            </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="frameactualizar">
                    <iframe src="<?php echo constant('URL') . 'Proceso/resultado/' . $proceso->id;?>" width="100%"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script>
        function seleccionarProceso(id) {
            document.getElementById("frameactualizar").innerHTML = "";
            document.getElementById("tituloModal").innerHTML = "Actualiar Proceso";
            document.getElementById("frameactualizar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Proceso/seleccionar/';?>"+id+"\" style=\"display:block; width:100%; height:40vh;\"></iframe>";
        }
        function resultado(id) {
            document.getElementById("frameactualizar").innerHTML = "";
            document.getElementById("tituloModal").innerHTML = "Resultado";
            document.getElementById("frameactualizar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Proceso/resultado/';?>"+id+"\" style=\"display:block; width:100%; height:25vh;\"></iframe>";
        }
        function eliminar(id) {
            swal("Seguro deseas cancelar el proceso?", {
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
                    location.href ='<?php echo constant('URL') . 'Proceso/cancelar/';?>'+id;
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