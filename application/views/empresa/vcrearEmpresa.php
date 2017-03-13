<section class="content-header">
    <h1>
        Gestion Empresa
        <small>sispas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Gestion Empresa</li>
    </ol>
</section>
<center>
    <img  src="<?php echo base_url();?>assets/img/empresa.svg"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
</center>
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#RegistrarE" data-toggle="tab">Registro Empresa</a></li>
            <li><a href="#mtoE" data-toggle="tab">mto Empresa</a></li>
            <li><a href="#usuarioE" data-toggle="tab">Usuario Empresa</a></li>
            <li><a href="#mtoUE" data-toggle="tab">mto Usuario Empresa</a></li>
        </ul>
        <div class="tab-content">
            <!-- Font Awesome Icons -->
            <div class="tab-pane active" id="RegistrarE">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registrar Empresa</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form pasanteForm start -->
                        <form form id="register" action="<?=base_url('empresa/registrarEmpresa')?>" role="form" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Rif" class="control-label">Rif</label>
                                            <input class="form-control"  type="text"  id="numregistro" name="numregistro" placeholder="Rif" required>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreE" class="control-label">Nombre</label>
                                            <input class="form-control" type="text"  id="NombreEmpresa" name="NombreEmpresa" placeholder="nombre" required>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombreE" class="control-label">Pais</label>
                                            <select class="form-control " style="width: 100%;" id="paisId" name="paisId" required>
                                                <option value="" selected>Seleccione Pais</option>
                                                <?php foreach($Paises as $row): ?>
                                                    <option value="<?=$row->id?>"><?=$row->paisnombre?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreE" class="control-label">Estado</label>
                                            <select class="form-control " id="estadoId" name="estadoId" required  data-width='100%' >
                                                <option value="" selected>Seleccione Estado</option>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="login" class="control-label">Sector</label>
                                            <input class="form-control" type="text" id="Sector" name="Sector" required/>
                                            <p class="help-block"></p></br>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreE" class="control-label">Ciudad</label>
                                            <input class="form-control" type="text"  id="Ciudad" name="Ciudad" placeholder="Ciudad" required>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="login" class="control-label">Direccion</label>
                                            <input class="form-control" type="text" id="Direccion" name="Direccion" required/>
                                            <p class="help-block"></p></br>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="escuela" class="control-label">Escuela</label>
                                            <select class="form-control select2" multiple="multiple" id="escuelaId" name="escuelaId" style="width: 100%;" required>
                                                <option selected="selected" value="1">Computacion</option>
                                                <option selected="selected" value="2">Quimica</option>
                                                <option selected="selected" value="3">Biologia</option>
                                                <option disabled="disabled">Fisica</option>
                                                <option disabled="disabled">Matematica</option>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="login" class="control-label">Logo</label>
                                            <input type="file" id="empresa_foto" name="empresa_foto" />
                                            <p class="help-block"></p></br>
                                        </div>

                                    </div>
                                    <div class="col-md-6  col-xs-6">
                                        <div class="form-group">
                                            <label for="nombreE" class="control-label">Habilidades</label>
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Habilidad" style="width: 100%;" id="habilidadId" name="habilidadId[]" required>
                                                <?php foreach($Habilidades as $row): ?>
                                                    <option value="<?=$row->id_habilidad?>"><?=$row->descripcion?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4 class="box-title">&nbsp;</h4>
                                            </br>
                                        </div>

                                    </div>

                                </div>

                            </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                        <button  type="buttom" class="btn btn-info pull-right" id="agregarEmpresa">Agregar</button>

                                    </div>
                         </form>
                        <!-- /.box-footer -->
                    </div>

            </div>
            <div class="tab-pane" id="usuarioE">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuario Empresa</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id=""  class="none" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cedula" class="control-label">Cedula</label>
                                        <input class="form-control"  type="text"  id="cedulaUe" name="cedulaUe" placeholder="cedula" required>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group">
                                        <p class="help-block"></p>
                                        <label for="apellido" class="control-label">Apellido</label>
                                        <input class="form-control" type="text"  id="apellidoUe" name="apellidoUe" required>

                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Nombre</label>
                                        <input class="form-control" type="text"  id="nombreUe" name="nombreUe" placeholder="nombre" required>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select id="sexoUe" class="form-control" name="sexoUe" required>
                                            <option value="">seleccione:</option>
                                            <option value="m">Masculino</option>
                                            <option value="f">Femenino</option>
                                        </select>
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="emailUe" name="emailUe" placeholder="Email" required>
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="login" class="control-label">Tipo</label>
                                        <select id="tipoUe" class="form-control" name="tipoUe" required>
                                            <option value="">seleccione:</option>
                                            <option value="1">Tutor</option>
                                        </select>
                                        <p class="help-block"></p>
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <select id="empresaUe" class="form-control" name="empresaUe" required>
                                            <option value="">seleccione:</option>
                                            
                                        </select>
                                    </div>
                                    <h4 class="box-title">&nbsp;</h4>
                                    <div class="form-group">
                                        <h4 class="box-title">&nbsp;</h4>
                                        </br>
                                    </div>




                                </div>


                                <div class="col-md-6">
                                    <h4 class="box-title">Datos de Acceso al Sistema</h4>
                                    <div class="form-group">
                                        <label for="login" class="control-label">Login</label>
                                        <input type="text" class="form-control" id="loginUe" name="loginUe" required>
                                        <p class="help-block"></p>
                                    </div>

                                    <h4 class="box-title">&nbsp;</h4>
                                    <div class="form-group">
                                        <label for="clave" class="control-label">Password</label>
                                        <input type="password" class="form-control" id="claveUe" name="claveUe" placeholder="Password" required>
                                        <p class="help-block"></p>
                                    </div>



                                </div>
                            </div>

                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel onclick="myFunction()"></button>-->
                            <button   class="btn btn-info pull-right" id="agregarUe">Agregar</button>
                        </div>
                    </form>
                    <!-- /.box-footer -->




                </div>


            </div>
            <div class="tab-pane" id="mtoE">
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

                                    <table id="tblEmpresa" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rif</th>
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Direccion</th>
                                            <th>Correo</th>
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
                </section>        <!-- Main content -->
        
                <!-- /.content -->
                <!-- Inicio modal-->
                <div class="modal fade" id="modalEditEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-blue">
                                <button type="button" id="mbtnCerrarModal1" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Persona</h4>
                            </div>

                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <!-- parametros ocultos -->
                                    <input type="hidden" id="idEmpresa">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Rif</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="rifE" class="form-control" id="rifE" value="" >
                                                <span  id= "loginM" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nombre</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nameE" class="form-control" id="nameE" value="" >
                                                <span  id= "nameEM" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Foto</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="fotoE" class="form-control" id="fotoE">
                                                <span  id= "fotoEm" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Correo</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="correoE" class="form-control" id="correoE">
                                                <span  id= "correoM" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="mbtnCerrarModal1" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-info" id="mbtnUpdEmpresa">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modal-->

            </div>
            <div class="tab-pane" id="mtoUE">
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- /.box -->
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Mantenimiento de Usuario Empresa</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">

                                        <table id="tblUsuarioE" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cedula</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Sexo</th>
                                                <th>Tipo</th>
                                                <th>Empresa</th>
                                                <th>ID acceso</th>
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
                <!-- Inicio modal-->
                <div class="modal fade" id="modalEditUsuarioE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-blue">
                                <button type="button" id="mbtnCerrarModalUe" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Usuario Empresa</h4>
                            </div>

                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <!-- parametros ocultos -->
                                    <input type="hidden" id="idUEmpresam">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cedula</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cedulaUem" class="form-control" id="cedulaUem" value="" required>
                                                <span  id= "cedulaUeM" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nombre</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nameUem" class="form-control" id="nameUem" value="" required>
                                                <span  id= "nameUeM" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Apellido</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="apellidoUem" class="form-control" id="apellidoUem" value=""required>
                                                <span  id= "apellidoUeM" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Sexo</label>
                                            <div class="col-sm-9">
                                                <select id="sexoUem" class="form-control" name="sexoUem" required>
                                                    <option value="">seleccione:</option>
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                </select>
                                                <span  id= "sexoUeM" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="mbtnCerrarModalUe" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-info" id="UpdUsuarioEmpresa">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin modal-->


            </div>




        </div>
     </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>