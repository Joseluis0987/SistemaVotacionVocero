<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesos</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <div class="container text-center">
            <?php
            include_once 'models/votoModel.php';
            include_once 'models/ProcesoModel.php';
            $procesos = new ProcesoModel();
            $datos =  $procesos->getByFicha($_SESSION['numeroFicha']);
            $i = 1;
            foreach ($datos as $row) {
                $proceso = new ProcesoModel();
                $proceso = $row;
                $voto = new VotoModel();
                $numVotos = $voto->getByProceso(['proceso' => $proceso->id, 'aprendiz' => $_SESSION['id']]);
                $votos = $numVotos->numVotos;
                if ($i == 1) {
                    echo "<div class='row'>";
                }
            ?>
                <div class="col">
                    <div class="card">
                                <div class=" card-body">
                        <h5 class="card-title"><?php echo $proceso->nombre; ?></h5>
                        <p class="card-text"><?php echo $proceso->fechaInicio; ?></p>
                        <p class="card-text"><?php echo $proceso->fechaFin; ?></p>
                        <?php
                        if ($proceso->fechaFin >= date('Y-m-d')) {
                        ?>
                            <button class="btn btn-outline-success m-0" data-bs-toggle="modal" data-bs-target="#resultado<?php echo $proceso->id;?>">Resultado</button>
                            <div class="modal fade" id="resultado<?php echo $proceso->id;?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Resultado</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="<?php echo constant('URL') . 'Proceso/resultado/' . $proceso->id;?>" width="100%"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            if ($votos >= 1) {
                            ?>
                                <h4 class="card-text m-2">Ya has realizado un voto</h4>
                            <?php
                            } else {
                            ?>
                                <a href="<?php echo constant('URL') . 'tarjeton/render/' . $proceso->id; ?>" class="btn btn-primary">Votar</a>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        </div>
    <?php
                if ($i == 3) {
                    echo "</div><br>";
                    $i = 0;
                }
                $i++;
            }
    ?>
    </div>
    <?php require 'views/footer.php'; ?>
</body>
</html>