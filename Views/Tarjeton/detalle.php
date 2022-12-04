<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
        <div class="d-flex d-flex justify-content-center">
            <div class="card text-bg-light">
                <div class="card-header">Detalle del tarjeton <?php echo $this->datos->numero; ?> del proceso <?php echo $this->datos->idProceso ?></div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Tarjeton/actualizar/1" method="POST">
                        <p><label for="descripcion"></label><br><textarea name="descripcion" cols="30" rows="10"><?php echo $this->datos->descripcion;?></textarea></p>
                        <p><?php echo $this->mensaje;?></p>
                        <p><button type="submit">Actualizar</button></p>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>