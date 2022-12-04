<?php

class ProcesoModel extends Model{
    public $id;
    public $nombre;
    public $fechaInicio;
    public $fechaFin;
    public $estado;
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($datos) {
        try {
            $query= $this->db->connect()->prepare("INSERT INTO procesoeleccion(idProceso, ficha, nombreProceso, fechaInicio, fechaFin, estado) VALUES (null, :ficha, :nombre, :fechaInicio, :fechaFin, 1)");
            $query->execute([
                ':nombre'=> $datos['nombre'],
                ':ficha'=> $datos['ficha'],
                ':fechaInicio'=> $datos['fechaInicio'],
                ':fechaFin'=> $datos['fechaFin']
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
            $query = $this->db->connect()->query("SELECT * FROM procesoeleccion");
            while ($row = $query->fetch()) {
                $item = new ProcesoModel();
                $item->id = $row['IdProceso'];
                $item->ficha = $row['ficha'];
                $item->nombre = $row['nombreProceso'];
                $item->fechaInicio = $row['fechaInicio'];
                $item->fechaFin = $row['fechaFin'];
                $item->estado = $row['estado'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getById($id){
        $item = new ProcesoModel();
        $query = $this->db->connect()->prepare("SELECT * FROM procesoeleccion where IdProceso = :IdProceso");
        try {
            $query->execute(['IdProceso' => $id]);
            while ($row = $query->fetch()) {
                $item->id = $row['IdProceso'];
                $item->ficha = $row['ficha'];
                $item->nombre = $row['nombreProceso'];
                $item->fechaInicio = $row['fechaInicio'];
                $item->fechaFin = $row['fechaFin'];
                $item->estado = $row['estado'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getByFicha($ficha){
        $items = [];
        $item = [];
        $query = $this->db->connect()->prepare("SELECT * FROM procesoeleccion where ficha = :ficha");
        try {
            $query->execute([':ficha' => $ficha]);
            while ($row = $query->fetch()) {
                $item = new ProcesoModel();
                $item->id = $row['IdProceso'];
                $item->ficha = $row['ficha'];
                $item->nombre = $row['nombreProceso'];
                $item->fechaInicio = $row['fechaInicio'];
                $item->fechaFin = $row['fechaFin'];
                $item->estado = $row['estado'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function result($id){
        require_once 'models/resultadoModel.php';
        $items = [];
        $item = [];
        $query = $this->db->connect()->prepare("SELECT * FROM resultados where IdProceso = :id LIMIT 2");
        try {
            $query->execute([':id' => $id]);
            while ($row = $query->fetch()) {
                $item = new ResultadoModel();
                $item->IdProceso = $row['IdProceso'];
                $item->nombre = $row['nombrePostulado'];
                $item->apellido = $row['apellidoPostulado'];
                $item->numeroVotos = $row['numeroVotos'];
                $item->numeroFicha = $row['numeroFicha'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function update($datos) {
        $query= $this->db->connect()->prepare("UPDATE procesoeleccion SET nombreProceso = :nombre,  fechaFin = :fechaFin WHERE IdProceso = :id");
        try {
            $query->execute([
                ':nombre'=> $datos['nombre'],
                ':fechaFin'=> $datos['fechaFin'],
                ':id'=> $datos['id']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function cancel($id) {
        $query= $this->db->connect()->prepare("UPDATE procesoeleccion SET estado = 3 WHERE idProceso = :id");
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
    
}

?>