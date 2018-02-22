<?php

class Travel {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListTravel($cond=""){
        $this->sql=new Consultas();
        $query="Select travel_key,     location,     description,   date_departure, date_return, "
                . "    time_departure, time_return,  date_register, last_modify,    adult_price, "
                . "    minor_price,    infant_price, days,          nigth,          restaurant_key, "
                . "    hotel_key,      airline_key,  coments,       last_day_pay,   percent, "
                . "    notes,          miles,        key_,          airline_name,   hotel_name, "
                . "    restaurant_name "
               . "From Vw_Travels $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getTravelByKey($keytravel, $cond=""){
        $this->sql=new Consultas();
       $query="Select travel_key,     location,     description,   date_departure, date_return, "
               . "    time_departure, time_return,  date_register, last_modify,    adult_price, "
               . "    minor_price,    infant_price, days,          nigth,          restaurant_key, "
               . "    hotel_key,      airline_key,  coments,       last_day_pay,   percent, "
               . "    notes,          miles,        key_,          airline_name,   hotel_name, "
               . "    restaurant_name "
              . "From Vw_Travels "
             . "Where travel_key =:travel_key  $cond ";
        $params=array("travel_key"=>$keytravel);
      return $this->sql->getRow($query, $params);
    }
    
    public function getTravelByKeyTravel($travelkey, $cond=""){
        $this->sql=new Consultas();

        $query="Select travel_key,     location,     description,   date_departure, date_return, "
                . "    time_departure, time_return,  date_register, last_modify,    adult_price, "
                . "    minor_price,    infant_price, days,          nigth,          restaurant_key, "
                . "    hotel_key,      airline_key,  coments,       last_day_pay,   percent, "
                . "    notes,          miles,        key_,          airline_name,   hotel_name, "
                . "    restaurant_name "
               . "From Vw_Travels "
              . "Where key_ =:key  $cond ";
        $params=array("key"=>$travelkey);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewTravel($post,&$key){
        
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
        
        $this->sql=new Consultas();
        $query="Insert Into travel ("
                . "    location,       description,   date_departure, date_return, "
                . "    time_departure, time_return,   date_register,  last_modify,    adult_price, "
                . "    minor_price,    infant_price,  days,           nigth,          restaurant_key, "
                . "    hotel_key,      airline_key,   coments,        last_day_pay,   percent, "
                . "    notes,          miles,         key_ ) "
            . "Values ( "
                . "   :location,      :description,  :date_departure,:date_return, "
                . "   :time_departure,:time_return,   now(),          now(),         :adult_price, "
                . "   :minor_price,   :infant_price, :days,          :nigth,         :restaurant_key, "
                . "   :hotel_key,     :airline_key,  :coments,       :last_day_pay,  :percent, "
                . "   :notes,         :miles,        :key ) " ;
        $values=array("location"=>$location,
                      "description"=>$description,
                      "date_departure"=>$datedeparture,
                      "date_return"=>$datereturn,
                      "time_departure"=>$timedeparture,
                      "time_return"=>$timereturn,
                      "adult_price"=>$adultprice,
                      "minor_price"=>$minorprice,
                      "infant_price"=>$infantprice,
                      "days"=>$days,
                      "nigth"=>$nigth,
                      "restaurant_key"=>$restaurantkey,
                      "hotel_key"=>$hotelkey,
                      "airline_key"=>$airlinekey,
                      "coments"=>"",
                      "last_day_pay"=>$lastdaypay,
                      "percent"=>$percent,
                      "notes"=>$notes,
                      "miles"=>$miles,
                      "key"=>$keytravel);
                  
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateTravel($post, &$keyout){
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
        $this->sql=new Consultas();
        $query="Update travel "
                . "Set "
                . "    location       =:location,       description  =:description,   "
                . "    date_departure =:date_departure, date_return  =:date_return, "
                . "    time_departure =:time_departure, time_return  =:time_return,   "
                . "    last_modify    = now(),          adult_price  =:adult_price, "
                . "    minor_price    =:minor_price,    infant_price =:infant_price,  "
                . "    days           =:days,           nigth        =:nigth,          "
                . "    restaurant_key =:restaurant_key, hotel_key    =:hotel_key,     "
                . "    airline_key    =:airline_key,           "
                . "    last_day_pay   =:last_day_pay,   percent      =:percent, "
                . "    notes          =:notes,          miles        =:miles,        "
                . "    key_           =:key_  "
            . "Where travel_key=:travel_key " ;
        $values=array("location"       => $location,
                      "description"    => $description,
                      "date_departure" => $datedeparture,
                      "date_return"    => $datereturn,
                      "time_departure" => $timedeparture,
                      "time_return"    => $timereturn,
                      "adult_price"    => $adultprice,
                      "minor_price"    => $minorprice,
                      "infant_price"   => $infantprice,
                      "days"           => $days,
                      "nigth"          => $nigth,
                      "restaurant_key" => $restaurantkey,
                      "hotel_key"      => $hotelkey,
                      "airline_key"    => $airlinekey,
                      "last_day_pay"   => $lastdaypay,
                      "percent"        => $percent,
                      "notes"          => $notes,
                      "miles"          => $miles,
                      "key_"            => $keytravel,
                      "travel_key"     => $key);
        return $this->sql->execute($query, $values, $keyout);
    }
    
    public function deleteTravel($post){
        $key=0;
        $this->sql=new Consultas();
        $query="Delete From travel "
              . "Where travel_key=:travel_key ";
        $values=array("travel_key"=>$post['keytravel']);
        return $this->sql->execute($query, $values, $key);
    }
}
