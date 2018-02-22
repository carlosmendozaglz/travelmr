<form enctype="multipart/form-data" id="form-travel" onsubmit="return false;" action="#" method="post">
    <input type="hidden" name="trans" id="trans" value="" />

    <div class="box box-info margin-rigth">
        <div class="box-header">
            <h3 class="box-title">Datos de viaje <span class="fa fa-user"></span></h3>
        </div>
        <div class="box-body">

            <div class="row">

                <div class="col-md-6 form-group">
                    <label>Clave(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input id="key-travel" name="key-travel" class="capital form-control" >
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Lugar(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input id="location" name="location" class="capital form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Descrici&oacute;n(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-terminal"></i>
                        </div>
                        <textarea id="description" name="description" class="capital form-control" ></textarea>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Comentarios(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-comment"></i>
                        </div>
                        <textarea id="notes" name="notes" class="capital form-control" ></textarea>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Fecha Partida(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="date-departure" name="date-departure" class="form-control date" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Hora Partida(*)</label>
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="time-departure" name="time-departure" class="form-control time" >
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Fecha Regreso(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="date-return" name="date-return" class="form-control date" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Hora Regreso(*)</label>
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="time-return" name="time-return" class="form-control time" >
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Precio Adulto(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input id="adult-price" name="adult-price" class="price form-control" >
                    </div>
                </div>               

                <div class="col-md-6 form-group">
                    <label>Precio Menor(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input id="minor-price" name="minor-price" class="price form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Precio Infante(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input id="infant-price" name="infant-price" class="price form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>D&iacute;as(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sun-o"></i>
                        </div>
                        <input id="days" name="days" class="numbers form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Noches(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-moon-o"></i>
                        </div>
                        <input id="nigth" name="nigth" class="numbers form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Restaurante(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cutlery"></i>
                        </div>
                        <select id="restaurant-key" name="restaurant-key" class="capital form-control select2" >
                            <option value=""></option>
                            <optgroup class="content-options"></optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Hotel(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hotel"></i>
                        </div>
                        <select id="hotel-key" name="hotel-key" class="capital form-control select2" >
                            <option value=""></option>
                            <optgroup class="content-options"></optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Aereolínea(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-arrow-circle-o-up"></i>
                        </div>
                        <select id="airline-key" name="airline-key" class="capital form-control select2" >
                            <option value=""></option>
                            <optgroup class="content-options"></optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Último día de pago(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="last-day-pay" name="last-day-pay" class="form-control date" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Porcentaje adelantado(*)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-percent"></i>
                        </div>
                        <input id="percent" name="percent" class="numbers form-control" >
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Millas</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-chain"></i>
                        </div>
                        <input id="miles"  name="miles" class="form-control numbers" >
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Imagenes</label>
                <div class="input-group">
                    <div class="file-loading">
                        <input id="photo" name="photo" type="file" multiple="true" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 text-right">
                    <br/><br/>
                    <button class="btn btn-sm btn-danger bottom" id="btn-cancel-travel">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-sm btn-primary" id="btn-save-travel">Guardar <span class="glyphicon glyphicon-save"></span></button>
                </div>
            </div>
        </div>
    </div>
</form>
