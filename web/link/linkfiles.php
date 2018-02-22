<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/User.php';
require_once '../../src/com/ctss/model/Travel.php';
require_once '../../src/com/ctss/model/Model.php';
require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/UserController.php';
require_once '../../src/com/ctss/controller/TravelController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {
        switch ($_POST['trans']):
            case Conf::$TRANS_FILE_UP_PHOTO_USER:
                $post = $_POST;
                $files = $_FILES;
                $uc = new UserController();
                $uc->savePhotoUser($post, $files);
                break;
            case Conf::$TRANS_FILE_UP_PHOTO_TRAVEL:
                $post=$_POST;
                $files=$_FILES;
                $tc=new TravelController();
                $tc->savePhotosTravel($post, $files);
                break;
            case Conf::$TRANS_FILE_DEL_PHOTO_USER:
                $post=$_POST;
                $uc=new UserController();
                $uc->deletePhotoUser($post);
                break;
            case Conf::$TRANS_FILE_DEL_PHOTO_TRAVEL:
                $post=$_POST;
                $tc=new TravelController();
                $tc->deletePhotoTravel($post);
                break;
            default :
                break;
        endswitch;
    }elseif ($_GET['photouser']) {
        $get = $_GET;
        $util->showImg($get, Conf::$TABLE_USER);
    } else {
        exit("Indique el tipo de archivo");
    }
} elseif(isset ($_GET['img'])) {
    $get=$_GET;
    $util=new Util();
    $util->showImg($get);
}else{
    exit("Acceso no autorizado");
}
