<?php
require_once 'router.php';
$util = new Util();

$util->checkSesionIn(Conf::$FLAG_TRANS_NA, true);
?>  
<!DOCTYPE html>
<html>
    <head>
        <?php
        include './web/common/head.php';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onresize="setHeight()" id="body">
        <div class="wrapper">

            <header class="main-header">
                <?php $util->loadHeader(); ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Carlos Mendoza</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MEN&Uacute; PRINCIPAL</li>
                        <?php $util->loadMenu(); ?>
                    </ul>
                </section>
            </aside>
            <div id="main-content"></div>

            <footer class="main-footer">
                <?php $util->loadFooter(); ?>
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
            <?php include 'web/common/foot.php'; ?>
            <div class="control-sidebar-bg "></div>
        </div>
        <div class="content-loading-img"><img src="img/loading-bar.gif" /></div>
    </body>
</html>