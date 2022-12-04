<?php

class Voto extends Controller{
    function __construct(){
        parent::__construct();
        $this->mensaje = "";
    }
    
    function render(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                header("location: ".constant('URL')."Proceso");
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."Proceso");
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function registrar() {
        if (isset($_SESSION['rol'])) {
                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                    header("location: ".constant('URL')."Proceso");
                } elseif ($_SESSION['rol'] == 3) {
                    $IdEleccion = $_POST['IdEleccion'];
                    $IdProceso = $_POST['IdProceso'];
                    $IdAprendiz = $_SESSION['id'];
                    $fechaActual = date("Y-m-d");
                    if($this->model->insert(['idEleccion'=>$IdEleccion, 'idProceso'=>$IdProceso, 'idApendiz'=>$IdAprendiz, 'fechaActual'=>$fechaActual])) {
                        header("location: ".constant('URL'));
                    } else {
                        header("location: ".constant('URL')."Tarjeton".$IdProceso);
                    }
                } else {
                    header("location: ".constant('URL')."Proceso");
                }
        } else {
            header("location: ".constant('URL'));
        }
    }


    function cantidadVotos($datos) {
        if (isset($_SESSION['rol'])) {
                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                    header("location: ".constant('URL')."Proceso");
                } elseif ($_SESSION['rol'] == 3) {
                    $idProceso = $datos['proceso'];
                    $idAprendiz = $datos['aprediz'];
                } else {
                    header("location: ".constant('URL')."Proceso");
                }
        } else {
            header("location: ".constant('URL'));
        }
    }

}
?>