<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seccion Consulta</title>
</head>

<body>
    <?php require 'views/header.php'; ?>

    <h1>Tarjetones</h1>
    <div class="container text-center">
        <?php
        include_once 'models/procesoModel.php';
        include_once 'models/votoModel.php';
        $i = 1;
        foreach ($this->datos as $row) {
            $tarjeton = new TarjetonModel();
            $tarjeton = $row;
            $voto = new VotoModel();
            $numVotos = $voto->getByProceso(['proceso' => $tarjeton->idProceso, 'aprendiz' => $_SESSION['id']]);
            $votos = $numVotos->numVotos;
            if ($i == 1) {
                echo "<div class='row'>";
            }
        ?>
            <div class="col">
                <div class="card text-bg-warning mb-3">
                    <div class="card-header"><?php echo $tarjeton->numero; ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tarjeton->nombre . " " . $tarjeton->apellido; ?></h5>
                        <p class="card-text"><?php echo $tarjeton->descripcion; ?></p>
                        <form <?php if ($votos >= 1) { ?>action="<?php echo constant('URL') . 'Proceso/resultado/'.$tarjeton->idProceso; ?>" <?php } else { ?>action="<?php echo constant('URL') . 'Voto/registrar/1'; }?>"method="post">
                            <input type="hidden" name="IdEleccion" value="<?php echo $tarjeton->id; ?>">
                            <input type="hidden" name="IdProceso" value="<?php echo $tarjeton->idProceso; ?>">
                            <?php
                            if ($votos >= 1) {
                            ?>
                                <button class="btn btn-outline-primary btn-lg" type="submit">Resultados</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-outline-primary btn-lg" type="submit">Votar</button>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php
            if ($i == 3) {
                echo "</div>";
                $i = 0;
            }
            $i++;
        }
        ?>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>