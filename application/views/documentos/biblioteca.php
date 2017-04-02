<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 30-03-2017
 * Time: 17:48
 */
?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Biblioteca</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="tblBiblioteca" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Documentos</th>
                            <th><em class="fa fa-eye"></em></th>
                         

                        </tr>
                        </thead>

                    </table>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal fade"  id="modalValoracion"  role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="text-align: center;" class="modal-header">
                <h3><span class="label label-warning" id="resul"></span>Valoraciòn de Documentos</h3>
            </div>
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
            <div style="text-align: center;" class="modal-body" id="resultados">

                
                <div style="text-align: center;" class="row lead evaluation">
                    <span id="nombreLibro"> </span>
                    <input type="hidden" id="iddoc">
                    <div id="colorstar" class="starrr ratable" ></div>
                    <span id="count">0</span>  <span id="texto">star(s) - </span><span id="meaning"> </span></br>
                    <span id="exito"></span>
                    <button id="valorarb" type="button" onclick="valorarLibro()" class="btn criteria" data-color="info">Valorar</button>
                   <!-- <div class='indicators' style="display:none">
                        <div id='textwr'>What went wrong?</div>
                        <input id="rate[]" name="rate[]" type="text" placeholder="" class="form-control input-md" style="display:none;">
                        <input id="rating[]" name="rating[]" type="text" placeholder="" class="form-control input-md rateval" style="display:none;">

                <span class="button-checkbox">
                <button type="button" class="btn criteria" data-color="info">Punctuallity</button>
                 <input type="checkbox" class="hidden"  />
                </span>
                <span class="button-checkbox">
                <button type="button" class="btn criteria" data-color="info">Assistance</button>
                 <input type="checkbox" class="hidden"  />
                </span>
                <span class="button-checkbox">
                <button type="button" class="btn criteria" data-color="info">Knowledge</button>
                 <input type="checkbox" class="hidden"  />
                </span>
                    </div>-->


                </div>

            </div>
            <div class="modal-footer text-muted">
                <span id="answer"></span>
            </div>
        </div>
    </div>
</div>