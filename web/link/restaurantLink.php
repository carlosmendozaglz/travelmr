<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Restaurant.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/RestaurantController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_RESTAURANT_LIST:
                $hc = new RestaurantController();
                $hc->loadGridRestaurant();
                break;
            case Conf::$TRANS_RESTAURANT_NEW:
                $hc = new RestaurantController();
                $post = $_POST;
                $files = $_FILES;
                $hc->newRestaurant($post, $files);
                break;
            case Conf::$TRANS_RESTAURANT_CONSULT:
                $hc = new RestaurantController();
                $post = $_POST;
                $hc->consultRestaurant($post);
                break;
            case Conf::$TRANS_RESTAURANT_UPDATE:
                $hc = new RestaurantController();
                $post = $_POST;
                $files = $_FILES;
                $hc->updateRestaurant($post, $files);
                break;
            case Conf::$TRANS_RESTAURANT_DELETE:
                $hc = new RestaurantController();
                $post = $_POST;
                $hc->deleteRestaurant($post);
                break;
            case Conf::$TRANS_RESTAURANT_OPTION:
                $rc=new RestaurantController();
                $rc->optionsRestaurant();
                break;
            default :
                break;
        endswitch;
    }
}
