<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Hotel.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/HotelController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

require_once '../../router.php';

if (isset($_POST['trans'])) {
    $util = new Util();
    $transac = $_POST['trans'];
    switch ($transac):
        case Conf::$TRANS_LOGIN:
            if ($util->checkSesionOut(Conf::$FLAG_TRANS_NA)) {
                $post = $_POST;
                $util->login($post);
            }
            break;
        case Conf::$TRANS_LOAD_VIEW:
            if ($util->checkSesionIn(Conf::$FLAG_TRANS_NA)) {

                $view = $_POST['view'];
                $router = new Router($view);
                $router->loadView();
            }
            break;
            case Conf::$TRANS_LOGOUT:
                $util->logout();
                break;
        case Conf::$TRANS_GET_LOGIN_DATA:
            if ($util->checkSesionIn(Conf::$FLAG_TRANS_NA)) {
                $util->getDataLogin();
            }
            break;
        default :
            break;
    endswitch;
}
