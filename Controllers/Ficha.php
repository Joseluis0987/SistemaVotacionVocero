<?php

class Ficha extends Controller{
    function __construct(){
        parent::__construct();
        $this->mensaje = "";
    }
    
    function render(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $ficha = $this->model->get();
                $this->view->datos = $ficha;
                $this->view->mensaje = $this->mensaje;
                $this->view->render('Ficha/index');
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."Main");
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function registrar($param = null) {
        $this->view->mensaje = "";
        if ($param[0]==1) {
            $idFicha = $_POST['numeroFicha'];
            $formacion = $_POST['formacion'];
            $cantidad = 0;
            if($this->model->insert(['numero'=>$idFicha, 'formacion'=>$formacion, 'cantidad'=>$cantidad])) {
                $this->view->mensaje = "Ficha creada";
            } else {
                $this->view->mensaje = "Error al crear ficha";
            }
            $this->view->render('Ficha/nuevo');
        } else {
            $this->view->render('Ficha/nuevo');
        }
    }

    function seleccionar($param = null){
        $id = $param[0];
        $ficha = $this->model->getById($id);
        $_SESSION['id_ficha_seleccionada'] = $ficha->id;
        $this->view->datos = $ficha;
        $this->view->render('Ficha/detalle');
    }

    function actualizar(){
        $id = $_SESSION['id_ficha_seleccionada'];
        $formacion = $_POST['formacion'];
        unset($_SESSION['id_ficha_seleccionada']);
        if($this->model->update(['formacion'=>$formacion, 'id'=>$id])) {
            $mensaje = "Ficha $id actualizada";
        } else {
            $mensaje = "Error al actualizar la ficha";
        }
        $this->mensaje = $mensaje;
        $this->render();
    }

}
?>