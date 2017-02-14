<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 19-01-2017
 * Time: 22:17
 */
?>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Pasante</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="cedula" class="control-label">Cedula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="cedula">
                    </div>
                    <div class="col-sm-5">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="apellido" class="control-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
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
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="col-sm-5">
                        <label for="escuela" class="control-label">Escuela</label>
                        <input type="text" class="form-control" id="escuela" name="escuela" placeholder="Password">
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
            <!-- /.box-footer -->



        
    </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>