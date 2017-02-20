

<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Gestion Usuarios
				<small>sispas</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Usuarios</a></li>
				<li class="active">gestion usuarios</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<!-- /.box -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Mantenimiento de Usuarios</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">

							<table id="tblUsuarios" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>ID</th>
									<th>tipo</th>
									<th>login</th>
									<th>clave</th>
									<th>estatus</th>
									<th>correo</th>
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
		<!-- /.content -->

<!-- Inicio modal-->
<div class="modal fade" id="modalEditUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">

			<div class="modal-header bg-blue">
				<button type="button" id="mbtnCerrarModal1" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Persona</h4>
			</div>

			<div class="modal-body">
				<form class="form-horizontal">
					<!-- parametros ocultos -->
					<input type="hidden" id="mhdnIdUsuario">

					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Tipo</label>
							<div class="col-sm-9">

								<select id="cbTipo" class="form-control" name="tipo">
									<option value="-1">seleccione:</option>
								</select>
								<span  id= "tipoM" class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Login</label>
							<div class="col-sm-9">
								<input type="text" name="mtxtLogin" class="form-control" id="mtxtLogin" value="" >
								<span  id= "loginM" class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Clave</label>
							<div class="col-sm-9">
								<input type="text" name="mtxtClave" class="form-control" id="mtxtClave">
								<span  id= "claveM" class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Correo</label>
							<div class="col-sm-9">
								<input type="email" name="mtxtCorreo" class="form-control" id="mtxtCorreo">
								<span  id= "correoM" class="help-block"></span>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="mbtnCerrarModal1" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-info" id="mbtnUpdUsuario">Actualizar</button>
			</div>
		</div>
	</div>
</div>

<!-- Final modal-->
<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>	