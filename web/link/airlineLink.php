<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Model.php';
require_once '../../src/com/ctss/model/Airline.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/AirlineController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

$util = new Util();

if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {
        $transac=$_POST['trans'];
        switch ($transac):
            case Conf::$TRANS_AIRLINE_LIST:
                $hc = new AirlineController();
                $hc->loadGridAirline();
                break;
            case Conf::$TRANS_AIRLINE_NEW:
                $hc = new AirlineController();
                $post = $_POST;
                $files = $_FILES;
                $hc->newAirline($post, $files);
                break;
            case Conf::$TRANS_AIRLINE_CONSULT:
                $hc = new AirlineController();
                $post = $_POST;
                $hc->consultAirline($post);
                break;
            case Conf::$TRANS_AIRLINE_UPDATE:
                $hc = new AirlineController();
                $post = $_POST;
                $files = $_FILES;
                $hc->updateAirline($post, $files);
                break;
            case Conf::$TRANS_AIRLINE_DELETE:
                $hc = new AirlineController();
                $post = $_POST;
                $hc->deleteAirline($post);
                break;
            case Conf::$TRANS_AIRLINE_OPTION:
                $ac=new AirlineController();
                $ac->optionsAirline();
                break;
            default :
                break;
        endswitch;
    }
}
