<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 26-02-2017
 * Time: 0:51
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
 */
?>

<section class="content-header">
   <div class="container well">
		<div class="row">
				<div class="col-xs-12"><h2>Tu Perfil de Usuario</h2></div>
			</div>
		<br /><br />
 
		<form class="form-horizontal">
 
				<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Nombre de Usuario</label>
					    <div class="col-sm-2">
					      <input class="form-control" type="text" id="formGroup" value="<?=$user[0]->usu_login?>" disabled>
					    </div>
					  </div>
 
					<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Nombre</label>
					    <div class="col-sm-4">
					      <input class="form-control" type="text" id="formGroup" value="<?=$user[0]->Nombre?>">
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Apellidos</label>
					    <div class="col-sm-4">
					      <input class="form-control" type="text" id="formGroup" value="<?=$user[0]->Apellido?>">
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup" id="tel">Teléfono</label>
 
					    <div class="input-group col-sm-3">
					      <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
					      <input class="form-control" type="text" id="formGroup">
					      
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup" id="tel">Correo electrónico</label>
					    <div class="input-group col-sm-3">
					      <span class="input-group-addon">@</span>
					      <input class="form-control" type="text" id="formGroup" value="<?=$user[0]->usu_correo?>">
					      
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Información biográfica</label>
					    <div class="col-sm-4">
					      
					      <textarea class="form-control" rows="4"></textarea>
					      
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Estado</label>
					    <div class="col-sm-4">
					      
					      <select class="form-control">
					        <option>En línea</option>
					        <option>Ocupado</option>
					        <option>Ausente</option>
					        <option>Desconectado</option>
					        
					      </select>
					      
					    </div>
					  </div>
				
					<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Alias</label>
					    <div class="col-sm-4">
					      <input class="form-control" type="text" id="formGroup">
					      <span class="help-block">Este nombre sera mostrado a los usuarios, ocultando el verdadero nombre.</span>
					    </div>
					  </div>
 
					<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Cuenta</label>
					    <div class="col-sm-4">
					      
							<label class="radio-inline">
							  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Activar
							</label>
							<label class="radio-inline">
							  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Desactivar
							</label>
 
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Mostrar Información</label>
					    <div class="col-sm-4">
					      
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox1" value="option1" checked disabled> Nombre
							</label>
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox2" value="option2"> Biografía
							</label>
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox3" value="option3"> Teléfono
							</label>
 
					    </div>
					  </div>
						<br />
 
						<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup"></label>
					    <div class="col-sm-4">
					      
							<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
							
							<button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
 
 
					    </div>
					  </div>
 
 
 
		</form>	
 
 </div>
</section>

