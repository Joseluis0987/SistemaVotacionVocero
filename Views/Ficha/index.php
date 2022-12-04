<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichas</title>
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div class="container-lg">
        <h1>Fichas</h1>
        <h5><?php echo $this->mensaje; ?></h5>
        <div class="container-lg border rounded-top">
            <button class="btn btn-outline-dark m-2 float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <div class="modal fade" id="nuevo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Proceso de elección</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="<?php echo constant('URL') ?>ficha/registrar/0" style="display:block; width:100%; height:32vh;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="column">Numero Ficha</th>
                        <th class="column">Formacion</th>
                        <th class="column">Cantidad aprendices</th>
                        <th class="column"></th>
                    </tr>
                </thead>
                <tbody id="tbody-usuario">
                    <?php
                    include_once 'models/fichaModel.php';
                    foreach ($this->datos as $row) {
                        $ficha = new FichaModel();
                        $ficha = $row;
                    ?>
                        <tr id="fila-<?php echo $ficha->id; ?>">
                            <td> <?php echo $ficha->id; ?></td>
                            <td> <?php echo $ficha->formacion; ?></td>
                            <td> <?php echo $ficha->cantidad; ?></td>
                            <td><a onclick="seleccionarFicha(<?php echo $ficha->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-outline-primary m-0">Editar</a></td>
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
        function seleccionarFicha(id) {
            document.getElementById("frameactualizar").innerHTML = "";
            document.getElementById("tituloModal").innerHTML = "Actualiar Ficha";
            document.getElementById("frameactualizar").innerHTML = "<iframe src=\"<?php echo constant('URL') . 'Ficha/seleccionar/';?>"+id+"\" style=\"display:block; width:100%; height:20vh;\"></iframe>";
        }
    </script>
    <?php require 'views/footer.php'; ?>
</body>

</html>