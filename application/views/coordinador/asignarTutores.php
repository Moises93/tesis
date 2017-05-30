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
                    <h3 class="box-title">Asignar Tutores</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="tblAsignarTutores" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Pasante</th>
                            <th>Escuela</th>
                            <th>Tutor Academico</th>
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
<div class="modal fade" id="modalAsignarTutor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Asignar Tutor</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idPasantia">

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tutor Academico</label>
                            <div class="col-sm-9">
                                <select id="cbTutorA" class="form-control" name="cbTutorA" required>
                                    <option value="-1">seleccione:</option>
                                </select>
                                <span  id= "TutorA" class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="mbtnUpdTutor">Asignar</button>
            </div>
        </div>
    </div>
</div>

<!-- Final modal-->
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>