<?php

class VotoModel extends Model{
    public $id;
    public $IdEleccion;
    public $IdApendiz;
    public $IdProceso;
    public $fechaVoto;
    public $numVotos;
    
    public function __construct(){
        parent::__construct();
    }

    public function insert($datos) {
        try {
            $query= $this->db->connect()->prepare("INSERT INTO voto(idVoto, idEleccion, idAprendiz, idProceso, fechaVoto) VALUES (null, :idEleccion, :idAprendiz, :idProceso, :fechaActual)");
            $query->execute([
                ':idEleccion'=> $datos['idEleccion'],
                ':idAprendiz'=> $datos['idApendiz'],
                ':idProceso'=> $datos['idProceso'],
                ':fechaActual'=> $datos['fechaActual']
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getByProceso($datos) {
        $item = new VotoModel;
        $query = $this->db->connect()->prepare("SELECT count(IdVoto) AS Votos FROM voto WHERE IdProceso = :proceso AND IdAprendiz = :idAprendiz");
        try {
            $query->execute([':proceso' => $datos['proceso'], ':idAprendiz' => $datos['aprendiz']]);
            while ($row = $query->fetch()) {
                $item->numVotos = $row['Votos'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }
    }

}

?>