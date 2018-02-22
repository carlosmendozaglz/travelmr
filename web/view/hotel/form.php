<form enctype="multipart/form-data" id="form-hotel" onsubmit="return false;" action="web/link/hotellink.php" method="post">
    <input type="hidden" name="trans" id="trans" value="" />

    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de Hotel <span class="fa fa-home"></span></h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Nombre del Hotel  </label>
                <div class="input-group">
                    <div class="input-group-addon" >
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="name-hotel" name="name-hotel" type="text" class="form-control capital-numbers " >
                </div>
            </div>

            <div class="form-group">
                <label>Descripci&oacute;n del Hotel  </label>

                <div class="input-group">
                    <textarea id="description-hotel" name="description-hotel" cols="50" class="form-control capital-numbers " ></textarea>
                </div>
            </div>
            <label class="control-label">Imagenes</label>
            <div class="file-loading">
                <input id="input-fr" name="inputfr[]" type="file" multiple>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <br/>
                    <button class="btn btn-sm btn-danger" id="btn-cancel-hotel">Cancelar <span class="fa fa-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-hotel">Guardar <span class="fa fa-save"></span></button>
                </div>
            </div>

            <script>
                $("#input-fr").fileinput({
                    language: "es",
                    uploadUrl: "http://localhost/viajesmr/web/link/hotellink.php",
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
            </script>
        </div>
    </div>
</form>