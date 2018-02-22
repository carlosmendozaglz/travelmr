<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/User.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/UserController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_USER_LIST:
                $uc = new UserController();
                $uc->loadGridUser();
                break;
            case Conf::$TRANS_USER_NEW:
                $uc = new UserController();
                $post = $_POST;
                $files = $_FILES;
                $uc->newUser($post, $files);
                break;
            case Conf::$TRANS_USER_CONSULT:
                $uc = new UserController();
                $post = $_POST;
                $uc->consultUser($post);
                break;
            case Conf::$TRANS_USER_UPDATE:
                $uc = new UserController();
                $post = $_POST;
                $files = $_FILES;
                $uc->updateUser($post, $files);
                break;
            case Conf::$TRANS_USER_DELETE:
                $uc = new UserController();
                $post = $_POST;
                $uc->deleteUser($post);
                break;
            case Conf::$TRANS_USER_ACCESS_MENU:
                $uc = new UserController();
                $post = $_POST;
                $uc->getMenuAccess($post);
                break;
            case Conf::$TRANS_USER_APPLY_PRIV:
                $uc = new UserController();
                $post = $_POST;
                $uc->applyPrivilege($post);
                break;
            default :
                break;
        endswitch;
    }
}
