<?php

class FichaModel extends Model{
    public $id;
    public $formacion;
    public $cantidad;
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($datos) {
        try {
            $query= $this->db->connect()->prepare("INSERT INTO ficha(idFicha, formacion, cantidadAprendices) VALUES (:ficha, :formacion, :cantidad)");
            $query->execute([
                ':ficha'=> $datos['numero'],
                ':formacion'=> $datos['formacion'],
                ':cantidad'=> $datos['cantidad']
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
            $query = $this->db->connect()->query("SELECT * FROM ficha");
            while ($row = $query->fetch()) {
                $item = new FichaModel();
                $item->id = $row['IdFicha'];
                $item->formacion = $row['formacion'];
                $item->cantidad = $row['cantidadAprendices'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getById($id){
        $item = new FichaModel();
        $query = $this->db->connect()->prepare("SELECT * FROM ficha where IdFicha = :numeroFicha");
        try {
            $query->execute([':numeroFicha' => $id]);
            while ($row = $query->fetch()) {
                $item->id = $row['IdFicha'];
                $item->formacion = $row['formacion'];
                $item->cantidad = $row['cantidadAprendices'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }

    }

    public function update($datos) {
        $query= $this->db->connect()->prepare("UPDATE ficha SET formacion = :formacion WHERE IdFicha = :id");
        try {
            $query->execute([
                ':formacion'=> $datos['formacion'],
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