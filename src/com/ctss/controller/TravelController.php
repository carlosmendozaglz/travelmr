<?php

class TravelController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridTravel(){
        $util=new Util();
        $travel=new Travel();
        $rows=$travel->getListTravel();
        $data="";
        $cont = 0;
        foreach ($rows as $currenttravel) {
            $travel_key = $currenttravel['travel_key'];
            $location = $currenttravel['location'];
            $description = $currenttravel['description'];
            $date_departure = $currenttravel['date_departure'];
            $date_return = $currenttravel['date_return'];
            $time_departure = $currenttravel['time_departure'];
            $time_return = $currenttravel['time_return'];
            $date_register = $currenttravel['date_register'];
            $last_modify = $currenttravel['last_modify'];
            $adult_price = $currenttravel['adult_price'];
            $minor_price = $currenttravel['minor_price'];
            $infant_price = $currenttravel['infant_price'];
            $days = $currenttravel['days'];
            $nigth = $currenttravel['nigth'];
            $restaurant_key = $currenttravel['restaurant_key'];
            $hotel_key = $currenttravel['hotel_key'];
            $airline_key = $currenttravel['airline_key'];
            $coments = $currenttravel['coments'];
            $last_day_pay = $currenttravel['last_day_pay'];
            $percent = $currenttravel['percent'];
            $notes = $currenttravel['notes'];
            $miles = $currenttravel['miles'];
            $key = $currenttravel['key_'];


            $btndelete   ="<a class='btn btn-xs btn-danger delete-travel'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-travel'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-travel'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$travel_key' class='row-travel'>"
                        . "<td>$key</td>"
                        . "<td>$location</td>"
                        . "<td>$date_departure  $time_departure</td>"
                        . "<td>$date_return  $time_return</td>"
                        . "<td>$last_day_pay</td>"
                        . "<td>$percent</td>"
                        . "<td class='text-center'>$btndelete</td>"
                        . "<td class='text-center'>$btnedit</td>"
                        . "<td class='text-center'>$btncreateas</td>"
                   . "</tr>";
            $cont++;
        }
        if($cont==0){
            $data .= "<tr>"
                        . "<td colspan='6' class='text-center' > Ning&uacute;n registro encontrado </td>"
                   . "</tr>";
        }
        
