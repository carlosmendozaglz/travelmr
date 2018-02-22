<?php

class AirlineController {
      
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridAirline(){
        $util=new Util();
        $airline=new Airline();
        $rows=$airline->getListAirline();
        $data="";
        $cont=0;
        foreach ($rows as $currentAirline){
            $key           = $currentAirline['airline_key'];
            $name          = $currentAirline['airline_name'];
            $description   = $currentAirline['airline_description'];
            $date_register = $currentAirline['date_register'];
            $last_modify   = $currentAirline['last_modify'];
            
            $btndelete   ="<a class='btn btn-xs btn-danger delete-airline'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-airline'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-airline'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$key' class='row-hotel'>"
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
    
    public function newAirline($post, $files){
        $util=new Util();
        $airline=new Airline();
        $nameAirline=$post['name-airline'];
        $description=$post['description-airline'];
        $message="";

        if($util->isLengthValid($nameAirline,  Conf::$AIRLINE_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$HOTEL_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($nameAirline, Conf::$AIRLINE_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$HOTEL_CAMP_DESCRIPTION, $message) &&
           $this->notExistAirline($nameAirline, 0, $message)){
            $key=0;
            if($airline->saveNewAirline($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Aereolínea guardada. $key ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar la aereolinea. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function notExistAirline($nameAirline, $airlineKey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $airline=new Airline();
        $airline=  $airline->getAirlineByName($nameAirline);
        if(isset($airline['airline_name'])){
            $airlineNamebd=$airline['airline_name'];
            $airlineKeybd=$airline['airline_key'];
            if($airlineKey!=$airlineKeybd){
                $message="La aereolínea $nameAirline ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultAirline($post){
        $util=new Util();
        $airline=new Airline();
        $cont=0;
        if($util->isOnlyNumber($post['keyAirline'])){
            $airline=  $airline->getAirlineByKey($post['keyAirline']);
            if($airline==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($airline, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateAirline($post, $files){
        $util=new Util();
        $airline=new Airline();
        $airlineKey=$post['airline-key'];
        $nameAirline=$post['name-airline'];
        $description=$post['description-airline'];
        $message="";

        if($util->isOnlyNumber($airlineKey,"identificador",$message) &&
           $util->isLengthValid($nameAirline,  Conf::$AIRLINE_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$HOTEL_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($nameAirline, Conf::$AIRLINE_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$HOTEL_CAMP_DESCRIPTION, $message) &&
           $this->notExistAirline($nameAirline, $airlineKey, $message)){
            $key=0;
            if($airline->updateAirline($post) ){
                $util->showData(Conf::$FLAG_SUCCESS, "Aereolínea actualizada.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al actualizar la aereolínea.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function deleteAirline($post){
        $util=new Util();
        $airline=new Airline();
        $airlineKey=$post['keyAirline'];
        $message="";

        if($util->isOnlyNumber($airlineKey,"",$message)){
            if($airline->deleteAirline($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Aereolínea eliminada.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "La aereolínea no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
    public function optionsAirline(){
        $util=new Util();
        $airline=new Airline();
        $rows=$airline->getListAirline();
        $data="";
        $cont=0;

        foreach ($rows as $currentairline){
            $key           = $currentairline['airline_key'];
            $name          = $currentairline['airline_name'];
            
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
