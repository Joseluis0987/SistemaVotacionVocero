<?php

class Tarjeton extends Controller{
    function __construct(){
        parent::__construct();
        $this->mensaje = "";
    }
    
    function render($param = null){
        if (isset($_SESSION['rol'])) {
            if (isset($param[0])) {
                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                    $tarjeton = $this->model->getByProceso($param[0]);
                    $this->view->datos = $tarjeton;
                    $this->view->proceso = $param[0];
                    $this->view->ficha = $param[1];
                    $this->view->mensaje = $this->mensaje;
                    $this->view->render('Tarjeton/index');
                } elseif ($_SESSION['rol'] == 3) {
                    require_once 'models/procesoModel.php';
                    $procesom = new ProcesoModel();
                    $datosProceso = $procesom->getById($param[0]);
                    if (isset($datosProceso->id)) {
                        if ($datosProceso->ficha == $_SESSION['numeroFicha']) {
                            $tarjeton = $this->model->getByProceso($param[0]);
                            $this->view->datos = $tarjeton;
                            $this->view->mensaje = $this->mensaje;
                            $this->view->render('Tarjeton/aprendiz');
                        } else {
                            header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);
                        }
                    } else {
                        header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);    
                    }
                }
            } else {
                header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function registrar($param = null) {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                if ($param[0]==1) {
                    $this->view->proceso = $param[1];
                    $this->view->ficha = $param[2];
                    $IdPostulado = $_POST['IdPostulado'];
                    require_once ('models/usuarioModel.php');
                    require_once ('models/tarjetonModel.php');
                    $IdProceso = $_POST['IdProceso'];
                    $descripcion = $_POST['descripcion'];
                    $numeroTarjeton = 1;
                    $usuario = new UsuarioModel();
                    $numTarjetonm = new TarjetonModel();
                    $datosUsuario = $usuario->getById($IdPostulado);
                    $datoNumTarjeton = $numTarjetonm->getByProceso($IdProceso);
                    foreach ($datoNumTarjeton as $row) {
                        $numeroTarjeton++;
                    }
                    $nombre = $datosUsuario->nombre;
                    $apellido = $datosUsuario->apellido;
                    if($this->model->insert(['numeroTarjeton'=>$numeroTarjeton, 'IdPostulado'=>$IdPostulado, 'apellido'=>$apellido, 'nombre'=>$nombre, 'descripcion'=>$descripcion, 'IdProceso'=>$IdProceso])) {
                        $mensaje = "Nuevo tarjeton creado";
                    } else {
                        $mensaje = "Error al crear tarjeton";
                    }
                    $this->view->mensaje = $mensaje;
                    $this->view->render('Tarjeton/nuevo');
                } elseif(isset($param[1]) || isset($param[2])) {
                    $this->view->mensaje = "";
                    $this->view->proceso = $param[1];
                    $this->view->ficha = $param[2];
                    $this->view->render('Tarjeton/nuevo');
                } else {
                    header("location: ".constant('URL')."Proceso/");
                }
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);
           }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function seleccionar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $param[0];
                $tarjeton = $this->model->getById($id);
                $_SESSION['id_tarjeton_seleccionado'] = $tarjeton->id;
                $this->view->datos = $tarjeton;
                $this->view->mensaje = "";
                $this->view->render('Tarjeton/detalle');
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);
           }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function actualizar(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $_SESSION['id_tarjeton_seleccionado'];
                $descripcion = $_POST['descripcion'];
                $mensaje = "";
                if($this->model->update(['id'=>$id, 'descripcion'=>$descripcion])) {
                    $mensaje = "Tarjeton actualizado";
                } else {
                    $mensaje = "Error al actualizar tarjeton";
                }
                $this->view->mensaje = $mensaje;
                $this->view->datos = $this->model->getById($id);
                $this->view->render("Tarjeton/detalle");
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."Proceso/render/".$_SESSION['numeroFicha']);
           }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function eliminar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $param[1];
                if($this->model->delete($id)) {
                    $mensaje = "Usuario eliminado correctamente";
                } else {
                    $mensaje = "Usuario no se pudo eliminar";
                }
                $this->view->mensaje = "";
                $tarjetones = $this->model->getByProceso($param[0]);
                $this->view->datos = $tarjetones;
                $this->view->render('Tarjeton/index');
                } elseif ($_SESSION['rol'] == 3) {
                    header("location: ".constant('URL')."Proceso/render/".$_SESSION['id_proceso_seleccionado']);
            }
            } else {
                header("location: ".constant('URL'));
            }
    }

}
?>