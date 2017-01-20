<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Data Tables
				<small>advanced tables</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Tables</a></li>
				<li class="active">Data tables</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<!-- /.box -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data Table With Full Features</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
				
							<?php

							    $this->table->set_heading('ID', 'tipo', 'login', 'clave','estatus','correo');
								$tmp = array ( 'table_open'  => '<table id="example1" class="table table-bordered table-striped">' ); //modifica el espaciado
								$this->table->set_template($tmp);
							/*print_r($results);
							exit();*/
							if( !empty($results) ) {

								foreach ($results as $dato):
								  //  print_r($dato); exit();
									$array['id'] = $dato->id_usuario;
									$array['tipo'] = $dato->tipo;
									$array['login'] = $dato->usu_login;
									$array['clave'] = $dato->usu_clave;
									$array['estatus'] = $dato->usu_estatus;
									$array['email'] = mailto($dato->usu_correo, $dato->usu_correo); //esto genera un link con el mismo nombre.
									$this->table->add_row($array); //agregamos la celda a la tabla por cada iteracion
								endforeach;
							}
							// print_r($array); exit();
								echo $this->table->generate(); //cuando termina generamos la tabla a partir del vector

								//echo $this->pagination->create_links();

							?>



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
