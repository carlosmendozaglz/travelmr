<?php

class Hotel {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListHotel($cond=""){
        $this->sql=new Consultas();
        $query="Select hotel_key, name, description, date_register, last_modify  "
               . "From hotel $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getHotelByKey($keyhotel, $cond=""){
        $this->sql=new Consultas();
        $query="Select hotel_key, name, description, date_register, last_modify  "
               . "From hotel "
              . "Where hotel_key =:hotel_key  $cond ";
        $params=array("hotel_key"=>$keyhotel);
      return $this->sql->getRow($query, $params);
    }
    
    public function getHotelByName($hotelname, $cond=""){
        $this->sql=new Consultas();
        $query="Select hotel_key, name, description, date_register, last_modify  "
               . "From hotel "
              . "Where name =:hotelname  $cond ";
        $params=array("hotelname"=>$hotelname);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewHotel($params,&$key){
        $this->sql=new Consultas();
        $query="Insert Into hotel (name, description, date_register, last_modify)"
                        . "Values (:name, :description, now(),now()) ";
        $values=array("name"=>$params['name-hotel'],
                      "description"=>$params['description-hotel']);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateHotel($params){
        $this->sql=new Consultas();
        $query="Update hotel "
                . "Set name=:name, "
                   . " description=:description, "
                   . " last_modify=now() "
              . "Where hotel_key=:hotel_key ";
        $values=array("name"=>$params['name-hotel'],
                      "description"=>$params['description-hotel'],
                      "hotel_key"=>$params['hotel-key']);
        return $this->sql->execute($query, $values);
    }
    
    public function deleteHotel($post){
        $this->sql=new Consultas();
        $query="Delete From hotel "
              . "Where hotel_key=:hotel_key ";
        $values=array("hotel_key"=>$post['keyhotel']);
        return $this->sql->execute($query, $values);
    }
}
