<?php

class Util {
    
    function __construct() {
    }
    
    public function isNotNull($text, $input="", &$message=""){
        $valid=true;
        $message="";

        if($text==""){
            $message="El campo $input no puede estar vacio.";
            $valid=false;
        }elseif (!preg_match("/^[0-9a-zA-Z -\/]+$/", $text)){
            $message="El campo contiene caracteres invalidos";
            $valido=false;
        }
        
        return $valid;
    }

    public function isOnlyText($text, $input="",  &$message=""){
        $valid=false;
        $message="El campo $input debe contener solo texto.";
        if (preg_match("/^[a-zA-Z ]+$/", $text)){
            $message="";
            $valid=true;
        }
        return $valid;
    }

    public function isOnlyDate($text, $input="",  &$message="", $null=false){
        $valid=false;
        $message="El campo $input no es una fecha v&aacute;lida [DD/MM/YYYY].";
        if (preg_match("/^\d{1,2}\/\d{1,2}\/\d{4}$/", $text)){
            $message="";
            $valid=true;
        }
        return $valid;
    }

    public function isOnlyTime($text, $input="",  &$message="", $null=false){
        $valid=false;
        $message="El campo $input no es una hora v&aacute;lida [HH:MM].";
        if (preg_match("/^[123456789:]+$/", $text)){
            $message="";
            $valid=true;
        }
        return true;
        return $valid;
    }

    public function isPrice($text, $input="",  &$message="", $null, $negative=false){
        $valid=false;
        $message="El campo $input no es un numero.";
        
        if (preg_match("/^[1-9.-]/", $text)){
            $message="";
            $valid=true;
        }
        return $valid;
    }

    public function isOnlyTextAndNumber($text, $input="",  &$message=""){
        $valido=false;
        $message="El campo $input debe contener solo texto y n&uacute;meros.";
        if (preg_match("/^[0-9a-zA-Z ]+$/", $text)){
            $message="";
            $valido=true;
        }
        return $valido;
    }
    
    public function isOnlyNumber($text, $input="",  &$message=""){
        $valido=false;
        $message="El campo $input debe contener solo texto y n&uacute;meros.";
        if (preg_match("/^[0-9]+$/", $text)){
            $message="";
            $valido=true;
        }
        return $valido;
    }
    
    public function isLengthValid($text, $input="", $max=100, $min=1, &$message="", $null=false){
        $valid=false;
        if($this->isNotNull($text, $input, $message)){
            $message="El campo $input debe tener menos de $max y mas de $min car&aacute;cteres.";
            if(strlen($text)>=$min && strlen($text)<=$max){
                $valid=true;
                $message="";
            }
        }
        return $valid;
    }

    public function checkSesionIn($trans, $redirec=false){
        $enabled=true;
        Session::start();
        $util=new Util();
        if(!Session::issetSession(Conf::$SESS_USER_KEY)){
            $enabled=false;
            $this->showData(Conf::$FLAG_ERROR,"Debes loguearte primero.");
            if($redirec){
                header("Location: index");
            }
            exit('');
        }elseif($trans==Conf::$FLAG_TRANS_NA){
            $enabled==true;
        }
        elseif(!$this->hashPrivilege($trans)){
            $enabled=false;
            $this->showData(Conf::$FLAG_ERROR,"Transacci&oacute;n no autorizada.");        
            if($redirec){
                header("Location: index");
            }

            exit('');
        }
        return $enabled;
    }

    public function checkSesionOut(){
        $enabled=true;
        Session::start();
        if(Session::issetSession(Conf::$SESS_USER_KEY)){
            $enabled=true;
            header("Location: home");
        }
        return $enabled;
    }
    
    public function loadMenu(){
        $model=new Model();
        Session::start();
        $menu="";
        $cont=0;
        $userkey=  Session::getSession(Conf::$SESS_USER_KEY);
        $rowsmenu=$model->getItemsMenu($userkey);
        foreach ($rowsmenu as $currentmenu){
            $module_key=$currentmenu['module_key'];
            $module_des=$currentmenu['module_des'];
            $icon=$currentmenu['icon'];
            $action=$currentmenu['action'];
            $cont++;
            $menu.="<li class=''>
                        <a class='link' data-link='$action' href='#'>
                            <i class='$icon'></i> <span>$module_des</span>
                        </a>
                    </li>";
            
        }
        if($cont==0){
            $menu.="<li class=''>
                        <a class='link' data-link='' href='#'>
                            <i class='$icon'></i> <span>Ning&uacute;n privilegio</span>
                        </a>
                    </li>";
        }
        $this->showUnformatData($menu);
    }
    
