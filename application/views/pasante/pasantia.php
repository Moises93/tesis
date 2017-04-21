<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 31-03-2017
 * Time: 0:45
 */
?>
<div class="container">
    <h2>Mi pasantia</h2>
    <p>Ve la información de tu pasantia</p>
    <div id="miPasantia" class="panel-body" style="display: none;  alt:300px;">
    <div class="col-md-3">
        <div class="media">
            <a href="#" class="pull-left">
                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" width="150px" alt="150px" class="media-photo">
            </a>
            <div class="media-body" style="display: inline-table;">

               <h4 class="title">
                    Universidad de Carabobo

                </h4>
                <strong>Escuela:&nbsp;</strong>
                <span id="escuela"></span></br>
                <strong>Direccion:&nbsp;</strong>
                <span>Nagunagua-Carabobo</span>
            </div>
        </div>
    </div><!-- .col-md-3 -->

    <div class="col-md-3">
        <div class="media">
            <a href="#" class="pull-left">
                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" width="150px" alt="150px" class="media-photo">
            </a>
            <div class="media-body" style="display: inline-table;">

                <h4 class="title">
                   Empresa

                </h4>
                <strong>Nombre:&nbsp;</strong>
                <span id="empresa"></span></br>
             
                <strong>Valorar Empresa:&nbsp;</strong>
            
                <a href="#" title="Valorar Empresa" data-toggle="modal"data-target="#modalValoracion"onClick="evaluarEmpresa();">
                <span  class="fa fa-flag-checkered" </span></a>

            </div>
        </div>
    </div><!-- .col-md-3 -->
    <div class="col-md-3">
        <div class="media">
            <a href="#" class="pull-left">
                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" width="150px" alt="150px" class="media-photo">
            </a>
            <div class="media-body" style="display: inline-table;">

                <h4 class="title">
                    Tutor Academico

                </h4>
                <strong>Nombre:&nbsp;</strong>
                <span id="nombreTa"></span></br>
                <strong>Correo:&nbsp;</strong>
                <span id="correTa"></span>
            </div>
        </div>
    </div><!-- .col-md-3 -->
    <div class="col-md-3">
        <div class="media">
            <a href="#" class="pull-left">
                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" width="150px" alt="150px" class="media-photo">
            </a>
            <div class="media-body" style="display: inline-table;">

                <h4 class="title">
                    Tutor Empresarial

                </h4>
                <strong>Nombre:&nbsp;</strong>
                <span id="nombreTe"></span></br>
                <strong   >Correo:&nbsp;</strong>
                <span id="correTe"></span>
            </div>
        </div>
    </div><!-- .col-md-3 -->
    <div class="clearfix"></div>
</br>
        <!-- <div class="col-md-6">
             <strong>Actividades Pendientes:</strong>
             <span>Informe Final, Evaluació Tutor Empresarial</span>
         </div> .col-md-6 -->
</div>
</div>

<div class="modal fade"  id="modalValoracion"  role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div style="text-align: center;" class="modal-header">
                <h3><span class="label label-warning" id="resul"></span>Valoraciòn de Empresa</h3>
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


                <div class="row lead evaluation">
                    <span id="nombreLibro"> </span>
                    <input type="hidden" id="idEmpresa">
                    <div id="colorstar" class="starrr ratable" ></div>
                    <span id="count">0</span>  <span id="texto">star(s) - </span><span id="meaning"> </span></br>
                    <span id="exito"></span>
                    <span  id="comentariot"><strong>Comentario</strong></span></br>
                    <input type="text" id="comentario" name="comentario"></br>
                    <button id="valorarb" type="button" onclick="valorarEmpresa()" class="btn criteria" data-color="info">Valorar</button>

                </div>

            </div>
            <div class="modal-footer text-muted">
                <span id="answer"></span>
            </div>
        </div>
    </div>
</div>