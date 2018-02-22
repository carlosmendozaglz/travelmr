<?php

class Model {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function login($post){
        try{
            $password=$post['password'];
            $user=$post['user'];

            $this->sql=new Consultas();
            $query="call p_Login(:user, :password)";
            $values = array("user"     => $user,
                            "password" => $password);
           return $this->sql->getResults($query, $values);
        } catch (Exception $ex) {
            throw new Exception("No se puede consultar el usuario.");
            return null;
        }
    }
    
    public function logout($userkey){
        try{
            $this->sql=new Consultas();
            $query="call p_Logout(:userkey)";
            $values = array("userkey"     => $userkey);
           return $this->sql->getRow($query, $values);
        } catch (Exception $ex) {
            throw new Exception("No se puede consultar el usuario.");
            return null;
        }
    }
    
    public function loadFile($params){
        $this->sql=new Consultas();
        try{
            $query="Insert Into file ( file_content, file_type,    file_name,    date_register, "
                    . "                last_modify,  table_origin, key_table_fk, user_key)"
                    . "       Values (:file,        :type,        :name,         now(),"
                    . "                now(),       :table,       :keytable,    :user_key )";
            $values = array("file"     => $params['bytes'],
                            "type"     => $params['type'],
                            "name"     => $params['filename'],
                            "table"    => $params['origen'],
                            "keytable" => $params['tablekeyfk'],
                            "user_key" => $params['user']);
            return $this->sql->execute($query, $values, $key);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function deleteFiles($parms){
        $this->sql=new Consultas();
        try{
            $query="Delete From file"
                 . "      Where file_key>0 "
                 . "        And table_origin=:table_origin "
                 . "        And key_table_fk=:key_table_fk ";
            $values=array("table_origin" => $parms['table'],
                          "key_table_fk" => $parms['key']);
            return $this->sql->execute($query, $values, $key);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getFile($parms){
        $this->sql=new Consultas();
        try{
            $query="Select file_key, file_content, file_type, date_register, last_modify, table_origin, key_table_fk, user_key "
                 . "  From file "
                 . " Where key_table_fk=:key  "
                 . "   And table_origin=:table ";
            $values=array("key"   => $parms['key'],
                          "table" => $parms['table']);

            return $this->sql->getRow($query, $values);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getOptionAccess($userkey=0){
        $this->sql=new Consultas();
        try{
            $query="Select menu_key, type, icon, label, link, function, visible, parent_key, transaction "
                  . " From menu "
                  . "Order By menu_key, parent_key ";
            
            return $this->sql->getResults($query, null);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getModules($cond=""){
        $this->sql=new Consultas();
        try{
            $query="Select module_key, module_des, icon From module $cond";
            
            return $this->sql->getResults($query, null);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getItemsModuleByModuleKey($key, $cond=""){
        $this->sql=new Consultas();
        try{
            $query="Select menu_key, type, icon, label, link, function, visible, parent_key, transaction, module_key, sequence "
                 . "  From menu "
                 . " Where module_key =:module_key $cond";
            $values=array("module_key" => $key);
            return $this->sql->getResults($query, $values);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    
    public function getPrivilege($parms, $cond=""){
        $this->sql=new Consultas();
        try{
            $userkey=$parms['userkey'];
            $item=$parms['item'];
            $query="Select privilege_key, menu_key, user_key, date_start, date_end, last_modify, date_register "
                 . "  From privilege "
                 . " Where user_key=:user_key and menu_key=:menu_key $cond";

            $values=array("user_key" => $userkey,
                          "menu_key" => $item);
            return $this->sql->getResults($query, $values);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getPrivilegeByDesc($parms, $cond=""){
        $this->sql=new Consultas();
        try{
            $userkey=$parms['userkey'];
            $trans=$parms['trans'];
            $query="Select menu_key, type, icon, label, link, function, visible, parent_key, transaction, module_key, sequence "
                  ."  From menu m "
                  ." Where Exists ( Select 1 "
                  ."                  From privilege p "
                  ."	 	     Where p.menu_key = m.menu_key "
                  ."                   And user_key =:userkey ) "
                  ."   And transaction=:trans $cond";

            $values=array("userkey" => $userkey,
                          "trans"   => $trans);
            return $this->sql->getResults($query, $values);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function getItemsMenu($userkey){
        $this->sql=new Consultas();
        try {
            $query="Select module_key, module_des, icon, action "
                  ."  From module m "
                  ." Where Exists( Select 1 "
                  ."		     From menu men "
                  ."	   	    Where men.module_key=m.module_key "
                  ."                  And Exists ( Select 1 "
                  ."			    	     From privilege p "
                  ."				    Where p.menu_key=men.menu_key "
                  ."                                  And p.user_key=:user_key ) )";
            $values=array("user_key" => $userkey);
            return $this->sql->getResults($query, $values);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }

        public function insertPrivilege($parms){
        $this->sql=new Consultas();
        try{
            $userkey=$parms['userkey'];
            $item=$parms['item'];
            $key=0;
            $query="Insert Into privilege ( menu_key,  user_key,    date_start, "
                 . "                        date_end,  last_modify, date_register)"
                 . "               Values (:menu_key, :user_key,    curdate(),  "
                 . "                        curdate(), now(),       now())";

            $values=array("menu_key" => $item,
                          "user_key" => $userkey);
            return $this->sql->execute($query, $values, $key);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
    public function deletePrivilege($parms){
        $this->sql=new Consultas();
        try{
            $userkey=$parms['userkey'];
            $item=$parms['item'];
            $key=0;
            $query="Delete From privilege "
                 . " Where menu_key=:menu_key "
                 . "   And user_key=:user_key "
                 . "   And privilege_key>0 ";

            $values=array("menu_key" => $item,
                          "user_key" => $userkey);
            return $this->sql->execute($query, $values, $key);
        } catch (Exception $ex) {
            throw new Exception("Error al realizar transacción.");
            return null;
        }
    }
    
}
