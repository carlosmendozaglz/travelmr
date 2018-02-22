<?php

class HotelController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridHotel(){
        $util=new Util();
        $hotel=new Hotel();
        $rows=$hotel->getListHotel();
        $data="";
        $cont=0;
        foreach ($rows as $hotelactual){
            $key           = $hotelactual['hotel_key'];
            $name          = $hotelactual['name'];
            $description   = $hotelactual['description'];
            $date_register = $hotelactual['date_register'];
            $last_modify   = $hotelactual['last_modify'];
            
            $btndelete   ="<a class='btn btn-xs btn-danger delete-hotel'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-hotel'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-hotel'><span class='fa fa-copy'></span></a>";
            
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
    
    public function newHotel($post, $files){
        $util=new Util();
        $hotel=new Hotel();
        $namehotel=$post['name-hotel'];
        $description=$post['description-hotel'];
        $message="";

        if($util->isLengthValid($namehotel,  Conf::$HOTEL_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$HOTEL_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($namehotel, Conf::$HOTEL_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$HOTEL_CAMP_DESCRIPTION, $message) &&
           $this->notExistHotel($namehotel, 0, $message)){
            $key=0;
            if($hotel->saveNewHotel($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Hotel guardado. $key ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el hotel. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function notExistHotel($hotelname, $hotelkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $hotel=new Hotel();
        $hotel=  $hotel->getHotelByName($hotelname);
        if(isset($hotel['name'])){
            $hotelnamebd=$hotel['name'];
            $hotelkeybd=$hotel['hotel_key'];
            if($hotelkey!=$hotelkeybd){
                $message="El hotel $hotelname ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultHotel($post){
        $util=new Util();
        $hotel=new Hotel();
        $cont=0;
        if($util->isOnlyNumber($post['keyhotel'])){
            $hotel=  $hotel->getHotelByKey($post['keyhotel']);
            if($hotel==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($hotel, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateHotel($post, $files){
        $util=new Util();
        $hotel=new Hotel();
        $hotelkey=$post['hotel-key'];
        $namehotel=$post['name-hotel'];
        $description=$post['description-hotel'];
        $message="";

        if($util->isOnlyNumber($hotelkey,"identificador",$message) &&
           $util->isLengthValid($namehotel,  Conf::$HOTEL_CAMP_NAME, Conf::$HOTEL_CAMP_NAME_MAXL, Conf::$HOTEL_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($description, Conf::$HOTEL_CAMP_DESCRIPTION, Conf::$HOTEL_CAMP_DESCRIPTION_MAXL, Conf::$HOTEL_CAMP_DESCRIPTION_MINL,  $message) && 
           $util->isOnlyText($namehotel, Conf::$HOTEL_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($description, Conf::$HOTEL_CAMP_DESCRIPTION, $message) &&
           $this->notExistHotel($namehotel, $hotelkey, $message)){
            $key=0;
            if($hotel->updateHotel($post) ){
                $util->showData(Conf::$FLAG_SUCCESS, "Hotel actualizado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al actualizado el hotel.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function deleteHotel($post){
        $util=new Util();
        $hotel=new Hotel();
        $hotelkey=$post['keyhotel'];
        $message="";

        if($util->isOnlyNumber($hotelkey,"",$message)){
            if($hotel->deleteHotel($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Hotel eliminado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "El hotel no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
    public function optionsHotel(){
        $util=new Util();
        $hotel=new Hotel();
        $rows=$hotel->getListHotel();
        $data="";
        $cont=0;
        foreach ($rows as $currenthotel){
            $key           = $currenthotel['hotel_key'];
            $name          = $currenthotel['name'];
            
            
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
