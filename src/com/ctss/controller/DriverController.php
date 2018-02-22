<?php

class DriverController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridDriver(){
        $util=new Util();
        $driver=new Driver;
        $rows=$driver->getListDriver();
        $data="";
        $cont=0;
        foreach ($rows as $Driveractual){
            $key           = $Driveractual['driver_key'];
            $name          = $Driveractual['name'];
            $gender        = $Driveractual['gender'];
            $phone         = $Driveractual['phone'];
            $licence       = $Driveractual['licence'];
            $certification = $Driveractual['certification'];
            
            $btndelete   ="<a class='btn btn-xs btn-danger delete-driver'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-driver'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-driver'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$key' class='row-driver'>"
                        . "<td>$name</td>"
                        . "<td>$gender</td>"
                        . "<td>$phone</td>"
                        . "<td>$licence</td>"
                        . "<td>$certification</td>"
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
    
    public function newDriver($post, $files){
        $util=new Util();
        $driver=new Driver();
        $name=$post['name'];
        $gender=$post['gender'];
        $phoneNumber=$post['phoneNumber'];
        $interno=$post['interno'];
        $certification=$post['certification'];
        $licence=$post['licence'];
        
        $message="";

        if($util->isLengthValid($name,  Conf::$DRIVER_CAMP_NAME, Conf::$DRIVER_CAMP_NAME_MAXL, Conf::$DRIVER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($gender, Conf::$DRIVER_CAMP_GENDER, Conf::$DRIVER_CAMP_GENDER_MAXL, Conf::$DRIVER_CAMP_GENDER_MINL,  $message) &&
           $util->isLengthValid($phoneNumber, Conf::$DRIVER_CAMP_PHONE, Conf::$DRIVER_CAMP_PHONE_MAXL, Conf::$DRIVER_CAMP_PHONE_MINL,  $message) &&     
           $util->isLengthValid($interno, Conf::$DRIVER_CAMP_INTERNO, Conf::$DRIVER_CAMP_INTERNO_MAXL, Conf::$DRIVER_CAMP_INTERNO_MINL,  $message) &&
           $util->isLengthValid($certification, Conf::$DRIVER_CAMP_CERTIFICATION, Conf::$DRIVER_CAMP_CERTIFICATION_MAXL, Conf::$DRIVER_CAMP_CERTIFICATION_MINL,  $message) &&
           $util->isLengthValid($licence, Conf::$DRIVER_CAMP_LICENCE, Conf::$DRIVER_CAMP_LICENCE_MAXL, Conf::$DRIVER_CAMP_LICENCE_MINL,  $message) &&
           $util->isOnlyText($name, Conf::$DRIVER_CAMP_NAME, $message) && 
           $util->isOnlyText($gender, Conf::$DRIVER_CAMP_GENDER, $message) && 
           $util->isOnlyTextAndNumber($certification, Conf::$DRIVER_CAMP_CERTIFICATION, $message) &&
           $util->isOnlyTextAndNumber($licence, Conf::$DRIVER_CAMP_LICENCE, $message) &&     
           $this->notExistDriver($licence, 0, $message)){
            $key=0;
            if($driver->saveNewDriver($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Conductor guardado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el drivere. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function notExistDriver($driverLicence, $driverkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $driver=new Driver();
        $driver=  $driver->getDriverByLicence($driverLicence);
        if(isset($driver['licence'])){
            $driverLicence=$driver['licence'];
            $driverkeybd=$driver['driver_key'];
            if($driverkey!=$driverkeybd){
                $message="La licencia del conductor $driverLicence ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultDriver($post){
        $util=new Util();
        $driver=new Driver();
        $cont=0;
        if($util->isOnlyNumber($post['keyDriver'])){
            $driver=  $driver->getDriverByKey($post['keyDriver']);
            if($driver==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($driver, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateDriver($post, $files){
        $util=new Util();
        $driver=new Driver();
        $driverkey=$post['driver-key'];   
        $name=$post['name'];
        $gender=$post['gender'];
        $phoneNumber=$post['phoneNumber'];
        $interno=$post['interno'];
        $certification=$post['certification'];
        $licence=$post['licence'];
        
        $message="";

         if($util->isLengthValid($name,  Conf::$DRIVER_CAMP_NAME, Conf::$DRIVER_CAMP_NAME_MAXL, Conf::$DRIVER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($gender, Conf::$DRIVER_CAMP_GENDER, Conf::$DRIVER_CAMP_GENDER_MAXL, Conf::$DRIVER_CAMP_GENDER_MINL,  $message) &&
           $util->isLengthValid($phoneNumber, Conf::$DRIVER_CAMP_PHONE, Conf::$DRIVER_CAMP_PHONE_MAXL, Conf::$DRIVER_CAMP_PHONE_MINL,  $message) &&     
           $util->isLengthValid($interno, Conf::$DRIVER_CAMP_INTERNO, Conf::$DRIVER_CAMP_INTERNO_MAXL, Conf::$DRIVER_CAMP_INTERNO_MINL,  $message) &&
           $util->isLengthValid($certification, Conf::$DRIVER_CAMP_CERTIFICATION, Conf::$DRIVER_CAMP_CERTIFICATION_MAXL, Conf::$DRIVER_CAMP_CERTIFICATION_MINL,  $message) &&
           $util->isLengthValid($licence, Conf::$DRIVER_CAMP_LICENCE, Conf::$DRIVER_CAMP_LICENCE_MAXL, Conf::$DRIVER_CAMP_LICENCE_MINL,  $message) &&
           $util->isOnlyText($name, Conf::$DRIVER_CAMP_NAME, $message) && 
           $util->isOnlyText($gender, Conf::$DRIVER_CAMP_GENDER, $message) && 
           $util->isOnlyTextAndNumber($certification, Conf::$DRIVER_CAMP_CERTIFICATION, $message) &&
           $util->isOnlyTextAndNumber($licence, Conf::$DRIVER_CAMP_LICENCE, $message)){
           $key=0;
            if($driver->updateDriver($post,$key) ){
                $util->showData(Conf::$FLAG_SUCCESS, "Conductor actualizado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al actualizado al conductor.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function deleteDriver($post){
        $util=new Util();
        $driver=new Driver();
        $driverKey=$post['keyDriver'];
        $message="";

        if($util->isOnlyNumber($driverKey,"",$message)){
            if($driver->deleteDriver($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Restauran eliminado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "El restauran no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
}
