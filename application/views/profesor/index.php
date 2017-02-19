
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
									<tbody></tbody>
								</table>


						       </div>
						     </div>
						     <div class="tab-pane" id="nuevoP">
						     	<div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label for="login" class="control-label">Cedula</label>
                                            <input type="text" class="form-control" id="cedulaP" placeholder="Cedula" name="cedulaP">
                                            <span  id= "cedulaP" class="help-block"></span>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="login" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombreP" placeholder="Nombre" name="nombreP">
                                            <span  id= "nombreP" class="help-block"></span>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="login" class="control-label">Apellido</label>
                                            <input type="text" class="form-control" id="apellidoP" placeholder="Apellido" name="apellidoP">
                                            <span  id= "apellidoP" class="help-block"></span>
                                        </div>

                                       <!-- <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Padre</label>
                                                <select id="cbPadre" class="form-control" name="padreM">
                                                    <option value="0">seleccione:</option>
                                                </select>

                                            </div>
                                        </div>-->


                                    </div>
                                
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