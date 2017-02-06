<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 01-02-2017
 * Time: 23:25
 */
?>

<!-- <div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Usuario</h3>
        </div> -->
        <!-- /.box-header -->
        <!-- form start -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!--  -->
                        <div class="form-group">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select id="cbTiposu" class="form-control" name="tipo" onchange="cargar_usuarios();">
                                        <option value="">seleccione:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Usuarios</label>
                                    <select id="cbUsuarios" class="form-control" name="user">
                                        <option id="user" value="">seleccione:</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <button id="buscarPermiso" onclick="buscarPermiso()">Buscar</button>

                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="fpermisos" method="post">
                                <table id="tblPermisos"  class="table table-bordered table-striped" name="tblPermisos">
                                    <thead>
                                    <tr>
                                        <th>-</th>
                                        <th>ID</th>
                                        <th>nombre</th>
                                        <th>padre</th>
                                        <th>url</th>
                                        <th>clase</th>
                                        <th>estatus</th>
                                        <th>accion</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <button id="guardarPermiso" onclick="guardarP()">Guardar Permisos</button>
                            </form>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>



<!--   </div>
</div> -->


<!---Inicio modal-->

<div class="modal fade" id="modalEditPermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModalP" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Menu</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idMenu">

                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-9">
                                <input type="text" name="mtxtNombre" class="form-control" id="mtxtNombre">
                                <span  id= "nombreP" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Padre</label>
                            <div class="col-sm-9">
                                <input type="text" name="mtxtPadre" class="form-control" id="mtxtPadre" value="" >
                                <span  id= "padreP" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Url</label>
                            <div class="col-sm-9">
                                <input type="text" name="mtxtUrl" class="form-control" id="mtxtUrl">
                                <span  id= "urlP" class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Clase</label>
                            <div class="col-sm-9">
                                <input type="text" name="mtxtClase" class="form-control" id="mtxtClase">
                                <span  id= "claseP" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModalP" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="mbtnUpdPermiso">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!---Fin modal-->


<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>
