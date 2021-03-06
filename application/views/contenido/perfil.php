<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 26-02-2017
 * Time: 0:51
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
 */
?>
<script type="text/javascript">

	
    function cargarimagen(evt) {
        var files = evt.target.files;
        
        // Obtenemos la imagen del campo "file". 
        f = files[0];
        
        // Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            return;
        }
        
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                document.getElementById("imagen").src = e.target.result;
                document.getElementById("usuario_foto").value = e.target.result;
            };
        })(f);
        reader.readAsDataURL(f);
    };
</script>

<section class="content-header">
   <div class="container well">
		
    <div class="card hovercard">
        <div class="card-background">
        <?php if (empty($user[0]->usu_foto)) { ?>
                 <img class="card-bkimg" alt="" src="<?=asset_url("img/NoFoto.jpg")?>">
         <?php } else { ?>
                 <img class="card-bkimg" alt="" src="<?=$user[0]->usu_foto?>">
         <?php } ?>
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
           <?php if (empty($user[0]->usu_foto)) { ?>
                 <img alt="" src="<?=asset_url("img/NoFoto.jpg")?>">
         <?php } else { ?>
                 <img  alt="" src="<?=$user[0]->usu_foto?>">
         <?php } ?>
        </div>
        <div class="card-info"> <span class="card-title"><?=$user[0]->Apellido. " " . $user[0]->Nombre?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Usuario</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                <div class="hidden-xs">Aptitudes Academicas</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Following</div>
            </button>
        </div>
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
         <div class="row">
				<div class="col-xs-12"><h2>Tu Perfil de Usuario</h2></div>
			</div>
		<br /><br />
 
		<form class="form-horizontal" action="<?=base_url('cusuario/guardarUsuario')?>" role="form" method="post" enctype="multipart/form-data">
  <input type="hidden" id="usuario_foto" name="usuario_foto" value="<?=$Foto?>" />
  <input type="hidden" id="idUsuario" name="idUsuario" value="<?=$user[0]->id_usuario?>" /> 
  <input type="hidden" id="idTipo" name="idTipo" value="<?=$user[0]->id_tipo?>" /> 
				<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup">Nombre de Usuario</label>
					    <div class="col-sm-2">
					      <input class="form-control" type="text" id="formGroup" value="<?=$user[0]->usu_login?>" disabled>
					    </div>
					  </div>
 
					<div class="form-group">
					    <label class="col-sm-2 control-label" for="nombreUsuario">Nombre</label>
					    <div class="col-sm-4">
					      <input class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" value="<?=$user[0]->Nombre?>">
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="apellidoUsuario">Apellidos</label>
					    <div class="col-sm-4">
					      <input class="form-control" type="text" id="apellidoUsuario" name="apellidoUsuario" value="<?=$user[0]->Apellido?>">
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup" id="tel">Teléfono</label>
 
					    <div class="input-group col-sm-3">
					      <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
					      <input class="form-control" type="text" id="telefonoUsuario" name="telefonoUsuario" value="<?=$user[0]->Tel?>">
					      
					    </div>
					  </div>
 
					  <div class="form-group">
					    <label class="col-sm-2 control-label" for="emailUsuario" id="email">Correo electrónico</label>
					    <div class="input-group col-sm-3">
					      <span class="input-group-addon">@</span>
					      <input class="form-control" type="text" id="emailUsuario" name="emailUsuario" value="<?=$user[0]->usu_correo?>">
					      
					    </div>
					  </div>					
						<br />
 						<label>Foto de Perfil</label>
                              <div>
                              <?php if (empty($user[0]->usu_foto)) { ?>
                                <img id="imagen" class="img-responsive img-thumbnail" width="50%" src="<?=asset_url("img/NoFoto.jpg")?>" />
                                      <?php } else { ?>
  <img  id="imagen" class="img-responsive img-thumbnail" width="50%"  src="<?=$user[0]->usu_foto?>">
                                      <?php } ?>
                                <input type="file" id="archivo_foto" name="archivo_foto" />
                              </div>
                              <script>
                            document.getElementById('archivo_foto').addEventListener('change', cargarimagen, false);
                        </script>
                              <br>
						<div class="form-group">
					    <label class="col-sm-2 control-label" for="formGroup"></label>
					    <div class="col-sm-4">
					      
							<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
							
 <a  class="btn btn-lg btn-danger pull-right feditar glyphicon glyphicon-remove-circle" href="<?=base_url('cusuario/inicio')?>" >Cancelar</a>
 
					    </div>
					  </div>
 
 
 
		</form>	
        </div>
        <div class="tab-pane fade in" id="tab2">
        <?php if ($user[0]->id_tipo == 4) { ?>
        <form class="form-horizontal" action="<?=base_url('cusuario/guardarHabilidades')?>" role="form" method="post" enctype="multipart/form-data">
         <input type="hidden" id="idUsuario" name="idUsuario" value="<?=$user[0]->id_usuario?>" /> 
          <h3>This is tab 2</h3>
          <div>
                                   <label>Habilidades</label>
                                      
                                      <select class="form-control select2" multiple="multiple" data-placeholder="Habilidad" style="width: 100%;" id="habilidadId" name="habilidadId[]" required>
                                          <?php foreach($Habilidades as $row): ?>
                                           <option value="<?=$row->id_habilidad?>"><?=$row->descripcion?></option>
                                       <?php endforeach;?>
                                     </select>
                                  </div>
                                  <br><br>
                                    <div class="form-group">
              <label class="col-sm-2 control-label" for="formGroup"></label>
              <div class="col-sm-4">
                
              <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
              
 <a  class="btn btn-lg btn-danger pull-right feditar glyphicon glyphicon-remove-circle" href="<?=base_url('cusuario/inicio')?>" >Cancelar</a>
 
              </div>
            </div>
        </form>
        <?php } ?>
        </div>
        <div class="tab-pane fade in" id="tab3">
          <h3>This is tab 3</h3>
        </div>
      </div>
    </div>
 
            
 
 </div>
</section>