    public function hashPrivilege($trans){
        $model=new Model();
        Session::start();
        $existe=false;
        $userkey=  Session::getSession(Conf::$SESS_USER_KEY);
        $parms=array("userkey"=>$userkey,
                     "trans" => $trans);
        $privileges=$model->getPrivilegeByDesc($parms);
        foreach ($privileges as $currentprivilege){
            $existe=true;
            break;
        }
        return true;
        return $existe;
    }

    public function loadHeader(){
        $this->showUnformatData(file_get_contents('web/common/header.php'));
    }
    
    public function loadFooter(){
        $this->showUnformatData(file_get_contents('web/common/footer.php'));
    }

    public function showData($flag=0,$message="",$conten="",$info=""){
        echo Conf::$SEPARATOR.$flag.
             Conf::$SEPARATOR.$message.
             Conf::$SEPARATOR.$conten.
             Conf::$SEPARATOR.$info.
             Conf::$SEPARATOR;
    }

    public function obj2array($obj) {
        $out = array();
        if ($obj != Null) {
            foreach ($obj as $key => $val) {
                switch (true) {
                    case is_object($val):
                        $out[$key] = $this->obj2array($val);
                        break;
                    case is_array($val):
                        $out[$key] = $this->obj2array($val);
                        break;
                    default:
                        $out[$key] = $val;
                }
            }
        }
        return $out;
    }

