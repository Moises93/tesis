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
                            <li class="active"><a href="#pasantias" data-toggle="tab">Mto. Pasant&iacute;a</a></li>
                            <li><a href="#nuevoP" data-toggle="tab">Nueva Pasant&iacute;a</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="pasantias">
                                       <div class="box-header">
                                         <h3 class="box-title"> Totalidad de Pasan&iacute;as dentro del sistema</h3>
                                       </div>
                                       <div class="box-body">
        
                                        <table id="tabPasantias" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Progreso</th>
                                                <th>Pasante</th>
                                                <th>Periodo</th>
                                                <th>Empresa</th>
                                                <th>Escuela</th>
                                                <th>Accion</th>
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
                                                <div class="form-group">
                                                    <label>Escuela</label>
                                                    <select id="escuela" class="form-control" name="escuela" onchange="mostrarEstudiantes()" required>
                                                        <option value="-1">seleccione:</option>
                                                        <option value="1">Computacion</option>
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

                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label >Tipo Organizacion</label>
                                                        <select id="cbOrganizacion" class="form-control" name="cbOrganizacion" onchange="mostrarOrg();" required>
                                                            <option value="-1">seleccione:</option>
                                                            <option value="1">Empresa</option>
                                                        </select>
                                                    <span  id= "nombreP" class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <label id="labOrg">Organización</label>
                                                <select id="cbEmpresa" class="form-control" name="cbEmpresa" required>
                                                    <option value="-1">seleccione:</option>
                                                </select>
                                                <select id="escuelao" class="form-control" name="escuelao"required>
                                                    <option value="-1">seleccione:</option>
                                                    <option value="1">Universidad de Carabobo</option>
                                                </select>

                                                <span  id= "nombreP" class="help-block"></span>

                                            </div>

                                        </div>
                                          <div class="col-sm-10">
                                                 <div class="box-footer">
                                                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                                <id class="btn btn-info pull-right" id="agregarPasantia">Agregar</id>
    
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

<!--incio modal de edicion pasantia -->
<div class="modal fade" id="modalEditPasantia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue">
                <button type="button" id="mbtnCerrarModal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Tutor</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <!-- parametros ocultos -->
                    <input type="hidden" id="idPasantia">
                    <input type="hidden" id="idUsuario">
                    <!-- Fin de parametros ocultos -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Duracion Pasant&iacute;a:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="duracion" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label >Tipo Organizacion</label>
                            <select id="cbOrganizacionm" class="form-control" name="cbOrganizacionm" onchange="mostrarOrgm();" required>
                                <option value="-1">seleccione:</option>
                                <option value="1">Empresa</option>
                                <option value="2">Universidad</option>
                            </select>
                            <span  id= "nombreP" class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label id="labOrgm">Organización</label>
                            <select id="cbEmpresam" class="form-control" name="cbEmpresam" required>
                                <option value="-1">seleccione:</option>
                            </select>
                            <select id="escuelam" class="form-control" name="escuelam"required>
                                <option value="-1">seleccione:</option>
                                <option value="1">Universidad de Carabobo</option>
                            </select>

                            <span  id= "nombreP" class="help-block"></span>

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" id="actualizarPasantia">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Final modal-->
<!-- Inicio  modal Pasantia
<div class="modal fade bs-example-modal-lg" id="modalInfoPasantia" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">-->

    <div class="modal  bs-example-modal-lg"  id="modalInfoPasantia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="text-danger fa fa-times"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="text-muted fa fa-shopping-cart"></i> <strong>02051</strong> - Nome do Produto </h4>
                </div>
                <div class="modal-body">

                    <table class="pull-left col-md-8 ">
                        <tbody>
                        <tr>
                            <td class="h6"><strong>C&eacute;dula</strong></td>
                            <td> </td>
                            <td id="cedula" class="h5">cedula</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Correo</strong></td>
                            <td> </td>
                            <td id="correo" class="h5">correo</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Número de Telefono</strong></td>
                            <td> </td>
                            <td id="telefono" class="h5">Telefono</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Escuela</strong></td>
                            <td> </td>
                            <td id="escuelac" class="h5">escuela</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Tutor Academico</strong></td>
                            <td> </td>
                            <td id= "tutorA" class="h5">tutorA</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Empresa</strong></td>
                            <td> </td>
                            <td id= "empresa" class="h5">empresa</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Tutor Empresarial</strong></td>
                            <td> </td>
                            <td id= "tutorE" class="h5">tutorE</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Modalidad</strong></td>
                            <td> </td>
                            <td id="modalidadp" class="h5">modalidad</td>
                        </tr>

                        <tr>
                            <td class="h6"><strong>Periodo</strong></td>
                            <td> </td>
                            <td id="periodop" class="h5">periodo</td>
                        </tr>

                        <!--<tr>
                            <td class="h6"><strong>Pendiente</strong></td>
                            <td> </td>
                            <td id="pendiente" class="h5">pendiente</td>
                        </tr>

                        <tr>
                            <td class="btn-mais-info text-primary">
                                <i class="open_info fa fa-plus-square-o"></i>
                                <i class="open_info hide fa fa-minus-square-o"></i> Pendiente
                            </td>
                            <td> </td>
                            <td  id="pendiente"  class="h5"></td>
                        </tr>-->

                        </tbody>
                    </table>


                    <div class="col-md-4">
                        <img id="img" src="" alt="teste" class="img-thumbnail">
                    </div>

                    <div class="clearfix"></div>
                    <p class="open_info hide">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>

                <div class="modal-footer">

                    <div class="text-left pull-left col-md-1" style="width: 350px;">
                        <strong> Pendiente: </strong><br/>
                        <span id="pendiente" class=""><strong> 30%</strong></span></span>
                    </div>

                    <div class="text-right pull-right col-md-3">
                        <strong>Progreso: </strong><br/>
                        <span id="progreso" class="h3 text-muted"><strong> 30%</strong></span></span>
                    </div>

                   <!-- <div class="text-right pull-right col-md-3">
                        Atacado: <br/>
                        <span class="h3 text-muted"><strong>R$35,00</strong></span> http://lorempixel.com/150/150/technics/
                    </div>-->

                </div>
            </div>
        </div>


