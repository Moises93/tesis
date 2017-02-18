<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Nueva Empresa</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form id="pasanteForm"  class="" action="none">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Rif" class="control-label">Rif</label>
                            <input class="form-control"  type="text"  id="Rif" name="Rif" placeholder="Rif" required>
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            <p class="help-block"></p>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreE" class="control-label">Nombre</label>
                            <input class="form-control" type="text"  id="nombreE" name="nombreE" placeholder="nombre" required>
                            <p class="help-block"></p>
                        </div>
                        <h4 class="box-title">&nbsp;&nbsp;&nbsp;&nbsp;</br></h4>




                    </div>
                    <div class="col-md-6">

                        <h4 class="box-title">Datos de Acceso al Sistema</h4>
                        <div class="form-group">
                            <label for="login" class="control-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login">
                            <p class="help-block"></p>
                        </div>



                    </div>
                    <div class="col-md-6">

                        <h4 class="box-title">&nbsp;</h4>
                        <div class="form-group">
                            <label for="clave" class="control-label">Password</label>
                            <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                            <p class="help-block"></p>
                        </div>



                    </div>
                </div>

            </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                        <button  class="btn btn-info pull-right" id="agregarPasante">Agregar</button>
                    </div>
         </form>   
        <!-- /.box-footer -->




    </div>
</div>
<script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
</script>