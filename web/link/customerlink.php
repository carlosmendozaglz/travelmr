<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Customer.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/CustomerController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';

print_r($_POST);

$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_CUSTOMER_LIST:
                $cc = new CustomerController();
                $cc->loadGridCustomer();
                break;
            case Conf::$TRANS_CUSTOMER_NEW:
                $cc = new CustomerController();
                $post = $_POST;
                $files = $_FILES;
                $cc->newCustomer($post, $files);
                break;
            case Conf::$TRANS_CUSTOMER_CONSULT:
                $cc = new CustomerController();
                $post = $_POST;
                $cc->consultCustomer($post);
                break;
            case Conf::$TRANS_CUSTOMER_UPDATE:
                $cc = new CustomerController();
                $post = $_POST;
                $files = $_FILES;
                $cc->updateCustomer($post, $files);
                break;
            case Conf::$TRANS_CUSTOMER_DELETE:
                $cc = new CustomerController();
                $post = $_POST;
                $cc->deleteCustomer($post);
                break;
            default :
                break;
        endswitch;
    }
}
