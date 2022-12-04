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
                <div class="card-header">Nuevo Usuario</div>
                    <div class="card-body">
                        <form action="<?php echo constant('URL'); ?>Usuario/registrar/1" method="POST">
                            <p><label for="Identidicacion">Identificacion</label><br><input type="number" name="identificacion" min="1000000000" max="9999999999" required></p>
                            <p><label for="rol">Rol</label><br><select name="rol">
                                <option value="1">Administrador</option>
                                <option value="2">Instructor</option>
                                <option value="3">Aprendiz</option>
                            </select></p>
                            <p><label for="nombre">Nombre</label><br><input type="text" name="nombre" required></p>
                            <p><label for="apellido">Apellido</label><br><input type="text" name="apellido" required></p>
                            <p><label for="correo">Correo</label><br><input type="email" name="correo" required></p>
                            <p><label for="nombre">Ficha</label><br><select name="ficha">
                            <?php
                            include_once 'models/fichaModel.php';
                            $ficham = new FichaModel();
                            foreach($ficham->get() as $row) { 
                                $ficha = new FichaModel();
                                $ficha = $row;
                                ?>
                                <option value="<?php echo $ficha->id;?>"><?php echo $ficha->id." ".$ficha->formacion; ?></option>
                                <?php
                            }
                            ?>
                            </select></p>
                            <p><?php echo $this->mensaje; ?></p>
                            <p><button type="submit">Enviar</button></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>