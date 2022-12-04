<?php

class Main extends Controller{
    function __construct(){
        parent::__construct();
    }
    function render() {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] != 4) {
                $this->view->render('main/index');
            } else {
                $this->view->mensaje = "Datos incorrectos";
                $this->view->render('usuario/login');
            }
        } else {
            $this->view->mensaje = "";
            $this->view->render('usuario/login');
        }
    }
}


?>