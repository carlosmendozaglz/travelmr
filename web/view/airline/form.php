<form enctype="multipart/form-data" id="form-airline" onsubmit="return false;" action="web/link/airlinelink.php" method="post">
    <input type="hidden" name="trans" id="trans" value="" />
    
    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Aereolínea <span class="glyphicon glyphicon-home "></span></h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Nombre del Aereolínea  </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="name-airline" name="name-airline" type="text" class="form-control capital" >
                </div>
            </div>

            <div class="form-group">
                <label>Descripci&oacute;n del aereolínea  </label>

                <div class="input-group">
                    <textarea id="description-airline" name="description-airline" cols="50" class="form-control capital-numbers" ></textarea>
                </div>
            </div>
            <label class="control-label">Imagenes</label>
            <div class="file-loading">
                <input id="input-fr" name="inputfr[]" type="file" >
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <br/>
                    <button class="btn btn-sm btn-danger" id="btn-cancel-airline">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-airline">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>

            <script>
                $("#input-fr").fileinput({
                    language: "es",
                    uploadUrl: "http://localhost/viajesmr/web/link/airlineLink.php",
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
            </script>
        </div>
    </div>
</form>