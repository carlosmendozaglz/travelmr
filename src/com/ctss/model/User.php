<?php

class User {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListUser($cond=""){
        $this->sql=new Consultas();
        $query="Select user_key, type, name, user, password, date_register, last_modify, status, branch_key, branch, no_employe "
               . "From vw_usuarios $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getUserByKey($userkey, $cond=""){
        $this->sql=new Consultas();
        $query="Select user_key, type, name, user, password, date_register, last_modify, status, branch_key, branch, no_employe  "
               . "From vw_usuarios "
              . "Where user_key =:user_key  $cond ";
        $params=array("user_key"=>$userkey);
      return $this->sql->getRow($query, $params);
    }
    
    public function getUserByUsername($username, $cond=""){
        $this->sql=new Consultas();
        $query="Select user_key, type, name, user, password, date_register, last_modify, status, branch_key, branch, no_employe  "
               . "From vw_usuarios "
              . "Where user =:user  $cond ";
        $params=array("user"=>$username);
      return $this->sql->getRow($query, $params);
    }
    
    public function getUserPrivileges($userkey, $cond=""){
        $this->sql=new Consultas();
        $query="Select privilege_key, menu_key, user_key, date_start, date_end, last_modify, date_register "
             . "  From privilege "
             . " Where user_key=:user_key $cond ";
        $params=array("user_key"=>$userkey);
      return $this->sql->getResults($query, $params);
    }
    
    public function saveNewUser($params,&$key){
        $this->sql=new Consultas();

        $query="Insert Into user ( type,          name,        user,    password, "
                       . "         date_register, last_modify, status,  branch_key, "
                       . "         no_employe)"
                       . "Values (:type,          :name,      :user,    sha1(:password), "
                       . "         now(),          now(),     :status, :branch_key, "
                       . "        (Select Ifnull(Max(no_employe),0)+1 From user)) ";
        $values=array("type"       => $params['type'],
                      "name"       => $params['user-name'],
                      "user"       => $params['user'],
                      "password"   => $params['password'],
                      "status"     => $params['status'],
                      "branch_key" => $params['branch'],
                      "no_employe" => $params['no_employe']);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateUser($params, $key){
        $this->sql=new Consultas();
        $query="Update user "
                . "Set name        =:name, "
                   . " user        =:user, "
                   . " branch_key  =:branch_key, "
                   . " last_modify = now(), "
                   . " type        =:type "
              . "Where user_key    =:user_key ";
        $values=array("name"       => $params['user-name'],
                      "user"       => $params['user'],
                      "branch_key" => $params['branch'],
                      "type"       => $params['type'],
                      "user_key"   => $params['user-key']);
        return $this->sql->execute($query, $values, $key);
    }
    
    public function deleteUser($post){
        $this->sql=new Consultas();
        $query="Delete From user "
              . "Where user_key=:user_key ";
        $values=array("user_key"=>$post['userkey']);
        $key=0;
        return $this->sql->execute($query, $values, $key);
    }
    
   
}
