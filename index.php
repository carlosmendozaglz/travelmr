<?php
require_once './src/com/ctss/model/Session.php';
require_once './src/com/ctss/model/Conf.php';
require_once './src/com/ctss/controller/Util.php';
$util=new Util();
$util->checkSesionOut();
?> 
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'web/common/head.php';
        ?>
    </head>
    <body class="hold-transition login-page">
        <video src="img/mr.mp4" autoplay loop muted poster="poster.png"></video>
        <div class="login-box">
            <div class="login-box-body">
                
            <div class="login-logo">
                <a href="#"><img src="img/logo_travelmr.png" class='img-logo-login'/></a>
            </div>
                <p class="login-box-msg">Iniciar Sesi&oacute;n</p>
                <form onsubmit="return false;" id="form-login" >
                    <input name="trans" id="trans" type="hidden"/>
                    <div class="form-group has-feedback">
                        <input name="user" id="user" class="form-control" autocomplete="false" placeholder="Usuario">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" id="password" type="password" class="form-control" autocomplete="false" placeholder="Contrase&ntilde;a">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <div class="error-message"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php 
        include 'web/common/foot.php';
        ?>
        <script src="js/login.js" ></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>