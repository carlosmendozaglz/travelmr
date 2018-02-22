<?php

class Customer {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListCustomer($cond=""){
        $this->sql=new Consultas();
        $query="Select customer_key, name, gender, birthdate, address, phone_number, miles, last_modify, date_register "
             . "  From customer ";
       return $this->sql->getResults($query, null);
    }
    
    public function getCustomerByKey($customerkey, $cond=""){
        $this->sql=new Consultas();
        $query="Select customer_key, name, gender, birthdate, address, phone_number, miles, last_modify, date_register "
               . "From customer "
              . "Where customer_key =:customer_key  $cond ";
        $params=array("customer_key"=>$customerkey);
        return $this->sql->getRow($query, $params);
    }
    
    public function getCustomerByName($customername, $cond=""){
        $this->sql=new Consultas();
        $query="Select customer_key, name, gender, birthdate, address, phone_number, miles, last_modify, date_register "
               . "From customer "
              . "Where name =:customername  $cond ";
        $params=array("customername"=>$customername);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewCustomer($params,&$key){
        $this->sql=new Consultas();
        
        $customername=$params['customer-name'];
        $gender=$params['gender'];
        $birthdate=$params['birthdate'];
        $customeraddress=$params['customer-address'];
        $customerphone=$params['customer-phone'];

        
        $query="Insert Into customer ( name,  gender,  birthdate,  address,  phone_number, last_modify, date_register) "
             . "              Values (:name, :gender, :birthdate, :address, :phone_number, now(), now() ) ";
        $values=array("name"         => $customername,
                      "gender"       => $gender,
                      "birthdate"    => $birthdate,
                      "address"      => $customeraddress,
                      "phone_number" => $customerphone );
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateCustomer($params){
        $this->sql=new Consultas();

        $customerkey=$params['customer-key'];
        $customername=$params['customer-name'];
        $gender=$params['gender'];
        $birthdate=$params['birthdate'];
        $customeraddress=$params['customer-address'];
        $customerphone=$params['customer-phone'];

        $query="Update customer "
                . "Set name=:name, "
                   . " gender=:gender, "
                   . " birthdate=:birthdate,"
                   . " address=:address,"
                   . " phone_number=:phone_number,"
                   . " last_modify=now() "
              . "Where customer_key=:customer_key ";
        $values=array("name"         => $customername,
                      "gender"       => $gender,
                      "birthdate"    => $birthdate ,
                      "address"      => $customeraddress ,
                      "phone_number" => $customerphone ,
                      "customer_key" => $customerkey);
        return $this->sql->execute($query, $values, $customerkey);
    }
    
    public function deleteCustomer($post){
        $key=0;
        $this->sql=new Consultas();
        $query="Delete From customer "
              . "Where customer_key=:customer_key ";
        $values=array("customer_key"=>$post['customerkey']);
        return $this->sql->execute($query, $values, $key);
    }
}
