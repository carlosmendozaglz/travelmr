<?php

class RestaurantController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridRestaurant(){
        $util=new Util();
        $restaurant=new Restaurant;
        $rows=$restaurant->getListRestaurant();
        $data="";
        $cont=0;
        foreach ($rows as $Restaurantactual){
            $key           = $Restaurantactual['restaurant_key'];
            $name          = $Restaurantactual['name'];
            $description   = $Restaurantactual['description'];
            $date_register = $Restaurantactual['date_register'];
            $last_modify   = $Restaurantactual['last_modify'];
            
            $btndelete   ="<a class='btn btn-xs btn-danger delete-restaurant'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-restaurant'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-restaurant'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$key' class='row-restaurant'>"
                        . "<td>$name</td>"
                        . "<td>$description</td>"
                        . "<td class='text-center'>$btndelete</td>"
                        . "<td class='text-center'>$btnedit</td>"
                        . "<td class='text-center'>$btncreateas</td>"
                   . "</tr>";
            $cont++;
        }
        if($cont==0){
            $data .= "<tr>"
                        . "<td colspan='6' > Ning&uacute;n registro encontrado </td>"
                   . "</tr>";
        }
        
        $util->showData(Conf::$FLAG_SUCCESS, '', $data);
    }
    
    public function newRestaurant($post, $files){
        $util=new Util();
        $restaurant=new Restaurant();
        $name=$post['name-restaurant'];
        $description=$post['description-restaurant'];
        $message="";

        if($util->isLengthValid($name,  Conf::$RESTAURANT_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$RESTAURANT_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($name, Conf::$RESTAURANT_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$RESTAURANT_CAMP_DESCRIPTION, $message) &&
           $this->notExistRestaurant($name, 0, $message)){
            $key=0;
            if($restaurant->saveNewRestaurant($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Restaurante guardado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el restaurante. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function notExistRestaurant($restaurantname, $restaurantkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $restaurant=new Restaurant();
        $restaurant=  $restaurant->getRestaurantByName($restaurantname);
        if(isset($restaurant['name'])){
            $restaurantnamebd=$restaurant['name'];
            $restaurantkeybd=$restaurant['restaurant_key'];
            if($restaurantkey!=$restaurantkeybd){
                $message="El restaurante $restaurantname ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultRestaurant($post){
        $util=new Util();
        $restaurant=new Restaurant();
        $cont=0;
        if($util->isOnlyNumber($post['keyRestaurant'])){
            $restaurant=  $restaurant->getRestaurantByKey($post['keyRestaurant']);
            if($restaurant==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($restaurant, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateRestaurant($post, $files){
        $util=new Util();
        $restaurant=new Restaurant();
        $restaurantkey=$post['restaurant-key'];
        $namerestaurant=$post['name-restaurant'];
        $description=$post['description-restaurant'];
        $message="";

        if($util->isOnlyNumber($restaurantkey,"identificador",$message) &&
           $util->isLengthValid($namerestaurant,  Conf::$HOTEL_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$HOTEL_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($namerestaurant, Conf::$HOTEL_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$HOTEL_CAMP_DESCRIPTION, $message) &&
           $this->notExistRestaurant($namerestaurant, $restaurantkey, $message)){
            $key=0;
            if($restaurant->updateRestaurant($post) ){
                $util->showData(Conf::$FLAG_SUCCESS, "Restaurante actualizado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al actualizado el restaurante.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function deleteRestaurant($post){
        $util=new Util();
        $restaurant=new Restaurant();
        $restaurantKey=$post['keyRestaurant'];
        $message="";

        if($util->isOnlyNumber($restaurantKey,"",$message)){
            if($restaurant->deleteRestaurant($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Restauran eliminado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "El restauran no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
    public function optionsRestaurant(){
        $util=new Util();
        $restaurant=new Restaurant();
        $rows=$restaurant->getListRestaurant();
        $data="";
        $cont=0;
        
        foreach ($rows as $currentrestaurant){
            $key           = $currentrestaurant['restaurant_key'];
            $name          = $currentrestaurant['name'];
            
            $data .= "<option value='$key' class='row-branch'>"
                            . "$name"
                   . "</option>";
            $cont++;
        }
        if($cont==0){
            $data .= "<option value=''>Ning&uacute;n registo encontrado</option>";
        }
        $util->showData(Conf::$FLAG_SUCCESS, '', $data);
    }
    
}
