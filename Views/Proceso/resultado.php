<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">
        <?php
        include_once 'models/resultadoModel.php';
        $i = 1;
        foreach ($this->datos as $row) {
            $resultado = new ResultadoModel();
            $resultado = $row;
            if ($i == 1) {
                echo "<div class='row'>";
            }
        ?>
            <div class="col m-1 ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php switch ($i) {
                            case 1:
                                echo "Nuevo vocero de la ficha ";
                                break;
                            case 2:
                                echo "Sub vocero de la ficha ";
                                break;
                            default:
                                echo  "ERROR";
                                break;
                        } echo $resultado->numeroFicha;?></h4>
                        <h2 class="card-text"><?php echo $resultado->nombre." ".$resultado->apellido; ?></h2>
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
</body>

</html>