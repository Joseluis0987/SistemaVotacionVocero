<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div id="main">
        <div class="d-flex d-flex justify-content-center">
            <div class="card text-bg-light ">
                <div class="card-header">Nuevo Proceso</div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Proceso/registrar/1" method="POST">
                        <p ><label for="nombre">Nombre</label><br><input type="text" name="nombre"></p>
                        <p><label for="nombre">Ficha</label><br><select name="ficha">
                                <?php
                                include_once 'models/fichaModel.php';
                                $ficham = new FichaModel();
                                foreach ($ficham->get() as $row) {
                                    $ficha = new FichaModel();
                                    $ficha = $row;
                                ?>x
                                <option value="<?php echo $ficha->id; ?>"><?php echo $ficha->id; ?></option>
                            <?php
                                }
                            ?>
                            </select></p>
                        <p><label for="fechaFin">Fecha inicio</label><br><input type="date" name="fechaInicio"></p>
                        <p><label for="fechaFin">Fecha fin</label><br><input type="date" name="fechaFin"></p>
                        <p><?php echo $this->mensaje; ?></p>
                        <p><button type="submit">Enviar</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>