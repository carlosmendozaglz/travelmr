<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Travel.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/TravelController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';


$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_TRAVEL_LIST:
                $tc = new TravelController();
                $tc->loadGridTravel();
                break;
            case Conf::$TRANS_TRAVEL_NEW:
                $tc = new TravelController();
                $post = $_POST;
                $files = $_FILES;
                $tc->newTravel($post, $files);
                break;
            case Conf::$TRANS_TRAVEL_CONSULT:
                $tc = new TravelController();
                $post = $_POST;
                $tc->consultTravel($post);
                break;
            case Conf::$TRANS_TRAVEL_UPDATE:
                $tc = new TravelController();
                $post = $_POST;
                $files = $_FILES;
                $tc->updateTravel($post, $files);
                break;
            case Conf::$TRANS_TRAVEL_DELETE:
                $tc = new TravelController();
                $post = $_POST;
                $tc->deleteTravel($post);
                break;
            default :
                break;
        endswitch;
    }
}
