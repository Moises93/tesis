<?php
/**
 * Created by PhpStorm.
 * User: eheredia
 * Date: 06/02/2017
 * Time: 12:41 PM
 */
?>

<section class="content-header">
    <h1>
        Gestion Menu
        <small>sispas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
        <li><a href="#">Menus</a></li>
        <li class="active">Gestion Menu</li>
    </ol>
</section>
<center>
    <img  src="<?php echo base_url();?>assets/img/menu.png"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
</center>


<section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->


                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#fa-icons" data-toggle="tab">Mto. Menus</a></li>
                            <li><a href="#nuevoM" data-toggle="tab">Nuevo Menu</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- Font Awesome Icons -->
                            <div class="tab-pane active" id="fa-icons">

                                       <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Data Table With Full Features</h3>
                                            </div>
                                            <!--  -->
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <form id="fpermisos" method="post">
                                                    <table id="tblMto"  class="table table-bordered table-striped" name="tblPermisos">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>nombre</th>
                                                            <th>padre</th>
                                                            <th>url</th>
                                                            <th>clase</th>
                                                            <th>estatus</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </form>

                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                            </div>
                            <div class="tab-pane" id="nuevoM">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="login" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombreM" name="nombreM">
                                            <span  id= "nombreM" class="help-block"></span>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Padre</label>
                                                <select id="cbPadre" class="form-control" name="padreM">
                                                    <option value="0">seleccione:</option>
                                                </select>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="email" class="control-label">Url</label>
                                            <input type="text" class="form-control" id="url" name="url" placeholder="url">
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="clave" class="control-label">Clase</label>
                                            <input type="text" class="form-control" id="clase" name="clase" placeholder="clase">
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                    <button type="submit" class="btn btn-info pull-right" id="agregarMenu">Agregar</button>

                                </div>
                             </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>



        <!-- /.box-footer -->

            <!-- /.row -->
</section>

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
