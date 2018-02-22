<?php

class BranchController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridBranch(){
        $util=new Util();
        $branch=new Branch();
        $rows=$branch->getListBranch();
        $data="";
        $cont=0;
        foreach ($rows as $branchactual){
            $key           = $branchactual['branch_key'];
            $address       = $branchactual['address'];
            $status        = $branchactual['status'];
            $description   = $branchactual['description'];
            $date_register = $branchactual['date_register'];
            $last_modify   = $branchactual['last_modify'];
            
            $btndelete   ="<a class='btn btn-xs btn-danger delete-branch'><span class='fa fa-remove'></span></a>";
            $btnedit     ="<a class='btn btn-xs btn-primary edit-branch'><span class='fa fa-edit'></span></a>";
            $btncreateas ="<a class='btn btn-xs btn-success createas-branch'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$key' class='row-branch'>"
                        . "<td>$description</td>"
                        . "<td>$address</td>"
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
    
    public function newBranch($post, $files){
        $util=new Util();
        $branch=new Branch();
        $address=$post['address-branch'];
        $description=$post['description-branch'];
        $message="";

        if($util->isLengthValid($description,  Conf::$BRANCH_CAMP_DESCRIPTION, Conf::$BRANCH_CAMP_DESCRIPTION_MAXL, Conf::$BRANCH_CAMP_DESCRIPTION_MINL, $message)  && 
           $util->isLengthValid($address, Conf::$BRANCH_CAMP_ADDRESS, Conf::$BRANCH_CAMP_ADDRESS_MAXL, Conf::$BRANCH_CAMP_ADDRESS_MINL,  $message) && 
           $util->isOnlyText($description, Conf::$BRANCH_CAMP_DESCRIPTION, $message) && 
           $util->isOnlyTextAndNumber($address, Conf::$BRANCH_CAMP_ADDRESS, $message) &&
           $this->notExistBranch($description, 0, $message)){
            $key=0;
            if($branch->saveNewBranch($post, $key)){
                $util->showData(Conf::$FLAG_SUCCESS, "Sucursal guardada.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar la sucursal.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function notExistBranch($description, $branchkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $branch=new Branch();
        $branchac=$util->obj2array(json_decode($branch->getBranchByName($description)));
        
        if(count($branchac)>0){
            $branchnamebd=$branchac['description'];
            $branchkeybd=$branchac['branch_key'];
            if($branchkey!=$branchkeybd){
                $message="La sucursal $branchnamebd ya esta registrada.";
                echo $message;
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultBranch($post){
        $util=new Util();
        $branch=new Branch();
        $cont=0;
        if($util->isOnlyNumber($post['keybranch'])){
            $branchac=  $branch->getBranchByKey($post['keybranch']);
            if($branchac==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                $util->showData(Conf::$FLAG_SUCCESS, "", json_encode($branchac, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function updateBranch($post, $files){
        $util=new Util();
        $branch=new Branch();
        $branchkey=$post['branch-key'];
        $address=$post['address-branch'];
        $description=$post['description-branch'];
        $message="";

        if($util->isLengthValid($description,  Conf::$BRANCH_CAMP_DESCRIPTION, Conf::$BRANCH_CAMP_DESCRIPTION_MAXL, Conf::$BRANCH_CAMP_DESCRIPTION_MINL, $message)  && 
           $util->isLengthValid($address, Conf::$BRANCH_CAMP_ADDRESS, Conf::$BRANCH_CAMP_ADDRESS_MAXL, Conf::$BRANCH_CAMP_ADDRESS_MINL,  $message) && 
           $util->isOnlyText($description, Conf::$BRANCH_CAMP_DESCRIPTION, $message) && 
           $util->isOnlyTextAndNumber($address, Conf::$BRANCH_CAMP_ADDRESS, $message) &&
           $this->notExistBranch($description, 0, $message) &&
           $util->isOnlyNumber($branchkey,'identificador',$message)){
            $key=0;
            if($branch->updateBranch($post) ){
                $util->showData(Conf::$FLAG_SUCCESS, "Sucursal actualizada.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al actualizar la sucursal.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", $message);
        }
    }
    
    public function deleteBranch($post){
        $util=new Util();
        $branch=new Branch();
        $branchkey=$post['keybranch'];
        $message="";

        if($util->isOnlyNumber($branchkey,"",$message)){
            if($branch->deleteBranch($post)){
                $util->showData(Conf::$FLAG_SUCCESS, "Sucursal eliminada.");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "", "La sucursal no se puede eliminar porque tiene registros asociados.");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }
    
    public function optionsBrach(){
        $util=new Util();
        $branch=new Branch();
        $rows=$branch->getListBranch();
        $data="";
        $cont=0;
        foreach ($rows as $branchactual){
            $key           = $branchactual['branch_key'];
            $address       = $branchactual['address'];
            $status        = $branchactual['status'];
            $description   = $branchactual['description'];
            $date_register = $branchactual['date_register'];
            $last_modify   = $branchactual['last_modify'];
            
            
            $data .= "<option value='$key' class='row-branch'>"
                            . "$description -- $address"
                   . "</option>";
            $cont++;
        }
        if($cont==0){
            $data .= "<option value=''>Ning&uacute;n registo encontrado</option>";
        }
        
        $util->showData(Conf::$FLAG_SUCCESS, '', $data);
        
    }
    
}
