<form enctype="multipart/form-data" id="form-customer" onsubmit="return false;" action="#" method="post">
    <input type="hidden" name="trans" id="trans" value="" />

    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Cliente <span class="fa fa-user"></span></h3>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nombre </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa ion-person"></i>
                        </div>
                        <input id="customer-name" name="customer-name" type="text" class="capital form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Fecha Nacimiento</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa ion-calendar"></i>
                        </div>
                        <input id="birthdate" name="birthdate" type="text" class="form-control date" >
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Genero </label>
                    <div class="input-group">
                        <label>
                            <input type="radio" class="radio" value='MASCULINO' name="gender" id="gender-masculino" /> MASCULINO&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <label>
                            <input type="radio" class="radio" value="FEMENINO" name="gender" id="gender-femenino" /> FEMENINO&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                    </div>
                </div>


                <div class="col-md-6 form-group">
                    <label>Direcci&oacute;n </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa ion-map"></i>
                        </div>
                        <input id="customer-address" name="customer-address" type="text" class="form-control capital-numbers" >
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Telefono</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input id="customer-phone" name="customer-phone" type="text" class="form-control phone-mask" />
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Millas</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input id="customer-miles"  name="customer-miles" type="text" class="form-control numbers" readonly >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right">
                    <br/><br/><br/><br/>
                    <button class="btn btn-sm btn-danger bottom" id="btn-cancel-customer">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-customer">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>
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