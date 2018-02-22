<?php

class Restaurant {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListRestaurant($cond=""){
        $this->sql=new Consultas();
        $query="Select restaurant_key, name, description, date_register, last_modify  "
             . "  From restaurant $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getRestaurantByKey($keyRestaurant, $cond=""){
        $this->sql=new Consultas();
        $query="Select restaurant_key, name, description, date_register, last_modify  "
               . "From restaurant "
              . "Where restaurant_key =:restaurant_key  $cond ";
        $params=array("restaurant_key"=>$keyRestaurant);
      return $this->sql->getRow($query, $params);
    }
    
    public function getRestaurantByName($restaurantname, $cond=""){
        $this->sql=new Consultas();
        $query="Select restaurant_key, name, description, date_register, last_modify  "
               . "From restaurant "
              . "Where name =:restaurantname  $cond ";
        $params=array("restaurantname"=>$restaurantname);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewRestaurant($params,&$key){
        $this->sql=new Consultas();
        $query="Insert Into restaurant (name, description, date_register, last_modify)"
                        . "Values (:name, :description, now(),now()) ";
        $values=array("name"=>$params['name-restaurant'],
                      "description"=>$params['description-restaurant']);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateRestaurant($params){
        $key=0;
        $this->sql=new Consultas();
        $query="Update restaurant "
                . "Set name=:name, "
                   . " description=:description, "
                   . " last_modify=now() "
              . "Where 	restaurant_key = :restaurant_key ";
        $values=array("name"=>$params['name-restaurant'],
                      "description"=>$params['description-restaurant'],
                      "restaurant_key"=>$params['restaurant-key']);
        return $this->sql->execute($query, $values, $key);
    }
    
    public function deleteRestaurant($post){
        $key=0;
        $this->sql=new Consultas();
        $query="Delete From restaurant "
              . "Where restaurant_key=:restaurant_key ";
        $values=array("restaurant_key"=>$post['keyRestaurant']);
        return $this->sql->execute($query, $values, $key);
    }
}
