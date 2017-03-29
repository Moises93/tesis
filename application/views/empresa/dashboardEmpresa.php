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
    <h1>
        Bienvenido a SISPAS
        <small>Version 2.0</small>
    </h1>
    <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>-->
</section>
<style>

</style>
<section class="content">
    <h2>Estudiantes</h2>

 <div class="table-responsive">
<div class="col-xs-6 col-md-4">
   <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" />
   </div>
   <br>
   <br>
   <br>
  <table  id="tabla" class="table">
      <tbody>
        <?php $j = 0; foreach($Pasantes as $row){?>
               <?php if($j % 4 == 0){ ?>
                     <tr>
               <?php } ?>
          <td  class="grid cs-style-7" >
            <figure>
             <div id="<?=$j?>" class="info-box" style="width: 250px;">
                 <span class="info-box-icon bg-aqua" style="height: 0px; line-height: 0px;">
                    <?php if (empty($row->usu_foto)) { ?>
                       <img src="<?=asset_url("img/noPerfil.png")?>" alt="80" height="90px"> 
                    <?php } else { ?>
                        <img src="<?=$row->usu_foto?>"  alt="80" height="90px"> 
                    <?php } ?>
                 </span>
                 <div class="info-box-content">
                  <span class="info-box-text"><b><?=$row->pas_apellido . " " . $row->pas_nombre;?></b> </span>
                    <span><?=$row->usu_correo?></span>
                    <span><?=$row->Escuela?></span>
                
                 </div>
             </div>
             <figcaption>
                <span class="boton-cv">
                  <a href="<?php echo base_url();?>cpasante/downloads/cv-<?php echo$row->usu_login;?>.pdf" target="_blank">CV</a>
               </span>
                <span class="boton-perfil">
                  <a   href="">Perfil</a>
               </span>
                 
             <span class="boton-evaluar">
                  <a href="#" title="Aprobar Pasante" data-target="#modalEvaluacion" data-toggle="modal" onClick="evaluarPasante(<?=$row->pas_id?>)" >
                      Evaluar</a>
              
              
            </figcaption>
          </figure>

          </td>

           <?php if($j+1 % 3 == 0){ ?>
                     </tr>
                   
               <?php } ?>
        <?php $j++; } ?>
     </tbody>
   </table>
   </div>
</section>

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

