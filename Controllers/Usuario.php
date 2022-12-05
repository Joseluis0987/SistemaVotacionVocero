<?php

class Usuario extends Controller{
    function __construct(){
        parent::__construct();
        $this->mensaje = "";
    }
    
    function render(){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $usuarios = $this->model->get();
                $this->view->datos = $usuarios;
                $this->view->mensaje = $this->mensaje;
                $this->view->render('Usuario/index');
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."usuario/seleccionar/".$_SESSION['id']);
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function registrar($param = null) {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                if ($param[0]==1) {
                    $rol = $_POST['rol'];
                    $identificacion = $_POST['identificacion'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $correo = $_POST['correo'];
                    $contrasena = "Sena".$identificacion;
                    $ficha = $_POST['ficha'];
                    $mensaje = "";
                    if($this->model->insert(['identificacion'=>$identificacion, 'rol'=>$rol, 'nombre'=>$nombre, 'apellido'=>$apellido, 'correo'=>$correo, 'contrasena'=>$contrasena, 'ficha'=>$ficha])) {
                        $this->view->mensaje = "Usuario creado exitosamente";
                    } else {
                        $this->view->mensaje = "Error al crear usuario";
                    }
                    $this->view->render('Usuario/nuevo');
                } else {
                    $this->view->mensaje = "";
                    $this->view->render('Usuario/nuevo');
                }
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."usuario/seleccionar/".$_SESSION['id']);
            }
        } else {
            header("location: ".constant('URL'));
        }
                
    }

    function seleccionar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                if ($_SESSION['rol'] == 1) {
                    $this->view->i = $param[1];
                }
                $id = $param[0];
            } elseif ($_SESSION['rol'] == 3) {
                $id = $_SESSION['id'];
            }
            $usuario = $this->model->getById($id);
            $_SESSION['id_usuario_seleccionado'] = $usuario->id;
            $this->view->mensaje = "";
            $this->view->datos = $usuario;
            $this->view->render('Usuario/detalle');
        } else {
            header("location: ".constant('URL'));
        }
    }

    function actualizar(){
        if (isset($_SESSION['rol'])) {
            $id = $_SESSION['id_usuario_seleccionado'];
            $rol = $_POST['rol'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $ficha = $_POST['ficha'];
            if($this->model->update(['id'=>$id, 'rol'=>$rol, 'nombre'=>$nombre, 'apellido'=>$apellido, 'correo'=>$correo, 'contrasena'=>$contrasena, 'ficha'=>$ficha])) {
                $mensaje = "Usuario actualizado";
            } else {
                $mensaje = "Error al actualizar usuario";
            }
            $this->view->mensaje = $mensaje;
            $this->view->datos = $this->model->getById($id);
            $this->view->render("Usuario/detalle");
            
        } else {
            header("location: ".constant('URL'));
        }
    }

    function desactivar($param = null){
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                $id = $param[0];
                $estado = !($param[1]);
                if($this->model->delete(['id'=>$id,'estado'=>$estado])) {
                    if ($estado) {
                        $mensaje = "Usuario activado correctamente";
                    } else {
                        $mensaje = "Usuario desactivado correctamente";
                    }
                } else {
                    $mensaje = "Usuario no se pudo actualizar";
                }
                $this->mensaje = $mensaje;
                $this->render();
            } elseif ($_SESSION['rol'] == 3) {
                header("location: ".constant('URL')."usuario/seleccionar/".$_SESSION['id']);
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function iniciarSesion(){
        $user = $_POST['user'];
        $contrasena = $_POST['password'];
        if (isset($user)) {
            if (isset($contrasena)) {
                $datosSesion = $this->model->login(['user' => $user, 'contrasena' => $contrasena]);
                if($datosSesion->verificacion) {
                    $_SESSION['id'] = $datosSesion->id;
                    $_SESSION['identificacion'] = $datosSesion->identificacion;
                    $_SESSION['rol'] = $datosSesion->rol;
                    $_SESSION['nombre'] = $datosSesion->nombre;
                    $_SESSION['apellido'] = $datosSesion->apellido;
                    $_SESSION['correo'] = $datosSesion->correo;
                    $_SESSION['estado'] = $datosSesion->estado;
                    $_SESSION['numeroFicha'] = $datosSesion->numeroFicha;
                } else {
                    $_SESSION['rol'] = 4;
                }
                header("location: ".constant('URL'));
            }
        } else {
            header("location: ".constant('URL'));
        }
    }

    function cerrarSesion(){
        session_destroy();
        header("location: ".constant('URL'));
    }

}
