<?php

class Driver {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListDriver($cond=""){
        $this->sql=new Consultas();
        $query="Select * From driver $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getDriverByKey($keyDriver, $cond=""){
        $this->sql=new Consultas();
        $query="Select driver_key, name, gender, phone, interno, certification, licence, date_register, last_modify  "
               . "From driver "
              . "Where driver_key =:driver_key  $cond ";
        $params=array("driver_key"=>$keyDriver);
      return $this->sql->getRow($query, $params);
    }
    
    public function getDriverByLicence($driverLicence, $cond=""){
        $this->sql=new Consultas();
        $query="Select driver_key, name, gender, phone, interno, certification, licence, date_register, last_modify  "
               . "From driver "
              . "Where licence =:driverLicence  $cond ";
        $params=array("driverLicence"=>$driverLicence);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewDriver($params,&$key){
        $this->sql=new Consultas();
        $query="Insert Into driver (name, gender, phone, interno, certification, licence, date_register, last_modify)"
                        . "Values (:name, :gender, :phone, :interno, :certification, :licence, now(),now()) ";
        $values=array("name"=>$params['name'],
                      "gender"=>$params['gender'],
                      "phone"=>$params['phoneNumber'],
                      "interno"=>$params['gender'],
                      "certification"=>$params['certification'],
                      "licence"=>$params['licence']);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateDriver($params){
        $key=0;
        $this->sql=new Consultas();
        $query="Update driver "
                . "Set name=:name, "
                   . " gender=:gender, "
                   . " phone=:phone, "
                   . " interno=:interno, "
                   . " certification=:certification, "
                   . " licence=:licence, "
                   . " last_modify=now() "
              . "Where 	driver_key = :driver_key ";
        $values=array("name"=>$params['name'],
                      "gender"=>$params['gender'],
                      "phone"=>$params['phoneNumber'],
                      "interno"=>$params['interno'],
                      "certification"=>$params['certification'],
                      "licence"=>$params['licence'],
                      "driver_key"=>$params['driver-key']);
        return $this->sql->execute($query, $values, $key);
    }
    
    public function deleteDriver($post){
        $key=0;
        $this->sql=new Consultas();
        $query="Delete From driver "
              . "Where driver_key=:driver_key ";
        $values=array("driver_key"=>$post['keyDriver']);
        return $this->sql->execute($query, $values, $key);
    }
}
