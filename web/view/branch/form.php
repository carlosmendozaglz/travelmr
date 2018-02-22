<form enctype="multipart/form-data" id="form-branch" onsubmit="return false;" >
    <input type="hidden" name="trans" id="trans" value="" />
    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de la Sucursal <span class="glyphicon glyphicon-home"></span></h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Descripci&oacute;n de sucursal</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="description-branch" name="description-branch" type="text" class="form-control capital-numbers" >
                </div>
            </div>
            <div class="form-group">
                <label>Direcci&oacute;n </label>
                <div class="input-group">
                    <textarea id="address-branch" name="address-branch" cols="50" class="form-control capital-numbers" ></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <br/>
                    <button class="btn btn-sm btn-danger" id="btn-cancel-branch">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-branch">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>
        </div>
    </div>
</form>