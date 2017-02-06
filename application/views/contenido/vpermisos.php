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



<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>
