
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
					<div class="box">
						<div class="box-header">
							<h3 class="box-title"> Totalidad de Profesores dentro del sistema</h3>
						</div>
						<!-- /.box-header -->
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
						<!-- /.box-body -->
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