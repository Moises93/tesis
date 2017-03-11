<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 04-03-2017
 * Time: 16:59
 */
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Asignar Tutor Organizacional</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="tblAsignarTutorO" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Pasante</th>
                            <th>Escuela</th>
                            <th>Tutor Organizacional</th>
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
<!-- Incio modal -->
<div class="modal fade" id="modalAsignarTutorO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Tutor</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idPasantia">

                    <div class="box-body">
                        <div class="form-group">

                            <label class="col-sm-3 control-label">Organizacion</label></br>
                            <div class="col-sm-9">
                                <input type="text" class="form-control pull-right" id="organizacion" name="" required>
                                <span  id= "organizacion" class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tutor Organizacional</label>
                            <div class="col-sm-9">
                                <select id="cbTutorO" class="form-control" name="cbTutorO" required>
                                    <option value="-1">seleccione:</option>
                                </select>
                                <span  id= "TutorO" class="help-block"></span>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="mbtnUpdTutorO">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Final modal-->
<!-- Incio modal -->
<div class="modal fade" id="modalAsignarTutorOp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Tutor</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idPasantia">

                    <div class="box-body">
                        <div class="form-group">

                            <label class="col-sm-3 control-label">Escuela</label></br>
                            <div class="col-sm-9">
                                <select id="cbEscuela" class="form-control" name="cbEscuela" onchange="cargarTutorOp()" required>
                                    <option value="-1">seleccione:</option>
                                    <option value="1">Computaci&oacute;n</option>
                                    <option value="2">Qu&iacute;mica</option>
                                </select>
                                <span  id= "TutorO" class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tutor Organizacional</label>
                            <div class="col-sm-9">
                                <select id="cbTutorOp" class="form-control" name="cbTutorOp" required>
                                    <option value="-1">seleccione:</option>
                                </select>
                                <span  id= "TutorO" class="help-block"></span>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="mbtnUpdTutorOp">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Final modal-->
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>