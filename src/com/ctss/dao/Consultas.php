<?php

class Consultas extends Conexion {

    private $conexion;

    function __construct() {
        $this->conexion = parent::conectar();
        return $this->conexion;
    }

    public function execute($consulta, $valores, &$lastid) {
        $lastid=0;
    //    error_reporting(0);
        $resultado = false;
        $statement = $this->conexion->prepare($consulta);
        if ($statement) {
            if (preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)) {
                $campo = array_pop($campo);
                foreach ($campo as $parametro) {
                    $statement->bindValue($parametro, $valores[substr($parametro, 1)]);
                }
            }
            try {
                if (!$statement->execute()) {
                    $resultados= $statement->errorInfo();
                    print_r($resultados);
                    $resultado=false;
                }
                else{
                    $lastid=  $this->conexion->lastInsertId();
                    $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $statement->closeCursor();
                    $resultado=true;
                }
            } catch (PDOException $evento) {
                echo "0No puede ejecutar la consulta";
                echo $evento->getMessage();
            }
        }
        return $resultado;
        $this->conexion = null;
    }

    public function getResults($consulta, $valores) {
  //      error_reporting(0);
        $resultado = "0";
        $statement = $this->conexion->prepare($consulta);
        if ($statement) {
            if (preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)) {
                $campo = array_pop($campo);
                foreach ($campo as $parametro) {
                    $statement->bindValue($parametro, $valores[substr($parametro, 1)]);
                }
            }
            try {
                if (!$statement->execute()) {
                    $resultado= $statement->errorInfo();
                    print_r($resultado);
                    $resultado= $resultado[2];
                }
                else{
                    $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $statement->closeCursor();
                }
            } catch (PDOException $evento) {
                $resultado.= "0No puede ejecutar la consulta".$evento->getMessage();
            }
        }
        return $resultado;
        $this->conexion = null;
    }

    public function getRow($query, $values){
//        error_reporting(0);
        $array=null;
        $util=new Util();
        $rows=  $this->getResults($query, $values);
        foreach ($rows as $row){
            $array= $util->obj2array($row);
            break;
        }
        return $array;
    }
}
