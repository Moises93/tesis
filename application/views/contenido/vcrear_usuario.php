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
            <h3 class="box-title">Horizontal Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="inputEmail3" class="control-label">Login</label>
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                    <div class="col-sm-5">
                        <label for="inputPassword3" class="control-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="inputEmail3" class="control-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control">
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
