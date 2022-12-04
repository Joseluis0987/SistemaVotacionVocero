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
                <div class="card-header">Detalle de <?php echo $this->datos->nombre;?></div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Proceso/actualizar/1" method="POST">
                        <p><label for="nombre">Nombre</label><br><input type="text" name="nombre" value="<?php echo $this->datos->nombre; ?>"></p>
                        <p><label for="nombre">Ficha</label><br><input type="number" name="ficha" value="<?php echo $this->datos->ficha; ?>" disabled></p>
                        <p><label for="fechaFin">Fecha inicio</label><br><input type="date" name="fechaInicio" value="<?php echo $this->datos->fechaInicio; ?>" disabled></p>
                        <p><label for="fechaFin">Fecha fin</label><br><input type="date" name="fechaFin" value="<?php echo $this->datos->fechaFin; ?>"></p>
                        <p><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>