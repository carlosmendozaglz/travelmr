<form enctype="multipart/form-data" id="form-driver" onsubmit="return false;" action="web/link/driverLink.php" method="post">
    <input type="hidden" name="trans" id="trans" value="" />

    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Conductor</h3>
        </div>
        <div class="box-body"

             <div class="row">
                <div class="col-md-12 form-group">
                    <label>Nombre del Conductor </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <input id="name" name="name" type="text" class="form-control capital">
                    </div>
                    <!-- /.input group -->
                </div>


                <div class="col-md-12 form-group">
                    <label>Genero (*)</label>
                    <div class="input-group">
                        <label>
                            <input type="radio" class="radio" value='MASCULINO' name="gender" id="gender-masculino" /> MASCULINO&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <label>
                            <input type="radio" class="radio" value="FEMENINO" name="gender" id="gender-femenino" /> FEMENINO&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <label>Número celular(*):</label>
                    <input type="text" class="form-control phone-mask" name="phoneNumber" id="phoneNumber" >  
                </div> 

                <div class="col-md-12 form-group">
                    <label>Interno(*):</label>
                    <input type="text" class="form-control capital" name="interno" id="interno" >  
                </div> 

                <div class="col-md-12 form-group">
                    <label>Certificación(*):</label>
                    <input type="text" class="form-control capital" name="certification" id="certification" >  
                </div> 

                <div class="col-md-12 form-group">
                    <label>Licencia de conducir(*):</label>
                    <input type="text" class="form-control" name="licence" id="licence" >  
                </div>

                <div class="col-md-12 text-right">
                    <br/>
                    <button class="btn btn-sm btn-danger" id="btn-cancel-driver">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-driver">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>
            <!-- /.form group -->
        </div>
    </div>
</form>
<script>
    $(function () {
        $('.radio').iCheck({
            checkboxClass: 'iradio_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
