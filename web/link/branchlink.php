<?php

require_once '../../src/com/ctss/model/Session.php';
require_once '../../src/com/ctss/model/Conf.php';
require_once '../../src/com/ctss/model/Branch.php';
require_once '../../src/com/ctss/model/Model.php';

require_once '../../src/com/ctss/controller/Util.php';
require_once '../../src/com/ctss/controller/BranchController.php';

require_once '../../src/com/ctss/dao/Conexion.php';
require_once '../../src/com/ctss/dao/Consultas.php';


$util = new Util();
if (isset($_POST['trans'])) {
    if ($util->checkSesionIn($_POST['trans'])) {

        $transac = $_POST['trans'];

        switch ($transac):
            case Conf::$TRANS_BRANCH_LIST:
                $bc = new BranchController();
                $bc->loadGridBranch();
                break;
            case Conf::$TRANS_BRANCH_NEW:
                $bc = new BranchController();
                $post = $_POST;
                $files = $_FILES;
                $bc->newBranch($post, $files);
                break;
            case Conf::$TRANS_BRANCH_CONSULT:
                $bc = new BranchController();
                $post = $_POST;
                $bc->consultBranch($post);
                break;
            case Conf::$TRANS_BRANCH_UPDATE:
                $bc = new BranchController();
                $post = $_POST;
                $files = $_FILES;
                $bc->updateBranch($post, $files);
                break;
            case Conf::$TRANS_BRANCH_DELETE:
                $bc = new BranchController();
                $post = $_POST;
                $bc->deleteBranch($post);
                break;
            case Conf::$TRANS_BRANCH_OPTION:
                $bc = new BranchController();
                $bc->optionsBrach();
                break;
            default :
                break;
        endswitch;
    }
}