    public function login($post){
        $model=new Model();
        $message="";
        $existe=false;
        $cont=0;
        $user="";
        $userkey=0;
        $username="";
        $currentuser=null;
        if($this->isOnlyTextAndNumber($post['user'], "usuario", $message) &&
           $this->isNotNull($post['password'], "contraseña", $message)){
            $rows=$model->login($post);
            foreach ($rows as $curuser){
                $currentuser=  $this->obj2array($curuser);
                $cont++;
            }
            
            if($cont==0){
                $this->showData(Conf::$FLAG_ERROR, "Contraseña y usuario invalidos.");
            }elseif ($cont==1) {
                Session::start();
                Session::setSession(Conf::$SESS_USER, $currentuser['user']);
                Session::setSession(Conf::$SESS_USER_KEY, $currentuser['user_key']);
                Session::setSession(Conf::$SESS_USER_NAME, $currentuser['name']);
                Session::setSession(Conf::$SESS_USER_KEY, $currentuser['user_key']);
                Session::setSession(Conf::$SESS_USER_KEY, $currentuser['user_key']);
                Session::setSession(Conf::$SESS_USER_KEY, $currentuser['user_key']);
                $this->showData(Conf::$FLAG_SUCCESS, 'Logueado');
            }else{
                $this->showData(Conf::$FLAG_ERROR, "Usuario duplicado.");
            }
        }else{
            $this->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function isValidPassword($password1, $password2, &$message=""){
        $valid=false;
        if($password1!=$password2){
            $message="Las contraseñas no son iguales";
        }  else {
            $valid=true;
        }
        return $valid;
    }
    
    public function showUnformatData($data=""){
        echo $data;
    }
    
    public function showImg($get) {
        $model = new Model();
        $parms = array("key"   => $get['img'],
                       "table" => $get['type']);
        $file = $model->getFile($parms);
        if (isset($file['file_key'])) {
            $type = $file['file_type'];
            header("Content-Type: $type ");
            echo $file['file_content'];
        }
    }
    
    
    public function getInitialPreview($get) {
        $model = new Model();
        $initialPreview=array();
        $initialPreviewConf=array();
        $parms = array("key"   => $get['img'],
                       "table" => $get['type']);
        $file = $model->getFile($parms);
        if (isset($file['file_key'])) {
            $type = $file['file_type'];
            $key = $get['img'];
            $table=$get['type'];
            $url = Conf::$URL_BASE."web/link/linkfiles?img=$key&type=$table";
            
            $initialPreview=array($url);
            $initialPreviewConf=array("caption"     => "",
                                      "height"      => "120px",
                                      "downloadUrl" => $url,
                                      "url"         => Conf::$LINK_UPLOAD_FILES,
                                      "key"         => $key);
            json_encode($url, JSON_PARTIAL_OUTPUT_ON_ERROR);
        }
        return array("initialPreview"     => $initialPreview,
                     "initialPreviewConf" => $initialPreviewConf);
    }
    
    public function logout(){
        $message="";
        $model=new Model();
        Session::start();
        
        $userkey=  Session::getSession(Conf::$SESS_USER_KEY);
        if($this->isOnlyNumber($userkey, 'identificador', $message)){
            $object=$model->logout($userkey);
            if(isset($object['success'])){
                $succes=$object['success'];
                $message=$object['message'];
                if($succes==1){
                    Session::destroy();
                    $this->showData(Conf::$FLAG_SUCCESS, $message);
                }
                else{
                    $this->showData(Conf::$FLAG_ERROR, $message);
                }
            }
        }else{
            $this->showData(Conf::$FLAG_ERROR, $message);
        }
    }
    
    public function getDataLogin(){
        Session::start();
        $data=array(
            "user"    => Session::getSession(Conf::$SESS_USER),
            "userkey" => Session::getSession(Conf::$SESS_USER_KEY),
            "name"    => Session::getSession(Conf::$SESS_USER_NAME) );
        $this->showData(Conf::$FLAG_SUCCESS, "", json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR));
    }
    
    public function toDateMySql($datein){
        $dateout="";
        $date_parts=  explode("/", $datein);
        $dia=$date_parts[0];
        $mes=$date_parts[1];
        $anio=$date_parts[2];
        $dateout="$anio-$mes-$dia";
        return $dateout;
    }

    public function decodePost($post){
        foreach ($post as $nombre_campo => $valor) {
            echo "$('#$nombre_campo').val(description);";
        }
    }
    
    public function saveFile($post, $files, $key, $table){
        $msg="";
        if (isset($_FILES['photo'])) {
            switch ($_FILES['photo']['error']):
                case 0:
                    $util = new Util();
                    $model = new Model();
                    Session::start();

                    $user = Session::getSession(Conf::$SESS_USER_KEY);
                    $type = $_FILES['photo']['type'];
                    $filename = $_FILES['photo']['name'];
                    $filenametmp = $_FILES['photo']['tmp_name'];
                    $urltmp = "../.." . Conf::$TMP_URL . "$filename";
                    move_uploaded_file($filenametmp, $urltmp);
                    $bytes = file_get_contents($urltmp);
                    
                    if($key=="" || $key==0 || $table==""){
                        $util->showUnformatData("Origen de la imagen no legible.");
                        exit();
                    }

                    $params = array("bytes"      => $bytes,
                                    "type"       => $type,
                                    "filename"   => $filename,
                                    "origen"     => $table,
                                    "user"       => $user,
                                    "tablekeyfk" => $key );

                    if ($model->loadFile($params)) {
                        $util->showUnformatData(json_encode(array("success"=>"Foto subida correctamente.")));
                    }  else {
                        $this->showUnformatData("No se completo el preoceso de subida.");
                    }
                    break;
                case 1:
                    $util->showData(Conf::$FLAG_ERROR, "Error al copiar al subir la imagen.");
                    exit();
                    break;
                case 2:
                    $util->showData(Conf::$FLAG_ERROR, "Error al copiar la imagen.");
                    exit();
                    break;
                case 3:
                    $util->showData(Conf::$FLAG_ERROR, "Error al subir la imagen.");
                    exit();
                    break;
                case 4:
                    $util->showData(Conf::$FLAG_ERROR, "Error al subir la imagen.");
                    exit();
                    break;
                default :
                    $util->showData(Conf::$FLAG_ERROR, "Error al subir la imagen.");
                    exit();
                    break;
            endswitch;
        }
    }
    
    public function deleteImg($params){
        $model=New Model();
        return $model->deleteFiles($params);
    }
    
}
