<?php 
     if($message=='ok'):
 ?>
     <script>
              $(document).ready(function(e) {
                 toastr.success('Se han realizado los cambios satisfactoriamente.');
                 }); 
               </script>
                <?php 
                  endif;
                   ?>
                 <?php 
                    if($message=='fail'):
                    ?>
                    <script>
                        $(document).ready(function(e) {
                            toastr.error('Ha ocurrido algún problema realizando los cambios.');
                        });
                    </script>
<?php 
endif;
?>

<!-- Content Header (Page header) -->
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
                 <img  src="<?php echo base_url();?>assets/img/icoprofesor.png"  width=178 HEIGHT=180 BORDER=2 ALT="Obra de K. Haring">
            </center>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="nav-tabs-custom">
					    <ul class="nav nav-tabs">
                            <li class="active"><a href="#fa-icons" data-toggle="tab">Mto. Profesores</a></li>
                            <li><a href="#nuevoP" data-toggle="tab">Nuevo Profesor</a></li>
                        </ul>
                        <div class="tab-content">
							<div class="tab-pane active" id="fa-icons">
							   <div class="box-header">
								 <h3 class="box-title"> Totalidad de Profesores dentro del sistema</h3>
							   </div>
							   <div class="box-body">

								<table id="tblProfesor" class="table table-bordered table-striped">
									<thead>
									<tr>
                                        <th></th>
										<th>ID</th>
										<th>Cedula</th>
										<th>Nombre</th>
										<th>Apellido</th>
										<th>Sexo</th>
										<th>Escuela</th>
										<th>Tipo</th>
										<th>Usuario</th>
									</tr>
									</thead>
                                    <tbody>
                                     <?php foreach($Profesores as $row): ?>
                                         <tr> 
                                                <td></td>
                                                <td class="hidden-xs"><?=$row->pro_id?></td>
                                                <td contenteditable="true" onBlur="saveToDatabase(this,'pro_cedula','<?php echo $row->pro_id; ?>')" onClick="showEdit(this);" class="hidden-xs"><?=$row->pro_cedula?></td>
                                                <td contenteditable="true" onBlur="saveToDatabase(this,'pro_nombre','<?php echo $row->pro_id; ?>')" onClick="showEdit(this);" class="hidden-xs"><?=$row->pro_nombre?></td>
                                                <td contenteditable="true" onBlur="saveToDatabase(this,'pro_apellido','<?php echo $row->pro_id; ?>')" onClick="showEdit(this);" class="hidden-xs"><?=$row->pro_apellido?></td>
                                                <td class="hidden-xs"><?=$row->pro_sexo?></td>
                                                <td class="hidden-xs"><?=$row->esc_nombre?></td>
                                                <td class="hidden-xs"><?=$row->pro_tipo?></td>
                                                <td class="hidden-xs"><?=$row->id_usuario?></td>
                                        </tr>
                                    <?php endforeach; ?>
                        </tbody>
								</table>


						       </div>
						     </div>
						     <div class="tab-pane" id="nuevoP">
						     	<div class="box-body">
						     	<form>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="cedulaP" class="control-label">Cedula</label>
                                            <input type="text" class="form-control" id="cedulaP" placeholder="Cedula" name="cedulaP" required>
                                            <span  id= "cedulaP" class="help-block"></span>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="nombreP" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombreP" placeholder="Nombre" name="nombreP" required>
                                            <span  id= "nombreP" class="help-block"></span>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="apellidoP" class="control-label">Apellido</label>
                                            <input type="text" class="form-control" id="apellidoP" placeholder="Apellido" name="apellidoP" required>
                                            <span  id= "apellidoP" class="help-block"></span>
                                        </div>
                                         <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select id="sexo" class="form-control" name="sexo">
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>

                                            </div>
                                         </div>
                                         <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Escuela</label>
                                                <select id="escuela" class="form-control" name="escuela">
                                                    <option value="1">Computacion</option>
                                                </select>

                                            </div>
                                         </div>
                                         <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Tipo Profesor</label>
                                                <select id="tProfesor" class="form-control" name="tProfesor">
                                                </select>

                                            </div>
                                         </div>
                                        <div class="col-sm-5">
                                            <label for="emailP" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="emailP" placeholder="direccion de correo electronio" name="emailP" required>
                                            <span  id= "apellidoP" class="help-block"></span>
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                     <div class="form-group">
                                        <div class="col-sm-10">
                                     <center><h3>Ingrese Datos de Acceso</h3></center>
                                     </div>
                                     </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="loginP" class="control-label">Login</label>
                                            <input type="text" class="form-control" id="loginP" placeholder="login" name="loginP" required>
                                            <span  id= "loginP" class="help-block"></span>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="pswP" class="control-label">Password</label>
                                            <input type="password" class="form-control" id="pswP" placeholder="contraseña" name="pswP" required>
                                            <span  id= "pswP" class="help-block"></span>
                                        </div>
                                    </div>
                                        <div class="col-sm-10">
                                     <div class="box-footer">
                                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                    <button type="submit" class="btn btn-info pull-right" id="agregarProfesor">Agregar</button>

                                      </div>
                                      </div>
                                </form>
                                </div>
                                
                             </div>
						      
					    </div>
					 </div> 
				</div>
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
<!-- Final modal-->
<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>	