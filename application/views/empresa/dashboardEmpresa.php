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
                  <a href="">CV</a>
               </span>
                <span class="boton-perfil">
                  <a   href="">Perfil</a>
               </span>
                <span class="boton-evaluar">
                  <a   href="">Evaluar</a>
               </span>
              
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

