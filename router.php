<?php

require_once 'src/com/ctss/model/Session.php';
require_once 'src/com/ctss/model/Conf.php';
require_once 'src/com/ctss/controller/Util.php';
require_once 'src/com/ctss/model/Model.php';
require_once 'src/com/ctss/dao/Conexion.php';
require_once 'src/com/ctss/dao/Consultas.php';
class Router{
    
    private $view;
    private $util;
    
    function __construct($view="") {
        $this->view=$view;
    }
    
    public function loadView(){
        $this->util = new Util();
        if ($this->util->checkSesionIn(Conf::$FLAG_TRANS_NA) ) :
            if (!$this->util->isOnlyText($this->view)):
                $this->view = Conf::$VIEW_ERROR_404;
            endif;
        else:
            $this->view = Conf::$VIEW_LOGIN;
        endif;
        $this->decodeView();
    }
    
    private function decodeView(){
        switch ($this->view):
            case Conf::$VIEW_USERS:
                include Conf::$VIEW_USERS_URL;
                break;
            case Conf::$VIEW_HOME:
                include Conf::$VIEW_HOME_URL;
                break;
            case Conf::$VIEW_LOGIN:
                include Conf::$VIEW_LOGIN_URL;
                break;
            case Conf::$VIEW_ERROR_404:
                include Conf::$VIEW_ERROR_404_URL;
                break;
            case Conf::$VIEW_ERROR_500:
                include Conf::$VIEW_ERROR_500_URL;
                break;
            case Conf::$VIEW_HOTEL:
                include Conf::$VIEW_HOTEL_URL;
                break;
            case Conf::$VIEW_BRANCH:
                include Conf::$VIEW_BRANCH_URL;
                break;
            case Conf::$VIEW_AIRLINE:
                include Conf::$VIEW_AIRLINE_URL;
                break;
            case Conf::$VIEW_CUSTOMER:
                include Conf::$VIEW_CUSTOMER_URL;
                break;
            case Conf::$VIEW_RESTAURANT:
                include Conf::$VIEW_RESTAURANT_URL;
                break;
            case Conf::$VIEW_DRIVER:
                include Conf::$VIEW_DRIVER_URL;
                break;
            case Conf::$VIEW_TRAVEL:
                include Conf::$VIEW_TRAVEL_URL;
                break;
            case Conf::$VIEW_SALE:
                include Conf::$VIEW_SALE_URL;
                break;
            default :
                Conf::$VIEW_ERROR_500_URL;
                break;
        endswitch;
    }
    
}
