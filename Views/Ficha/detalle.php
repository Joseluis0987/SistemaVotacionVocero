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
                <div class="card-header">Detalle de la ficha <?php echo $this->datos->formacion . ' ' . $this->datos->id ?></div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Ficha/actualizar/1" method="POST">
                        <p><label for="nombre">Formacion</label><br><input type="text" name="formacion"  value="<?php echo $this->datos->formacion; ?>"></p>
                        <p><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>