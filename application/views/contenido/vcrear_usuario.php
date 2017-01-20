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
            <h3 class="box-title">Nuevo Usuario</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url('index.php/cadministrador/insertarU'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="box-body">
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
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="tipo">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <button type="submit" class="btn btn-info pull-right">Agregar</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
