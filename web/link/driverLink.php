<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Model.php';
require_once '../../src/com/ctss/model/Driver.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/DriverController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';


$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_DRIVER_LIST:
                $hc = new DriverController();
                $hc->loadGridDriver();
                break;
            case Conf::$TRANS_DRIVER_NEW:
                $hc = new DriverController();
                $post = $_POST;
                $files = $_FILES;
                $hc->newDriver($post, $files);
                break;
            case Conf::$TRANS_DRIVER_CONSULT:
                $hc = new DriverController();
                $post = $_POST;
                $hc->consultDriver($post);
                break;
            case Conf::$TRANS_DRIVER_UPDATE:
                $hc = new DriverController();
                $post = $_POST;
                $files = $_FILES;
                $hc->updateDriver($post, $files);
                break;
            case Conf::$TRANS_DRIVER_DELETE:
                $hc = new DriverController();
                $post = $_POST;
                $hc->deleteDriver($post);
                break;
            default :
                break;
        endswitch;
    }
}
