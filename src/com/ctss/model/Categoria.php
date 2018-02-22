<?php

require '../dao/conexion.php';
class Categoria {
    
    public function __construct(){
        
    }
    
    public function insert ($categoryName, $categoryDescription, &$lastKey){
        $sql=new Consultas();
        $query= "INSERT INTO category (categoryName, categoryDescription, categoryStatusKeyFK) "
                        . "    VALUES (:categoryName,:categoryDescription,:categoryStatusKeyFK )";
        $keycategoria=0;
        $values=array("categoryName"=>$categoryName,
                      "categoryDescription"=>$categoryDescription,
                      "categoryStatusKeyFK"=> 1);
        return $sql->execute($query, $valores, $keycategoria);
    }
    
    public function update ($categoryKey, $categoryName, $categoryDescription){
        $sql = "UPDATE category SET categoryName = '$categoryName', categoryDescription = '$categoryDescription' WHERE "
                . "categoryKey = '$categoryKey'";
        return update($sql);
    }
    
    public function desactivar ($categoryKey){
        $sql = "UPDATE category SET categoryStatusKeyFK = '0' WHERE "
                . "categoryKey = '$categoryKey'";
        return update($sql);
    }
    
    public function activar ($categoryKey){
        $sql = "UPDATE category SET categoryStatusKeyFK = '1' WHERE "
                . "categoryKey = '$categoryKey'";
        return update($sql);
    }
    
    public function mostrar($categoryKey){
        $sql=new Consultas();
        $query = "SELECT * FROM category WHERE categoryKey = :categorykey ";
        $values=array("categorykey"=>$categoryKey);
        return $sql->getResults($query, $values);
    }
    
    public function listar (){
        $sql = "SELECT * FROM category ";
        return ejecute($sql);
    }
    
}
