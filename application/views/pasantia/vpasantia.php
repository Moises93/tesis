<?php
/**
 * User: Moises
 * Date: 28-02-2017
 * Time: 12:02
 */
?>
<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
Gestion Pasantias
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
                            <li class="active"><a href="#fa-icons" data-toggle="tab">Mto. Pasant&iacute;a</a></li>
                            <li><a href="#nuevoP" data-toggle="tab">Nueva Pasant&iacute;a</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="fa-icons">
                                       <div class="box-header">
                                         <h3 class="box-title"> Totalidad de Pasan&iacute;as dentro del sistema</h3>
                                       </div>
                                       <div class="box-body">
        
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Estatus</th>
                                                <th>Pasante</th>
                                                <th>fechaIni</th>
                                                <th>fechaFin</th>
                                                <th>modalidad</th>
                                                <th>Empresa</th>
                                                <th>Tutor Empresarial</th>
                                                <th>Escuela</th>
                                                <th>Tutor Academico</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
        
        
                                       </div>
                            </div>
                            
                            
                            <div class="tab-pane" id="nuevoP">
						     	<div class="box-body">
                                    <form class="none">
                                        <div class="form-group">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Duracion Pasant&iacute;a:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="reservation" required>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">

                                                        <label  class="control-label">Modalidad</label>
                                                            <select id="modalidad" class="form-control" name="modalidad" required>
                                                                <option value="-1">seleccione:</option>
                                                                <option value="Tiempo-completo">Tiempo completo</option>
                                                                <option value="Medio-Tiempo">Medio Tiempo</option>
                                                            </select>
                                                        <span  id= "nombreP" class="help-block"></span>

                                                    <!-- /.nput group -->
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <label >Empresa</label>
                                                <select id="cbEmpresa" class="form-control" name="cbEmpresa" onchange="cargarTutorE();" required>
                                                    <option value="">seleccione:</option>
                                                </select>
                                                <span  id= "nombreP" class="help-block"></span>

                                            </div>
                                            <div class="col-sm-5">
                                                <label>Tutor Empresarial</label>
                                                <select id="cbTEmpresa" class="form-control" name="cbTEmpresa" required>
                                                    <option value="-1">seleccione:</option>
                                                </select>
                                                <span  id= "apellidoP" class="help-block"></span>
                                            </div>
                                             <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Escuela</label>
                                                    <select id="escuela" class="form-control" name="escuela" onchange="cargarTutorA();" required>
                                                        <option value="-1">seleccione:</option>
                                                        <option value="1">Computacion</option>
                                                    </select>

                                                </div>
                                             </div>
                                             <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Tutor Academico</label>
                                                    <select id="cbTutorA" class="form-control" name="cbTutorA" required>
                                                        <option value="-1">seleccione:</option>
                                                    </select>

                                                </div>
                                             </div>
                                             <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Estudiante</label>
                                                    <select id="cbPostulados" class="form-control" name="cbPostulados" required>
                                                        <option value="-1">seleccione:</option>
                                                    </select>
    
                                                </div>
                                             </div>

                                            </br>
                                        </div>
                                          <div class="col-sm-10">
                                                 <div class="box-footer">
                                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                                <button class="btn btn-info pull-right" id="agregarPasantia">Agregar</button>
    
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