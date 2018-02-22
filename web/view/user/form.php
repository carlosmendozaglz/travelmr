<form enctype="multipart/form-data" id="form-user" onsubmit="return false;" action="#" method="post">
    <input type="hidden" name="trans" id="trans" value="" />

    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Usuario <span class="fa fa-user"></span></h3>
        </div>
        <div class="box-body">
                       
            <div class="col-md-6 form-group">
                <label>Nombre </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa ion-android-people"></i>
                    </div>
                    <input id="user-name" name="user-name" type="text" class="capital form-control" >
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Usuario </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input id="user" name="user" type="text" class="form-control capital-numbers" >
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Contrase&ntilde;a </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa ion-ios-locked"></i>
                    </div>
                    <input id="password" name="password" type="password" class="form-control" >
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Confirmar Contrase&ntilde;a </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa ion-ios-locked"></i>
                    </div>
                    <input id="password-conf" name="password-conf" type="password" class="form-control" >
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Sucursal</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <select id="branch" name="branch" type="text" class="form-control select2" >
                        <option value=""></option>
                        <optgroup class="content-options"></optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>N&uacute;mero de empleado</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="employee-number" name="employee-number" type="text" class="form-control" readonly >
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Fotografia</label>
                <div class="input-group">
                    <div class="file-loading">
                        <input id="photo" name="photo" type="file" multiple="true" >
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Tipo Usuario</label>
                <div class="input-group">
                    <label>
                        <input type="radio" class="radio" value="SYSTEM" readonly="readonly" name="user-type" id='type-system'/>System &nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                        <input type="radio" class="radio" value='ADMINISTRADOR' name="user-type" id="type-administrador" /> Administrador&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                        <input type="radio" class="radio" value="COLABORADOR" name="user-type" id="type-colaborador" /> Colaborador&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-12 text-right">
                    <br/><br/>
                    <button class="btn btn-sm btn-danger bottom" id="btn-cancel-user">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-user">Guardar <span class="glyphicon glyphicon-save"></span></button>
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
