<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Pasante</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form id="pasanteForm"  class="form-horizontal" action="none">
            <div class="box-body">
                <div class="form-group col-sm-3"">
                  <!--  <div class=">-->
                            <label for="cedula" class="control-label">Cedula</label>
                            <input class="form-control"  type="text"  id="cedula" name="cedula" placeholder="cedula" required/>
                            <p class="help-block"></p>
                       <!-- <input type="text" class="form-control" id="cedula" name="cedula" placeholder="cedula">-->
                        <!--<div  id= "cedulaP"></div>-->
                 <!--   </div>-->
                </div>
            <div class="form-group col-sm-3"">
                   <!-- <div class="col-sm-3">-->
                            <label for="nombre" class="control-label">Nombre</label>
                            <input class="form-control" type="text"  id="nombre" name="nombre" placeholder="nombre" required>
                            <p class="help-block"></p>
                   <!-- </div>-->
                </div>
                <div class="form-group">
    
                    <div class="col-sm-5">
                        <div class="controls">
                            <label for="apellido" class="control-label">Apellido</label>
                            <input class="form-control" type="text"  id="apellido" name="apellido" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
    
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Sexo</label>
                            <select id="sexo" class="form-control" name="sexo" >
                                <option value="">seleccione:</option>
                                <option value="m">Masculino</option>
                                <option value="f">Femenino</option>
                            </select>
                        </div>
                    </div>
    
    
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <div class="control-group">
                            <label for="email" class="control-label">Email</label>
                            <div class="controls">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                <p class="help-block"></p>
                            </div>
                        </div>
                     </div>
    
                    <div class="col-sm-5">
                        <label>Escuela</label>
                        <select id="escuela" class="form-control" name="escuela" >
                            <option value="">seleccione:</option>
                            <option value="1">Computaciòn</option>
                        </select>
                    </div>
    
    
                </div>
                <h4 class="box-title">Datos de Acceso al Sistema</h4>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="login" class="control-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="col-sm-5">
                        <label for="clave" class="control-label">Password</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                    </div>
    
                </div>
    
                <!--<div class="form-group" id="userOption">
                </div>-->
    
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer">
                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <button type="submit" class="btn btn-info pull-right" id="agregarPasante">Agregar</button>
            </div>
         </form>   
        <!-- /.box-footer -->




    </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>