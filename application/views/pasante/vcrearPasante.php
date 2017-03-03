<section class="content-header">
    <h1>
        Gestion Estudiante
        <small>sispas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Gestion Estudiante</li>
    </ol>
</section>
<center>
    <img  src="<?php echo base_url();?>assets/img/pasante.png"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
</center>


<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#RegistrarP" data-toggle="tab">Registrar Estudiante</a></li>
            <li><a href="#mtoPas" data-toggle="tab">Gestion Estudiante</a></li>
            <li><a href="#subirCSV" data-toggle="tab">Carga Masiva</a></li>

        </ul>
        <div class="tab-content">
            <!-- Font Awesome Icons -->
            <div class="tab-pane active" id="RegistrarP">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nuevo Estudiante</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="pasanteForm"  class="" action="none">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cedula" class="control-label">Cedula</label>
                                            <input class="form-control"  type="text"  id="cedula" name="cedula" placeholder="cedula" required>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <p class="help-block"></p>
                                            <label for="apellido" class="control-label">Apellido</label>
                                            <input class="form-control" type="text"  id="apellido" name="apellido" required>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre" class="control-label">Nombre</label>
                                            <input class="form-control" type="text"  id="nombre" name="nombre" placeholder="nombre" required>
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <select id="sexo" class="form-control" name="sexo" >
                                                <option value="">seleccione:</option>
                                                <option value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            </select>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                            <p class="help-block"></p>
                                        </div>
                                        <h4 class="box-title">Datos de Acceso al Sistema</h4>
                                        <div class="form-group">
                                            <label for="login" class="control-label">Usuario</label>
                                            <input type="text" class="form-control" id="login" name="login">
                                            <p class="help-block"></p>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Escuela</label>
                                            <select id="escuela" class="form-control" name="escuela" >
                                                <option value="">seleccione:</option>
                                                <option value="1">Computaciòn</option>
                                            </select>
                                        </div>
                                        <h4 class="box-title">&nbsp;</h4>
                                        <div class="form-group">
                                            <label for="clave" class="control-label">Clave</label>
                                            <input type="password" class="form-control" id="clave" name="clave" placeholder="clave">
                                            <p class="help-block"></p>
                                        </div>



                                    </div>
                                </div>

                            </div>

                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                        <button  class="btn btn-info pull-right" id="agregarPasante">Agregar</button>
                                    </div>
                         </form>
                        <!-- /.box-footer -->

                    </div>
            </div>
            <div class="tab-pane " id="mtoPas">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Mantenimiento de Empresas</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="tblPasantes" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Sexo</th>
                                            <th>Escuela</th>
                                            <th>Correo</th>
                                            <th>Login</th>
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
                <h2>Importar Estudiantes CSV</h2>
                <form method="post" action="<?php echo base_url() ?>cadministrador/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="SUBIR" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>