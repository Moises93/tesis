<?php
/**
 *
 * User: Moises
 * Date: 05-03-2017
 * Time: 2:14
 */
?>
<section class="content-header">
    <h1>
        Gestion Coordinador
        <small>sispas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Gestion Coordinador</li>
    </ol>
</section>
<center>
    <img  src="<?php echo base_url();?>assets/img/pasante.png"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
</center>


<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#mtoPas" data-toggle="tab">Gestion Coordinador</a></li>
            <li ><a href="#RegistrarP" data-toggle="tab">Nuevo Coordinador</a></li>

        </ul>
        <div class="tab-content">
            <!-- Font Awesome Icons -->
            <div class="tab-pane" id="RegistrarP">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->
                            <div class="box">
                                <!--  <div class="box-header">
                                     <h3 class="box-title">Mantenimiento de Empresas</h3>
                                 </div>
                                 <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="tblProfesores" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Profesor</th>
                                            <th>Escuela</th>
                                            <th>Accion</th>
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
            <div class="tab-pane active" id="mtoPas">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->
                            <div class="box">
                                <!-- <div class="box-header">
                                    <h3 class="box-title">Mantenimiento de Empresas</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="tblCoordinadores" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Coordinador</th>
                                            <th>Escuela</th>
                                            <th>Acci&oacute;n</th>
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

        </div>
    </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>
