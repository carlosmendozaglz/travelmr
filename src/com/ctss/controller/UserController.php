<?php

class UserController {
    
    public function __construct() {
    }
    
    public function __destruct() {
    }
    
    public function loadGridUser(){
        $util=new Util();
        $user=new User();
        $rows=$user->getListUser();
        $data="";
        $cont=0;
        echo "hola mundo";
        foreach ($rows as $usuariactual){
            $key           = $usuariactual['user_key'];
            $type          = $usuariactual['type'];
            $name          = $usuariactual['name'];
            $user          = $usuariactual['user'];
            $date_register = $usuariactual['date_register'];
            $last_modify   = $usuariactual['last_modify'];
            $status        = $usuariactual['status'];
            $branch_key    = $usuariactual['branch_key'];
            $branch        = $usuariactual['branch'];
            $no_employe    = $usuariactual['no_employe'];
            
            $table=  Conf::$TABLE_USER;
            $photo       = "<img class='img-preview-table' src='http://localhost/viajesmr/web/link/linkfiles?img=$key&type=$table' />";
            $btnaccess   = "<a class='btn btn-xs btn-info access-user' ><span class='fa fa-unlock'></span></a>";
            $btndelete   = "<a class='btn btn-xs btn-danger delete-user'><span class='fa fa-remove'></span></a>";
            $btnedit     = "<a class='btn btn-xs btn-primary edit-user'><span class='fa fa-edit'></span></a>";
            $btncreateas = "<a class='btn btn-xs btn-success createas-user'><span class='fa fa-copy'></span></a>";
            
            $data .= "<tr data-key='$key' class='row-hotel'>"
                        . "<td>$no_employe</td>"
                        . "<td>$name</td>"
                        . "<td>$user</td>"
                        . "<td>$branch</td>"
                        . "<td>$photo</td>"
                        . "<td class='text-center'>$btnaccess</td>"
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
    
    public function newUser($post, $files){
        $util=new Util();
        $user=new User();
        Session::start();
        $name=$post['user-name'];
        $username=$post['user'];
        $password=$post['password'];
        $paswordconf=$post['password-conf'];
        $branch=$post['branch'];
        $usertype=$post['user-type'];
        $message="";

        if($util->isLengthValid($name,  Conf::$USER_CAMP_NAME, Conf::$USER_CAMP_NAME_MAXL, Conf::$USER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($username, Conf::$USER_CAMP_USER, Conf::$USER_CAMP_USER_MAXL, Conf::$USER_CAMP_USER_MINL,  $message) && 
           $util->isOnlyText($name, Conf::$USER_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($username, Conf::$USER_CAMP_USER, $message) &&
           $util->isValidPassword($password, $paswordconf, $message) &&
           $util->isNotNull($branch, Conf::$USER_CAMP_BRANCH, $message) &&
           $util->isNotNull($usertype, Conf::$USER_CAMP_TYPE_USER, $message) &&
           $this->notExistUser($username, 0, $message)){
            $key=0;
            $datos_nuevos=array("type"       => $usertype,
                                "status"     => Conf::$STATUS_ACTIVO,
                                "no_employe" => 0);
            $post=array_merge($datos_nuevos, $post);
            if($user->saveNewUser($post, $key)){
                Session::setSession(Conf::$SESS_TABLE_KEY_TMP, $key);
                $util->showData(Conf::$FLAG_SUCCESS, "Usuario guardado. ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el hotel. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function notExistUser($username, $userkey, &$message){
        $message="";
        $exist=true;
        $util=new Util();
        $user=new User();
        $userac=  $user->getUserByUsername($username);
        if(isset($userac['user'])){
            $usernamebd=$userac['user'];
            $userkeybd=$userac['user_key'];
            if($userkey!=$userkeybd){
                $message="El usuario $username ya esta registrado.";
                $exist=false;
            }
        }
        return $exist;
    }
    
    public function consultUser($post){
        $util=new Util();
        $user=new User();
        $model=new Model();
        Session::start();

        $cont=0;
        $keyuser=$post['keyuser'];
        if($util->isOnlyNumber($keyuser)){
            $useract=  $user->getUserByKey($keyuser);
            if($useract==Null){
                $util->showData(Conf::$FLAG_ERROR, "", 'No se encontro el registro.');
            }else{
                Session::setSession(Conf::$SESS_TABLE_KEY_TMP, $keyuser);
                $get=array("img"  => $keyuser ,
                           "type" => Conf::$TABLE_USER );
                $preview=$util->getInitialPreview($get);
                $useract=  array_merge($preview, $useract);
                
                $util->showData(Conf::$FLAG_SUCCESS, "",json_encode($useract, JSON_PARTIAL_OUTPUT_ON_ERROR));
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, "", 'No se recibio respuesta.');
        }
    }
    
    public function isUserAdmin($userkey){
        $isadmin=false;
        $util=new Util();
        $user=new User();
        $admin=  Conf::$USER_TYPE_ADMIN;
        $cond=" and type='$admin'";
        $useract=$user->getUserByKey($userkey, $cond);
        if(isset($useract['user'])){
            $isadmin=true;
        }
        return $isadmin;
    }

    public function updateUser($post, $files){

        $util=new Util();
        $user=new User();
        Session::start();
        $name=$post['user-name'];
        $username=$post['user'];
        $branch=$post['branch'];
        $userkey=$post['user-key'];
        $usertype=$post['user-type'];
        $message="";

        if($util->isOnlyNumber($userkey, "", $message) &&
           $util->isLengthValid($name,  Conf::$USER_CAMP_NAME, Conf::$USER_CAMP_NAME_MAXL, Conf::$USER_CAMP_NAME_MINL, $message)  && 
           $util->isLengthValid($username, Conf::$USER_CAMP_USER, Conf::$USER_CAMP_USER_MAXL, Conf::$USER_CAMP_USER_MINL,  $message) && 
           $util->isOnlyText($name, Conf::$USER_CAMP_NAME, $message) && 
           $util->isOnlyTextAndNumber($username, Conf::$USER_CAMP_USER, $message) &&
           $util->isNotNull($branch, Conf::$USER_CAMP_BRANCH, $message) &&
           $util->isNotNull($usertype, Conf::$USER_CAMP_TYPE_USER, $message) &&
           $this->notExistUser($username, $userkey, $message)){
            $key=0;
            $datos_nuevos=array("type"       => $usertype,
                                "status"     => Conf::$STATUS_ACTIVO,
                                "no_employe" => 0);
            $post=array_merge($datos_nuevos, $post);
            if($user->updateUser($post, $key)){
                Session::setSession(Conf::$SESS_TABLE_KEY_TMP, $key);
                $util->showData(Conf::$FLAG_SUCCESS, "Usuario guardado. ");
            }else{
                $util->showData(Conf::$FLAG_ERROR, "Ocurrio un error al guardar el hotel. $key ");
            }
        }else{
            $util->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function deleteUser($post){
        $util=new Util();
        $user=new User();
        $model=new Model();
        $userkey=$post['userkey'];
        $message="";
        if($util->isOnlyNumber($userkey, "", $message)) {
            if (!$this->isUserAdmin($userkey)) {
                if ($user->deleteUser($post)) {
                    $delete = $parmsdeletefiles = array("table" => Conf::$TABLE_USER,
                                                        "key" => $post['userkey']);
                    $model->deleteFiles($parmsdeletefiles);
                    $util->showData(Conf::$FLAG_SUCCESS, "Usuario eliminado.");
                } else {
                    $util->showData(Conf::$FLAG_ERROR, "", "El usuario no se puede eliminar porque tiene registros asociados.");
                }
            }else{
                $util->showData(Conf::$FLAG_ERROR, "No se puede eliminar este usuario");
            }
        } else {
            $util->showData(Conf::$FLAG_ERROR, "", "Identificador inv&aacute;lido.");
        }
    }

    public function savePhotoUser($post, $files) {
        $msg="";
        $util=new Util();
        Session::start();
        if(!Session::issetSession(Conf::$SESS_TABLE_KEY_TMP)){
            $util->showData(Conf::$FLAG_ERROR, "Origen de la imagen no legible.");
            exit();
        }
        $key=  Session::getSession(Conf::$SESS_TABLE_KEY_TMP);
        $util->saveFile($post, $files, $key, Conf::$TABLE_USER);
        Session::unsetSession(Conf::$SESS_TABLE_KEY_TMP);
    }
    
    public function deletePhotoUser($post){
        $util=new Util();
        $params=array("key"   => $post['key'],
                      "table" => Conf::$TABLE_USER);
        if($util->deleteImg($params)){
            $util->showUnformatData(json_encode(array("success"=>"Imagen eliminada.")));
        }else{
            $util->showUnformatData("No se a podido eliminar la imagen");
        }
    }

    public function getMenuAccess($post){
        $util=new Util();
        $model=new Model();
        $user=new User();
        $modules=$model->getModules();
        
        $userkey=$post['user_key'];
        $data="";
        $dataenc="";
        $datadet="";
        $moduleant=0;
        $moduleact=0;
        $cont=0;
        $menu_key=0;
        
        $privileges=$user->getUserPrivileges($userkey);

        Session::start();
        Session::setSession(Conf::$SESS_PRIVILEGES, $privileges);

        foreach ($modules as $currentmodule) {
            $datadet="";
            $modulekey=$currentmodule['module_key'];
            $module=$currentmodule['module_des'];
            $icon=$currentmodule['icon'];
            $datadet=  $this->getItemsModule($modulekey);
            $acordion="accordion-$cont";
            $collapse="colapse-$cont";
            $active="";
                        
            if($cont>0){
                $active="collapse";
            }
            $dataenc.="<div class='col-md-4'>
                            <div class='bs-example'>
                                <div class='panel-group' id='$acordion'>
                                    <div class='panel panel-default'>
                                        <a data-toggle='collapse' class='' data-parent='#$acordion' href='#$collapse'>
                                            <div class='panel-heading'>
                                                <h4 class='panel-title'>
                                                    <span class='$icon'></span> $module
                                                </h4>
                                            </div>
                                        </a>
                                        <div id='$collapse' class='panel-collapse $active'>
                                            <div class='panel-bod'>
                                                <ul class='nav nav-pills nav-stacked'>
                                                    $datadet
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
            $cont++;
        }
        if($cont==0){
            $dataenc="<h1>Ning&uacute;n moudlo encontrado</h1>";
        }
        Session::unsetSession(Conf::$SESS_PRIVILEGES);
        $util->showData(Conf::$FLAG_SUCCESS, "", $dataenc);
    }
    
    public function findPrivilege($menukey){
        $util = new Util();
        
        Session::start();
        $privileges=  Session::getSession(Conf::$SESS_PRIVILEGES);
        $existe=false;
        
        foreach ($privileges as $currentprivilege){
            $currentmenu=$currentprivilege['menu_key'];
            if($currentmenu==$menukey){
                $existe=true;
                break;
            }
        }
        
        return $existe;
    }

    public function getItemsModule($modulekey){
        $util=new Util();
        $model=new Model();
        $itemsmodule= $model->getItemsModuleByModuleKey($modulekey);
        $data="";
        $cont=0;
        foreach ($itemsmodule as $currentitem) {
            $menu_key=$currentitem['menu_key'];
            $type=$currentitem['type'];
            $icon=$currentitem['icon'];
            $label=$currentitem['label'];
            $link=$currentitem['link'];
            $function=$currentitem['function'];
            $visible=$currentitem['visible'];
            $parent_key=$currentitem['parent_key'];
            $transaction=$currentitem['transaction'];
            $module_key=$currentitem['module_key'];
            $sequence=$currentitem['sequence'];
            $class='';
            if($this->findPrivilege($menu_key)){
                $class="btn-info";
            }
            $data.="<li class='apply-privilege'><a href='#' data-item='$menu_key' class='btn-sm $class'><span class='$icon'></span> $label </a></li>";
            $cont++;
        }
        if($cont==0){
            $data="<li><a href='#' class='btn-sm'><span class='fa fa-list'></span> Sin datos </a></li>";
        }
        return $data;
    }
    
    public function applyPrivilege($post) {
        $util = new Util();
        $user = new User();
        $model = new Model();

        $userkey = $post['userkey'];
        $item = $post['item'];
        $aplicado=0;
        $message="";
        $apply=false;
        if ($util->isOnlyNumber($userkey, "", $message) &&
                $util->isOnlyNumber($item, "", $message)) {

            if (!$this->existPrivilege($post)) {
                echo "Insertar ";
                $apply = $model->insertPrivilege($post);
                $aplicado=1;
            } else {
                echo "Eliminar";
                $apply = $model->deletePrivilege($post);
                $aplicado=0;
            }
            if ($apply) {
                $util->showData(Conf::$FLAG_SUCCESS, "Privilegio aplicado.",$aplicado);
            } else {
                $util->showData(Conf::$FLAG_ERROR, "Error al actualizar el permiso.");
            }
        } else {
            $util->showData(Conf::$FLAG_ERROR, "Identificador invalido.");
        }
    }
    
    public function existPrivilege($params){
        $util = new Util();
        $user = new User();
        $model = new Model();
        $privilege=$model->getPrivilege($params);
        $existe=false;
        foreach ($privilege as $currentprivilege){
            $existe=true;
            break;
        }
        return $existe;
    }

}
