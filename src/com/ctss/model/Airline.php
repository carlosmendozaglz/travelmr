<?php

class Airline {
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListAirline($cond=""){
        $this->sql=new Consultas();
        $query="Select airline_key, airline_name, airline_description, date_register, last_modify  "
               . "From airline $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getAirlineByKey($keyAirline, $cond=""){
        $this->sql=new Consultas();
        $query="Select airline_key, airline_name, airline_description, date_register, last_modify  "
               . "From airline "
              . "Where airline_key =:airline_key  $cond ";
        $params=array("airline_key"=>$keyAirline);
      return $this->sql->getRow($query, $params);
    }
    
    public function getAirlineByName($nameAirline, $cond=""){
        $this->sql=new Consultas();
        $query="Select airline_key, airline_name, airline_description, date_register, last_modify  "
               . "From airline "
              . "Where airline_Name =:airlineName  $cond ";
        $params=array("airlineName"=>$nameAirline);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewAirline($params,&$key){
        $this->sql=new Consultas();
        $query="Insert Into airline (airline_name, airline_description, date_register, last_modify)"
                        . "  Values (:name, :description, now(),now()) ";
        $values=array("name"=>$params['name-airline'],
                      "description"=>$params['description-airline']);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateAirline($params){
        $this->sql=new Consultas();
        $query="Update airline "
                . "Set airline_name=:name, "
                   . " airline_description=:description, "
                   . " last_modify=now() "
              . "Where airline_key=:airline_key ";
        $values=array("name"=>$params['name-airline'],
                      "description"=>$params['description-airline'],
                      "airline_key"=>$params['airline-key']);
        $key=0;
        return $this->sql->execute($query, $values, $key);
    }
    
    public function deleteAirline($post){
        $key=0;
        $this->sql=new Consultas();
        $query="Delete From airline "
              . "Where airline_key=:airline_key ";
        $values=array("airline_key"=>$post['keyAirline']);
        return $this->sql->execute($query, $values, $key);
    }
    
}
