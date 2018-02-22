<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Conductores.
            <small>Listado de Conductores.</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <button id="btn-new" class="btn btn-block btn-primary btn-new-driver">Nuevo Registro <span class="glyphicon glyphicon-user"></span></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12 content-table">
                                <table class="table table-bordered table-hover table-responsive table-condensed"  id="table-driver">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Genero</th>
                                            <th>Teléfono</th>
                                            <th>Licencia</th>
                                            <th>Certificado</th>
                                            <th>Eliminar</th>
                                            <th>Editar</th>
                                            <th>Crear como</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-5 content-form hide" id="content-form-driver">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<script src="js/scriptDriver.js"></script>
