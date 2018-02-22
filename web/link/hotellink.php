<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Hotel.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/HotelController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';


$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_HOTEL_LIST:
                $hc = new HotelController();
                $hc->loadGridHotel();
                break;
            case Conf::$TRANS_HOTEL_NEW:
                $hc = new HotelController();
                $post = $_POST;
                $files = $_FILES;
                $hc->newHotel($post, $files);
                break;
            case Conf::$TRANS_HOTEL_CONSULT:
                $hc = new HotelController();
                $post = $_POST;
                $hc->consultHotel($post);
                break;
            case Conf::$TRANS_HOTEL_UPDATE:
                $hc = new HotelController();
                $post = $_POST;
                $files = $_FILES;
                $hc->updateHotel($post, $files);
                break;
            case Conf::$TRANS_HOTEL_DELETE:
                $hc = new HotelController();
                $post = $_POST;
                $hc->deleteHotel($post);
                break;
            case Conf::$TRANS_HOTEL_OPTION:
                $hc=new HotelController();
                $hc->optionsHotel();
                break;
            default :
                break;
        endswitch;
    }
}
