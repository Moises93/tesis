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
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <h2>Empresas</h2>
    <div id="test-list">
    <input type="text" class="search" />
    <br><br>
      <ul class="list" id="usuarios">
     <?php $j = 0; foreach($Pasantes as $row):?>
            <li><div id="<?=$j?>" class="info-box" style="width: 250px;">
                 <span class="info-box-icon bg-aqua" style="height: 0px; line-height: 0px;">
                    <?php if (empty($row->usu_foto)) { ?>
                       <img src="<?=asset_url("img/noPerfil.png")?>" alt="80" height="90px"> 
                    <?php } else { ?>
                        <img src="<?=$row->usu_foto?>"  alt="80" height="90px"> 
                    <?php } ?>
                 </span>
                <div class="info-box-content">
                  <span class="info-box-text"><?=$row->pas_nombre?></span>
                    <span>valencia-carabobo</span>
                  <span class="info-box-number">90<small>%</small></span>
                </div>
               </div>

            </li>
            
      <?php $j++; endforeach; ?>
        <!-- /.info-box -->
            </ul>
          <ul class="pagination"></ul>
    </div>

</section>
