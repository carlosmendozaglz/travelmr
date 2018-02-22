<?php

class Branch {
    
    private $sql;
    private $util;
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function getListBranch($cond=""){
        $this->sql=new Consultas();
        $query="Select branch_key, description, address, date_register, last_modify, status "
               . "From branch $cond ";
       return $this->sql->getResults($query, null);
    }
    
    public function getBranchByKey($keybranch, $cond=""){
        $this->sql=new Consultas();
        $query="Select branch_key, description, address, date_register, last_modify, status "
               . "From branch "
              . "Where branch_key =:branch_key  $cond ";
        $params=array("branch_key"=>$keybranch);
      return $this->sql->getRow($query, $params);
    }
    
    public function getBranchByName($branchname, $cond=""){
        $this->sql=new Consultas();
        $query="Select branch_key, description, address, date_register, last_modify, status   "
               . "From branch "
              . "Where description =:description $cond ";
        $params=array("description"=>$branchname);
      return $this->sql->getRow($query, $params);
    }
    
    public function saveNewBranch($params,&$key){
        $this->sql=new Consultas();
        $query="Insert Into branch ( description,  address, date_register, last_modify, status)"
                        . " Values (:description, :address, now(), now(), :status) ";
        $values=array("description"=>$params['description-branch'],
                      "address"    =>$params['address-branch'],
                      "status"     => Conf::$STATUS_ACTIVO);
        
        return $this->sql->execute($query, $values, $key);
    }
    
    public function updateBranch($params){
        $this->sql=new Consultas();
        $query="Update branch "
                . "Set description=:description, "
                   . " address=:address, "
                   . " last_modify=now() "
              . "Where branch_key=:branch_key ";
        $values=array("description"=>$params['description-branch'],
                      "address"    =>$params['address-branch'],
                      "branch_key" =>$params['branch-key']);
        $key=0;
        return $this->sql->execute($query, $values, $key);
    }
    
    public function deleteBranch($post){
        $this->sql=new Consultas();
        $key=0;
        $query="Delete From branch "
              . "Where branch_key=:branch_key ";
        $values=array("branch_key"=>$post['keybranch']);
        return $this->sql->execute($query, $values, $key);
    }
}
