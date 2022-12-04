<?php

class TarjetonModel extends Model{
    public $id;
    public $numero;
    public $idPostulado;
    public $nombre;
    public $apellido;
    public $descripcion;
    public $idProceso;
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($datos) {
        try {
            $query= $this->db->connect()->prepare("INSERT INTO tarjeton(idTarjeton, numeroTarjeton, IdPostulado, nombrePostulado, apellidoPostulado, descripcionPostulado, IdProceso) VALUES (null, :numeroTarjeton, :IdPostulado, :nombrePostulado, :apellidoPostulado, :detallePostulado, :IdProceso)");
            $query->execute([
                ':numeroTarjeton'=>$datos['numeroTarjeton'],
                ':IdPostulado'=>$datos['IdPostulado'],
                ':nombrePostulado'=>$datos['nombre'],
                ':apellidoPostulado'=>$datos['apellido'],
                ':detallePostulado'=>$datos['descripcion'],
                ':IdProceso'=>$datos['IdProceso'] 
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
            $query = $this->db->connect()->query("SELECT * FROM tarjeton");
            while ($row = $query->fetch()) {
                $item = new TarjetonModel();
                $item->id = $row['IdTarjeton'];
                $item->numero = $row['numeroTarjeton'];
                $item->idPostulado = $row['IdPostulado'];
                $item->nombre = $row['nombrePostulado'];
                $item->apellido = $row['apellidoPostulado'];
                $item->descripcion = $row['descripcionPostulado'];
                $item->idProceso = $row['IdProceso'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getByProceso($idProceso){
        $items = [];
        $item = [];
        $query = $this->db->connect()->prepare("SELECT * FROM tarjeton where IdProceso = :IdProceso");
        try {
            $query->execute([':IdProceso' => $idProceso]);
            while ($row = $query->fetch()) {
                $item = new TarjetonModel();
                $item->id = $row['IdTarjeton'];
                $item->numero = $row['numeroTarjeton'];
                $item->idPostulado = $row['IdPostulado'];
                $item->nombre = $row['nombrePostulado'];
                $item->apellido = $row['apellidoPostulado'];
                $item->descripcion = $row['descripcionPostulado'];
                $item->idProceso = $row['IdProceso'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getById($id){
        $item = new TarjetonModel();
        $query = $this->db->connect()->prepare("SELECT * FROM tarjeton where IdTarjeton = :id");
        try {
            $query->execute([':id' => $id]);
            while ($row = $query->fetch()) {
                $item->id = $row['IdTarjeton'];
                $item->numero = $row['numeroTarjeton'];
                $item->idPostulado = $row['IdPostulado'];
                $item->nombre = $row['nombrePostulado'];
                $item->apellido = $row['apellidoPostulado'];
                $item->descripcion = $row['descripcionPostulado'];
                $item->idProceso = $row['IdProceso'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function delete($id) {
        $query= $this->db->connect()->prepare("DELETE FROM tarjeton WHERE IdTarjeton = :id");
        try {
            $query->execute([
                ':id'=> $id
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($datos) {
        $query= $this->db->connect()->prepare("UPDATE tarjeton SET descripcionPostulado = :detallePostulado WHERE IdTarjeton = :id");
        try {
            $query->execute([
                ':detallePostulado'=>$datos['descripcion'],
                ':id'=> $datos['id']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

?>