</div>

<!--Mostrar Resultado-->
<div class="modal  bs-example-modal-lg"  id="modalResultado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><span class="label label-warning" id="resul">*</span>RESULTADO</h3>
            </div>
            <div class="modal-body" id="resultados">
                <label id="p1" > </label></br>
                <label id="r1"> </label></br>
                <label id="p2"> </label></br>
                <label id="r2"> </label></br>
                <label id="p3"> </label></br>
                <label id="r3"> </label></br>

            </div>
            <div class="modal-footer text-muted">
                <span id="answer"></span>
            </div>
        </div>
    </div>
</div>

<!-- Modal de evaluacion-->
<div class="modal  bs-example-modal-lg"  id="modalEvaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"   >
        <div class="modal-content">
            <div class="modal-header">
                <?php foreach ( $preguntas as $m): ?>
                    <h3 id="<?php echo 'pid'.$m['id'];?>"><span class="label label-warning" id="<?php echo 'qid'.$m['id'];?>"><?php echo $m['id'];?></span><?php echo $m['test'];?></h3>
                <?php endforeach; ?>
                <h3 id="finish"> El test ha terminado </h3>
            </div>
            <div class="modal-body">
                <div class="col-xs-3 col-xs-offset-5">
                    <div id="loadbar" style="display: none;">
                        <div class="blockG" id="rotateG_01"></div>
                        <div class="blockG" id="rotateG_02"></div>
                        <div class="blockG" id="rotateG_03"></div>
                        <div class="blockG" id="rotateG_04"></div>
                        <div class="blockG" id="rotateG_05"></div>
                        <div class="blockG" id="rotateG_06"></div>
                        <div class="blockG" id="rotateG_07"></div>
                        <div class="blockG" id="rotateG_08"></div>
                    </div>
                </div>
                <?php $cont=1;?>
                <div class="quiz" id="quiz" data-toggle="buttons">
                    <?php foreach ( $respuestas as $r): ?>
                        <?php $clase= 'element-animation'.$cont.' btn btn-lg btn-primary btn-block';?>
                        <label class="<?php echo $clase;?>"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="<?php echo $r['respuestaid'];?>"><?php echo $r['valor'];?></label>
                        <?php $cont=$cont+1;?>
                    <?php endforeach; ?>
                </div>
                <button id="guardar" type="button" class="btn btn-primary"> <span class="badge">Guardar</span></button>
                <h3 id="resultado"> El Resultado de la Evaluacion Fue : Muy Bueno  </h3>
            </div>
            <div class="modal-footer text-muted">
                <span id="answer"></span>
            </div>
        </div>
    </div>
</div>
<!-- Fin  modal Pasantia-->
<script type="text/javascript">
	var baseurl = "<?php echo base_url(); ?>";
</script>