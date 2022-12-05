<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
        <div class="d-flex d-flex justify-content-center">
            <div class="card text-bg-light ">
                <div class="card-header">Nuevo Tarjeton</div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Tarjeton/registrar/1/<?php echo $this->proceso . '/' . $this->ficha ?>" method="POST">
                        <input type="hidden" name="IdProceso" value="<?php echo $this->proceso; ?>">
                        <p><label for="aprendiz">Aprendiz</label><br><select name="IdPostulado">
                                <?php
                                include_once 'models/usuarioModel.php';
                                $usuariom = new UsuarioModel();
                                foreach ($usuariom->getByFicha($this->ficha) as $row) {
                                    $usuario = new UsuarioModel();
                                    $usuario = $row;
                                    if ($usuario->rol == 3) {
                                ?>
                                        <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nombre . " " . $usuario->apellido; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select></p>
                        <p><label for="descripcion">Descripcion</label><br><textarea name="descripcion" cols="30" rows="10"></textarea></p>
                        <p><?php echo $this->mensaje;?></p>
                        <p><button type="submit" class="btn btn-primary">Enviar</button></p>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>