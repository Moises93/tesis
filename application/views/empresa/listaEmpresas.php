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
    <h2>Empresas</h2>

    <div class="table-responsive">
        <div class="col-xs-6 col-md-4">
            <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" />
        </div>
        <br>
        <br>
        <br>
        <table  id="tabla" class="table">
            <tbody>
            <?php $j = 0; foreach($Empresa as $row){?>
                <?php if($j % 3 == 0){ ?>
                    <tr>
                <?php } ?>
                <td  class="grid cs-style-7" >
                    <figure>
                        <div id="<?=$j?>" class="info-box" style="width: 250px;">
                 <span class="info-box-icon bg-aqua" style="height: 0px; line-height: 0px;">
                    <?php if (empty($row->emp_foto)) { ?>
                        <img src="<?=asset_url("img/noPerfil.png")?>" alt="80" height="90px">
                    <?php } else { ?>
                        <img src="<?=asset_url("img/".$row->emp_foto)?>"  alt="80" height="90px">
                    <?php } ?>
                 </span>
                            <div class="info-box-content">
                                <span class="info-box-text"><b><?=$row->emp_nombre?></b> </span>
                                <span><?=$row->emp_correo?></span></br>
                                <span><?=$row->emp_telefono?></span>

                            </div>
                        </div>
                        <figcaption>
                            <!--<span class="boton-cv">
                              <a href="pdf" target="_blank">CV</a>
                           </span>-->
                            <span class="boton-perfil">
                              <a   href="<?=base_url("empresa/perfilEmpresa").'/'.$row->emp_id?>">Perfil</a>
                           </span>

                        </figcaption>
                    </figure>

                </td>

                <?php if($j+1 % 2 == 0){ ?>
                    </tr>

                <?php } ?>
                <?php $j++; } ?>
            </tbody>
        </table>
        <div id="pagination" class="text-center">
            <ul class="pagination">

                <?php foreach ($links as $link) {
                    echo "<li>". $link."</li>";
                } ?>
            </ul>
        </div>
    </div>
</section>