        $util->showData(Conf::$FLAG_SUCCESS, '', $data);
    }
    
    public function newTravel($post, $files){
        $util=new Util();
        $travel=new Travel();
        
        $keytravel=$post['key-travel'];
        $location=$post['location'];
        $description=$post['description'];
        $notes=$post['notes'];
        $datedeparture=$post['date-departure'];
        $timedeparture=$post['time-departure'];
        $datereturn=$post['date-return'];
        $timereturn=$post['time-return'];
        $adultprice=$post['adult-price'];
        $minorprice=$post['minor-price'];
        $infantprice=$post['infant-price'];
        $days=$post['days'];
        $nigth=$post['nigth'];
        $restaurantkey=$post['restaurant-key'];
        $hotelkey=$post['hotel-key'];
        $airlinekey=$post['airline-key'];
        $lastdaypay=$post['last-day-pay'];
        $percent=$post['percent'];
        $miles=$post['miles'];
        
        $message="";

        if($util->isLengthValid($keytravel, Conf::$TRAVEL_CAMP_TRAVEL_KEY, Conf::$TRAVEL_CAMP_TRAVEL_KEY_MAXL, Conf::$TRAVEL_CAMP_TRAVEL_KEY_MINL, $message) &&
           $util->isLengthValid($location, Conf::$TRAVEL_CAMP_LOCATION,Conf::$TRAVEL_CAMP_LOCATION_MAXL, Conf::$TRAVEL_CAMP_LOCATION_MINL,  $message) &&
           $util->isLengthValid($description, Conf::$TRAVEL_CAMP_DESCRIPTION, Conf::$TRAVEL_CAMP_DESCRIPTION_MAXL,  Conf::$TRAVEL_CAMP_DESCRIPTION_MINL,$message) &&
           $util->isLengthValid($notes, Conf::$TRAVEL_CAMP_NOTES, Conf::$TRAVEL_CAMP_NOTES_MAXL, Conf::$TRAVEL_CAMP_NOTES_MINL,  $message, true) && 
           $util->isOnlyDate($datedeparture, Conf::$TRAVEL_CAMP_DATE_DEPARTURE, $message) &&
           $util->isOnlyTime($timedeparture, Conf::$TRAVEL_CAMP_TIME_DEPARTURE, $message) &&
           $util->isOnlyDate($datereturn, Conf::$TRAVEL_CAMP_DATE_RETURN, $message) &&
           $util->isOnlyTime($timereturn, Conf::$TRAVEL_CAMP_TIME_RETURN, $message) &&
           $util->isPrice($adultprice, Conf::$TRAVEL_CAMP_ADULT_PRICE, $message, false, false) &&
           $util->isPrice($minorprice, Conf::$TRAVEL_CAMP_MINOR_PRICE, $message, false, false) &&
           $util->isPrice($infantprice, Conf::$TRAVEL_CAMP_INFANT_PRICE, $message, false, false) &&
           $util->isOnlyNumber($days, Conf::$TRAVEL_CAMP_DAYS, $message) &&
           $util->isOnlyNumber($nigth, Conf::$TRAVEL_CAMP_NIGTHS, $message) &&
           $util->isNotNull($restaurantkey, Conf::$TRAVEL_CAMP_RESTAURANT, $message) &&
           $util->isNotNull($hotelkey, Conf::$TRAVEL_CAMP_HOTEL, $message) &&
           $util->isNotNull($airlinekey, Conf::$TRAVEL_CAMP_AIRLINE, $message) &&
           $util->isOnlyDate($lastdaypay, Conf::$TRAVEL_CAMP_LAST_DAY_PAY, $message) &&
           $util->isOnlyNumber($percent, Conf::$TRAVEL_CAMP_PERCENT, $message) &&
           $util->isOnlyNumber($miles, Conf::$TRAVEL_CAMP_MILES, $message) &&
           $this->notExistTravel($keytravel, 0, $message)){
            $key=0;
            $post['date-departure']=$util->toDateMySql($datedeparture);
            $post["date-return"]=$util->toDateMySql($datereturn);
            $post['last-day-pay']=$util->toDateMySql($lastdaypay);
            
            if($travel->saveNewTravel($post, $key)){
                Session::start();
                Session::setSession(Conf::$SESS_TABLE_KEY_TMP, $key);
                $util->showData(Conf::$FLAG_SUCCESS, "Viaje guardado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el viaje. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function notExistTravel($key, $travelkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $travel=new Travel();
        $travelconst=$travel->getTravelByKeyTravel($key);
        if(isset($travelconst['key_'])){
            $travelkeybd=$travelconst['travel_key'];
            $keybd=$travelconst['key_'];
            if($travelkey!=$travelkeybd){
                $message="El viaje con clave $keybd ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultTravel($post){
        $util=new Util();
        $travel=new Travel();
        $cont=0;
        if($util->isOnlyNumber($post['keytravel'])){
            $restaurant=  $travel->getTravelByKey($post['keytravel']);
            if($restaurant==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($restaurant, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateTravel($post, $files){
        $util=new Util();
        $travel=new Travel();
        $key=$post['travel-key'];
        $keytravel=$post['key-travel'];
        $location=$post['location'];
        $description=$post['description'];
        $notes=$post['notes'];
        $datedeparture=$post['date-departure'];
        $timedeparture=$post['time-departure'];
        $datereturn=$post['date-return'];
        $timereturn=$post['time-return'];
        $adultprice=$post['adult-price'];
        $minorprice=$post['minor-price'];
        $infantprice=$post['infant-price'];
        $days=$post['days'];
        $nigth=$post['nigth'];
        $restaurantkey=$post['restaurant-key'];
        $hotelkey=$post['hotel-key'];
        $airlinekey=$post['airline-key'];
        $lastdaypay=$post['last-day-pay'];
        $percent=$post['percent'];
        $miles=$post['miles'];
        
        $message="";

        if($util->isLengthValid($keytravel, Conf::$TRAVEL_CAMP_TRAVEL_KEY, Conf::$TRAVEL_CAMP_TRAVEL_KEY_MAXL, Conf::$TRAVEL_CAMP_TRAVEL_KEY_MINL, $message) &&
           $util->isLengthValid($location, Conf::$TRAVEL_CAMP_LOCATION,Conf::$TRAVEL_CAMP_LOCATION_MAXL, Conf::$TRAVEL_CAMP_LOCATION_MINL,  $message) &&
           $util->isLengthValid($description, Conf::$TRAVEL_CAMP_DESCRIPTION, Conf::$TRAVEL_CAMP_DESCRIPTION_MAXL,  Conf::$TRAVEL_CAMP_DESCRIPTION_MINL,$message) &&
           $util->isLengthValid($notes, Conf::$TRAVEL_CAMP_NOTES, Conf::$TRAVEL_CAMP_NOTES_MAXL, Conf::$TRAVEL_CAMP_NOTES_MINL,  $message, true) && 
           $util->isOnlyDate($datedeparture, Conf::$TRAVEL_CAMP_DATE_DEPARTURE, $message) &&
           $util->isOnlyTime($timedeparture, Conf::$TRAVEL_CAMP_TIME_DEPARTURE, $message) &&
           $util->isOnlyDate($datereturn, Conf::$TRAVEL_CAMP_DATE_RETURN, $message) &&
           $util->isOnlyTime($timereturn, Conf::$TRAVEL_CAMP_TIME_RETURN, $message) &&
           $util->isPrice($adultprice, Conf::$TRAVEL_CAMP_ADULT_PRICE, $message, false, false) &&
           $util->isPrice($minorprice, Conf::$TRAVEL_CAMP_MINOR_PRICE, $message, false, false) &&
           $util->isPrice($infantprice, Conf::$TRAVEL_CAMP_INFANT_PRICE, $message, false, false) &&
           $util->isOnlyNumber($days, Conf::$TRAVEL_CAMP_DAYS, $message) &&
           $util->isOnlyNumber($nigth, Conf::$TRAVEL_CAMP_NIGTHS, $message) &&
           $util->isNotNull($restaurantkey, Conf::$TRAVEL_CAMP_RESTAURANT, $message) &&
           $util->isNotNull($hotelkey, Conf::$TRAVEL_CAMP_HOTEL, $message) &&
           $util->isNotNull($airlinekey, Conf::$TRAVEL_CAMP_AIRLINE, $message) &&
           $util->isOnlyDate($lastdaypay, Conf::$TRAVEL_CAMP_LAST_DAY_PAY, $message) &&
           $util->isOnlyNumber($percent, Conf::$TRAVEL_CAMP_PERCENT, $message) &&
           $util->isOnlyNumber($miles, Conf::$TRAVEL_CAMP_MILES, $message) &&
           $this->notExistTravel($keytravel, $key, $message)){
            $key=0;
            $post['date-departure']=$util->toDateMySql($datedeparture);
            $post["date-return"]=$util->toDateMySql($datereturn);
            $post['last-day-pay']=$util->toDateMySql($lastdaypay);
            
            if($travel->updateTravel($post, $key)){
                Session::start();
                Session::setSession(Conf::$SESS_TABLE_KEY_TMP, $post['travel-key']);
                $util->showData(Conf::$FLAG_SUCCESS, "Viaje guardado .");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el viaje. ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function deleteTravel($post){
        $util=new Util();
        $travel=new Travel();
        $travelkey=$post['keytravel'];
        $message="";

        if($util->isOnlyNumber($travelkey,"",$message)){
            if($travel->deleteTravel($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Viaje eliminado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "El viaje no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
 
    public function savePhotosTravel($post, $files){
        $msg="";
        $util=new Util();
        Session::start();
        if(!Session::issetSession(Conf::$SESS_TABLE_KEY_TMP)){
            $util->showUnformatData("Origen de la imagen no legible.");
            exit();
        }
        
        $key=  Session::getSession(Conf::$SESS_TABLE_KEY_TMP);
        $util->saveFile($post, $files, $key, Conf::$TABLE_TRAVEL);
        Session::unsetSession(Conf::$SESS_TABLE_KEY_TMP);
    }
    
    public function deletePhotoTravel($post){
        
    }
    
}
