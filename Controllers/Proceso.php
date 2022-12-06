<?php

class Proceso extends Controller{
    function __construct(){
        parent::__construct();
        $this->mensaje = "";
    }
    
    function render(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1) {
                $proceso = $this->model->get();
                $this->view->datos = $proceso;
                $this->view->mensaje = $this->mensaje;
                $this->view->render('Proceso/index');
            } elseif ($_SESSION['rol'] == 2) {
                $proceso = $this->model->getByFicha($_SESSION['numeroFicha']);
                $this->view->datos = $proceso;
                $this->view->mensaje = $this->mensaje;
                $this->view->render('Proceso/index');
            } elseif ($_SESSION['rol'] == 3) {
                $proceso = $this->model->getByFicha($_SESSION['numeroFicha']);
                $this->view->datos = $proceso;
                $this->view->mensaje = $this->mensaje;
                $this->view->render('Proceso/aprendiz');
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function registrar($param = null) {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                if ($param[0]==1) {
                    $ficha = $_POST['ficha'];
                    $fechaInicio = $_POST['fechaInicio'];
                    $fechaFin = $_POST['fechaFin'];
                    $nombre = $_POST['nombre'];
                    if($this->model->insert(['fechaInicio'=>$fechaInicio, 'fechaFin'=>$fechaFin, 'nombre'=>$nombre, 'ficha'=>$ficha])) {
                        $mensaje = "Nuevo proceso de elección creado";
                    } else {
                        $mensaje = "Error al crear proceso de elección";
                    }
                    $this->view->mensaje = $mensaje;
                    $this->view->render('Proceso/nuevo');
                } else {
                    $this->view->mensaje = "";
                    $this->view->render('Proceso/nuevo');
                }
            } elseif ($_SESSION['rol'] == 3) {
                $this->render();
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function seleccionar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $param[0];
                $preoceso = $this->model->getById($id);
                $_SESSION['id_proceso_seleccionado'] = $preoceso->id;
                $this->view->datos = $preoceso;
                $this->view->render('Proceso/detalle');
            } elseif ($_SESSION['rol'] == 3) {
                $this->render();
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function actualizar(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $_SESSION['id_proceso_seleccionado'];
                $fechaFin = $_POST['fechaFin'];
                $nombre = $_POST['nombre'];
                unset($_SESSION['id_proceso_seleccionado']);
                if($this->model->update(['fechaFin'=>$fechaFin, 'nombre'=>$nombre, 'id'=>$id])) {
                    $mensaje = "Proceso de elección actualizado";
                } else {
                    $mensaje = "Error al actualizar el proceso";
                }
                $this->mensaje = $mensaje;
                $this->render();
            } elseif ($_SESSION['rol'] == 3) {
                $this->render();
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function cancelar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $param[0];
                if($this->model->cancel($id)) {
                    $mensaje = "Proceso cancelado exitosamente";
                } else {
                    $mensaje = "El proceso no se pudo cancelar";
                }
                $this->mensaje = $mensaje;
                $this->render();
            } elseif ($_SESSION['rol'] == 3) {
                $this->render();
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function resultado($param = null){
        if (isset($_SESSION['rol'])) {
            if (isset($param[0])) {
                $resultados = $this->model->result($param[0]);
                $this->view->datos = $resultados;
                $this->view->render("Proceso/resultado");
            } else {
                header("location: ".constant('URL')."/Proceso");
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

}
?>