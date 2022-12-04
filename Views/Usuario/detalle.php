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
                <div class="card-header">Detalle de <?php echo $this->datos->nombre . ' ' . $this->datos->apellido ?></div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>Usuario/actualizar/1" method="POST">
                        <?php
                        if ($_SESSION['rol'] == 1) {
                            if (2 == $this->i) {
                                ?>
                                <input type="hidden" name="rol" value="<?php echo $this->datos->rol; ?>">
                            <input type="hidden" name="estado" value="<?php echo $this->datos->estado; ?>">
                            <input type="hidden" name="ficha" value="<?php echo $this->datos->numeroFicha; ?>">
                            <p><label for="Identidicacion">Identificacion</label><br><input type="number" value="<?php echo $this->datos->identificacion; ?>" min="1000000000" max="9999999999" disabled></p>
                            <p><label for="nombre">Nombre</label><br><input type="text" name="nombre" value="<?php echo $this->datos->nombre; ?>"></p>
                            <p><label for="apellido">Apellido</label><br><input type="text" name="apellido" value="<?php echo $this->datos->apellido; ?>"></p>
                            <p><label for="correo">Correo</label><br><input type="email" name="correo" value="<?php echo $this->datos->correo; ?>"></p>
                            <p><label for="correo">Contrasena</label><br><input type="text" name="contrasena" value="<?php echo $this->datos->contrasena; ?>"></p>
                                <?php
                            } elseif (1 == $this->i) {
                        ?>
                            <input type="hidden" name="nombre" value="<?php echo $this->datos->nombre; ?>">
                            <input type="hidden" name="apellido" value="<?php echo $this->datos->apellido; ?>">
                            <input type="hidden" name="correo" value="<?php echo $this->datos->correo; ?>">
                            <input type="hidden" name="contrasena" value="<?php echo $this->datos->contrasena; ?>">
                            <p><label for="rol">Rol</label><br><select name="rol">
                                    <option value="1" <?php if ($this->datos->rol == 1) {
                                                            echo "selected";
                                                        } ?>>Administrador</option>
                                    <option value="2" <?php if ($this->datos->rol == 2) {
                                                            echo "selected";
                                                        } ?>>Instructor</option>
                                    <option value="3" <?php if ($this->datos->rol == 3) {
                                                            echo "selected";
                                                        } ?>>Aprendiz</option>
                                </select></p>
                            <p><select name="ficha">
                                    <?php
                                    include_once 'models/fichaModel.php';
                                    $ficham = new FichaModel();
                                    foreach ($ficham->get() as $row) {
                                        $ficha = new FichaModel();
                                        $ficha = $row;
                                    ?>
                                        <option value="<?php echo $ficha->id; ?>" <?php if ($this->datos->numeroFicha == $ficha->id) {echo "selected";} ?>><?php echo $ficha->id . " " . $ficha->formacion; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select></p>
                        <?php   
                            }
                        } elseif ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
                        ?>
                            <input type="hidden" name="rol" value="<?php echo $this->datos->rol; ?>">
                            <input type="hidden" name="estado" value="<?php echo $this->datos->estado; ?>">
                            <input type="hidden" name="ficha" value="<?php echo $this->datos->numeroFicha; ?>">
                            <p><label for="Identidicacion">Identificacion</label><br><input type="number" value="<?php echo $this->datos->identificacion; ?>" min="1000000000" max="9999999999" disabled></p>
                            <p><label for="nombre">Nombre</label><br><input type="text" name="nombre" value="<?php echo $this->datos->nombre; ?>"></p>
                            <p><label for="apellido">Apellido</label><br><input type="text" name="apellido" value="<?php echo $this->datos->apellido; ?>"></p>
                            <p><label for="correo">Correo</label><br><input type="email" name="correo" value="<?php echo $this->datos->correo; ?>"></p>
                            <p><label for="correo">Contrasena</label><br><input type="text" name="contrasena" value="<?php echo $this->datos->contrasena; ?>"></p>
                        <?php
                        }
                        ?>
                        <p><?php echo $this->mensaje;?></p>
                        <p><button type="submit">Actualizar</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>