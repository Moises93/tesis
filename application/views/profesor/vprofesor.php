<?php
/**
 * User: Moises
 * Date: 15-03-2017
 * Time: 15:06
 */
?>
<section class="content-header">
    <h1>
        Gestion Profesor
        <small>sispas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Gestion Profesor</li>
    </ol>
</section>
<center>
    <img  src="<?php echo base_url();?>assets/img/pasante.png"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
</center>


<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">

            <li class="active"><a href="#mtoPas" data-toggle="tab">Gestion Profesor</a></li>
            <li><a href="#subirCSV" data-toggle="tab">Carga Masiva</a></li>

        </ul>
        <div class="tab-content">
            <!-- Font Awesome Icons -->

            <div class="tab-pane active" id="mtoPas">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Mantenimiento de Profesores</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="tblProfesor" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>profesor</th>
                                            <th>Escuela</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>accion</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>


                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>

            </div>
            <div class="tab-pane " id="subirCSV">
                <h2>Importar Profesores CSV</h2>
                <form method="post" action="<?php echo base_url() ?>cadministrador/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="SUBIR" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<!--incio modal de edicion estudiante -->
<div class="modal fade" id="modalEditProfesor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Tutor</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idProfesor">
                    <input type="hidden" id="idUsuario">
                    <!-- Fin de parametros ocultos -->
                    <div class="box-body">
                        <div class="form-group">

                            <label class="col-sm-3 control-label">Correo</label></br>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
                                <span  id= "correoPro" class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Telefono</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="12" placeholder="xxx-xxxxxxx">
                                <span  class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="actualizarProfesor">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!--incio modal de edicion clave -->
<div class="modal fade" id="modalEditClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nueva Clave</h4>
            </div>

            <div class="modal-body">
                <form id="nuevaClave" class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idUsuarioc">
                    <!-- Fin de parametros ocultos minlength="6"  maxlength="15" -->
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Clave</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="clavee" name="clavee" minlength="6"  >
                                <span  class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Confirmar</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="clavec" name="clavec"  >
                                <span  class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" id="mbtnUpdClave">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>
