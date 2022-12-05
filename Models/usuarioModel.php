<?php

class UsuarioModel extends Model{
    public $id;
    public $rol;
    public $nombre;
    public $apellido;
    public $correo;
    public $contrasena;
    public $estado;
    public $numeroFicha;
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($datos) {
        try {
            $query= $this->db->connect()->prepare("INSERT INTO usuario(idusuario, identificacionUsuario, rol, nombreUsuario, apellidoUsuario, correoUsuario, contrasenaUsuario, estadoUsuario, numeroFicha) VALUES (null, :identificacion, :rol, :nombreUsuario, :apellidoUsuario, :correoUsuario, :contrasenaUsuario, 1, :numeroFicha)");
            $query->execute([
                ':identificacion'=> $datos['identificacion'],
                ':rol'=> $datos['rol'],
                ':nombreUsuario'=> $datos['nombre'],
                ':apellidoUsuario'=> $datos['apellido'],
                ':correoUsuario'=> $datos['correo'],
                ':contrasenaUsuario'=> $datos['contrasena'],
                ':numeroFicha'=> $datos['ficha'] 
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function get() {
        $items = [];
        $item = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM usuario");
            while ($row = $query->fetch()) {
                $item = new UsuarioModel();
                $item->id = $row['IdUsuario'];
                $item->identificacion = $row['identificacionUsuario'];
                $item->rol = $row['rol'];
                $item->nombre = $row['nombreUsuario'];
                $item->apellido = $row['apellidoUsuario'];
                $item->correo = $row['correoUsuario'];
                $item->contrasena = $row['contrasenaUsuario'];
                $item->estado = $row['estadoUsuario'];
                $item->numeroFicha = $row['numeroFicha'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getById($id){
        $item = new UsuarioModel();
        $query = $this->db->connect()->prepare("SELECT * FROM usuario where IdUsuario = :idUsuario");
        try {
            $query->execute(['idUsuario' => $id]);
            while ($row = $query->fetch()) {
                $item->id = $row['IdUsuario'];
                $item->identificacion = $row['identificacionUsuario'];
                $item->rol = $row['rol'];
                $item->nombre = $row['nombreUsuario'];
                $item->apellido = $row['apellidoUsuario'];
                $item->correo = $row['correoUsuario'];
                $item->contrasena = $row['contrasenaUsuario'];
                $item->estado = $row['estadoUsuario'];
                $item->numeroFicha = $row['numeroFicha'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getByFicha($ficha){
        $items = [];
        $item = [];
        $query = $this->db->connect()->prepare("SELECT * FROM usuario where numeroFicha = :ficha");
        try {
            $query->execute([':ficha' => $ficha]);
            while ($row = $query->fetch()) {
                $item = new UsuarioModel();
                $item->id = $row['IdUsuario'];
                $item->identificacion = $row['identificacionUsuario'];
                $item->rol = $row['rol'];
                $item->nombre = $row['nombreUsuario'];
                $item->apellido = $row['apellidoUsuario'];
                $item->correo = $row['correoUsuario'];
                $item->contrasena = $row['contrasenaUsuario'];
                $item->estado = $row['estadoUsuario'];
                $item->numeroFicha = $row['numeroFicha'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($datos) {
        $query= $this->db->connect()->prepare("UPDATE usuario SET rol = :rol , nombreUsuario = :nombreUsuario, apellidoUsuario = :apellidoUsuario, correoUsuario = :correoUsuario, contrasenaUsuario = :contrasenaUsuario, numeroFicha = :numeroFicha WHERE IdUsuario = :id");
        try {
            $query->execute([
                ':rol'=> $datos['rol'],
                ':nombreUsuario'=> $datos['nombre'],
                ':apellidoUsuario'=> $datos['apellido'],
                ':correoUsuario'=> $datos['correo'],
                ':contrasenaUsuario'=> $datos['contrasena'],
                ':numeroFicha'=> $datos['ficha'],
                ':id'=> $datos['id']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($datos) {
        $query= $this->db->connect()->prepare("UPDATE usuario SET estadoUsuario = :estado WHERE IdUsuario = :id");
        try {
            $query->execute([
                ':id'=> $datos['id'],
                ':estado'=> $datos['estado']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function login($datos) {
        $item = new UsuarioModel();
        $query= $this->db->connect()->prepare("SELECT * FROM usuario WHERE correoUsuario = :user1 AND contrasenaUsuario = :contrasena1 AND estadoUsuario = 1 OR identificacionUsuario = :user2 AND contrasenaUsuario = :contrasena2 AND estadoUsuario = 1");
        $item->verificacion = false;
        try {
            $query->execute([':user1'=> $datos['user'], ':contrasena1'=> $datos['contrasena'],':user2'=> $datos['user'], ':contrasena2'=> $datos['contrasena']]);
            while ($row = $query->fetch()) {
                $item->id = $row['IdUsuario'];
                $item->identificacion = $row['identificacionUsuario'];
                $item->rol = $row['rol'];
                $item->nombre = $row['nombreUsuario'];
                $item->apellido = $row['apellidoUsuario'];
                $item->correo = $row['correoUsuario'];
                $item->contrasena = $row['contrasenaUsuario'];
                $item->estado = $row['estadoUsuario'];
                $item->numeroFicha = $row['numeroFicha'];
                $item->verificacion = true;
            }
            return $item;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }
}

?>