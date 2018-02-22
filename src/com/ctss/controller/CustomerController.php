<?php

class CustomerController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridCustomer(){
        $util=new Util();
        $customer=new Customer();
        $rows=$customer->getListCustomer();
        $data="";
        $cont=0;
        foreach ($rows as $customeractual){
            $key           = $customeractual['customer_key'];
            $name          = $customeractual['name'];
            $gender   = $customeractual['gender'];
            $birthdate = $customeractual['birthdate'];
            $address   = $customeractual['address'];
            $phone_number   = $customeractual['phone_number'];
            $miles   = $customeractual['miles'];
            $last_modify   = $customeractual['last_modify'];
            $date_register   = $customeractual['date_register'];
            
            $btndelete   = "<a class='btn btn-xs btn-danger delete-customer'><span class='fa fa-remove'></span></a>";
            $btnedit     = "<a class='btn btn-xs btn-primary edit-customer'><span class='fa fa-edit'></span></a>";
            $btncreateas = "<a class='btn btn-xs btn-success createas-customer'><span class='fa fa-copy'></span></a>";
            $img         = "";
            $data .= "<tr data-key='$key' class='row-hotel'>"
                        . "<td>$name </td>"
                        . "<td>$address</td>"
                        . "<td>$phone_number</td>"
                        . "<td>$miles</td>"
                        . "<td>$birthdate</td>"
                        . "<td>$gender</td>"
                        . "<td>$img</td>"
                        . "<td class='text-center'>$btndelete</td>"
                        . "<td class='text-center'>$btnedit</td>"
                        . "<td class='text-center'>$btncreateas</td>"
                   . "</tr>";
            $cont++;
        }
        if($cont==0){
            $data .= "<tr>"
                        . "<td colspan='6' > Ning&uacute;n  registro encontrado </td>"
                   . "</tr>";
        }
        
        $util->showData(Conf::$FLAG_SUCCESS, '', $data);
    }
    
    public function newCustomer($post, $files){
        $util=new Util();
        $customer=new Customer();
        $customername=$post['customer-name'];
        $gender=$post['gender'];
        $birthdate=$post['birthdate'];
        $customeraddress=$post['customer-address'];
        $customerphone=$post['customer-phone'];
        $customermiles=$post['customer-miles'];

        $message="";
        
        if($util->isLengthValid($customername,  Conf::$CUSTOMER_CAMP_NAME, Conf::$CUSTOMER_CAMP_NAME_MAXL, Conf::$CUSTOMER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($birthdate, Conf::$CUSTOMER_CAMP_BIRTHDATE, Conf::$CUSTOMER_CAMP_BIRTHDATE_MAXL, Conf::$CUSTOMER_CAMP_BIRTHDATE_MINL,  $message) && 
           $util->isLengthValid($customeraddress, Conf::$CUSTOMER_CAMP_ADDRESS, Conf::$CUSTOMER_CAMP_ADDRESS_MAXL, Conf::$CUSTOMER_CAMP_ADDRESS_MINL,  $message) && 
           $util->isLengthValid($customerphone, Conf::$CUSTOMER_CAMP_PHONENUMBER, Conf::$CUSTOMER_CAMP_PHONENUMBER_MAXL, Conf::$CUSTOMER_CAMP_PHONENUMBER_MINL,  $message) && 

           $util->isOnlyText($customername, Conf::$CUSTOMER_CAMP_NAME, $message) && 
           $util->isOnlyText($gender, Conf::$CUSTOMER_CAMP_GENDER, $message) &&
           $util->isOnlyDate($birthdate, Conf::$CUSTOMER_CAMP_BIRTHDATE,$message) &&
           $util->isOnlyTextAndNumber($customeraddress, Conf::$CUSTOMER_CAMP_ADDRESS, $message) &&
           $this->notExistCustomer($customername, 0, $message) ){
            $key=0;
            if($customer->saveNewCustomer($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Cliente guardado. $key ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el cliente. ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function notExistCustomer($customername, $customerkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $customer=new Customer();
        $object=  $customer->getCustomerByName($customername);
        if(isset($object['name'])){
            $customernamebd=$object['name'];
            $customerkeybd=$object['customer_key'];
            if($customerkey!=$customerkeybd){
                $message="El usuario $customername ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultCustomer($post){
        $util=new Util();
        $customer=new Customer();
        $cont=0;
        if($util->isOnlyNumber($post['customerkey'])){
            $customer=  $customer->getCustomerByKey($post['customerkey']);
            if($customer==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($customer, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateCustomer($post, $files){
        $util=new Util();
        $customer=new Customer();
        $customerkey=$post['customer-key'];
        $customername=$post['customer-name'];
        $gender=$post['gender'];
        $birthdate=$post['birthdate'];
        $customeraddress=$post['customer-address'];
        $customerphone=$post['customer-phone'];
        $customermiles=$post['customer-miles'];

        $message="";
        
        if($util->isLengthValid($customername,  Conf::$CUSTOMER_CAMP_NAME, Conf::$CUSTOMER_CAMP_NAME_MAXL, Conf::$CUSTOMER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($birthdate, Conf::$CUSTOMER_CAMP_BIRTHDATE, Conf::$CUSTOMER_CAMP_BIRTHDATE_MAXL, Conf::$CUSTOMER_CAMP_BIRTHDATE_MINL,  $message) && 
           $util->isLengthValid($customeraddress, Conf::$CUSTOMER_CAMP_ADDRESS, Conf::$CUSTOMER_CAMP_ADDRESS_MAXL, Conf::$CUSTOMER_CAMP_ADDRESS_MINL,  $message) && 
           $util->isLengthValid($customerphone, Conf::$CUSTOMER_CAMP_PHONENUMBER, Conf::$CUSTOMER_CAMP_PHONENUMBER_MAXL, Conf::$CUSTOMER_CAMP_PHONENUMBER_MINL,  $message) && 

           $util->isOnlyText($customername, Conf::$CUSTOMER_CAMP_NAME, $message) && 
           $util->isOnlyText($gender, Conf::$CUSTOMER_CAMP_GENDER, $message) &&
           $util->isOnlyDate($birthdate, Conf::$CUSTOMER_CAMP_BIRTHDATE,$message) &&
           $util->isOnlyTextAndNumber($customeraddress, Conf::$CUSTOMER_CAMP_ADDRESS, $message) &&
           $this->notExistCustomer($customername, $customerkey, $message) ){
            $key=0;
            
            if($customer->updateCustomer($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Cliente guardado. $key ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el cliente. ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function deleteCustomer($post){
        $util=new Util();
        $customer=new Customer();
        $customerkey=$post['customerkey'];
        $message="";

        if($util->isOnlyNumber($customerkey,"",$message)){
            if($customer->deleteCustomer($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Cliente eliminado.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "El cliente no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
}
