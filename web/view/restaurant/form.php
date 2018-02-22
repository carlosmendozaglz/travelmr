<form enctype="multipart/form-data" id="form-restaurant" onsubmit="return false;" action="web/link/restaurantLink.php" method="post">
    <input type="hidden" name="trans" id="trans" value="" />
    
    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Restaurante <span class="glyphicon glyphicon-home"></span></h3>
        </div>
        <div class="box-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Nombre del Restaurante  </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="name-restaurant" name="name-restaurant" type="text" class="form-control name-restaurant capital" >
                </div>
                <!-- /.input group -->
            </div>
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
                <label>Descripci&oacute;n del Restaurante  </label>

                <div class="input-group">
                    <textarea id="description-restaurant" name="description-restaurant" cols="50" class="form-control capital-numbers" ></textarea>
                </div>
                <!-- /.input group -->
            </div>
            <label class="control-label">Imagenes</label>
            <div class="file-loading">
                <input id="input-fr" name="inputfr[]" type="file" >
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <br/>
                    <button class="btn btn-sm btn-danger" id="btn-cancel-restaurant">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-restaurant">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>
            <!-- /.form group -->

            <script>
                $("#input-fr").fileinput({
                    language: "es",
                    uploadUrl: "http://localhost/viajesmr/web/link/restaurantLink.php",
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
            </script>
        </div>
    </div>
</form>