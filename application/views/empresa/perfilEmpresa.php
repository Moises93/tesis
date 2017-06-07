<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 04-04-2017
 * Time: 19:15
 */?>



<!-- Fixed navbar -->

<section class="content-header">
    <h1>
        Perfil Empresa
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('empresa/listaEmpresas');?>"><i class="fa fa-dashboard"></i> Empresas</a></li>
        <li class="active">Perfil</li>
    </ol>
</section>
<section class="content">

    <div class="row">
        <?php foreach($Empresa as $row){?>


        <div class="col-sm-5">
            <div class="rating-block">
                <div class="row row-divided">
                    <div class="col-xs-6 column-one">
                                <h4> <?= $row['emp_nombre'] ?></h4>
                                <p> Rif: <?= $row['emp_rif'] ?></p>
                                <p> Correo: <?= $row['emp_correo'] ?></p>
                                <p> Direccion: <?= $row['ciudad'].'-'. $row['sector'].' '. $row['direccion'] ?></p>
                                <?php
                                $rating=$row['rating'];
                                if( $row['rating'] == null){
                                    $rating=0;
                                }  ?>
                                <h2 class="bold padding-bottom-7"><?= $rating ?><small>/ 5</small></h2>
                                <?php if($rating==0){ ?>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($rating>=1 && $rating < 2 ){ ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($rating>=2 && $rating < 3 ){ ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($rating>=3 && $rating < 4 ){ ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($rating>=4 && $rating < 5 ){ ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($rating== 5 ){ ?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }?>
                    </div>
                    <!--asset_url("img/".$row->emp_foto) jj  row['emp_foto']-->
                    <div class="col-xs-3 column-two">
                        <?php if (empty($row['emp_foto'])) { ?>
                            <img src="<?=asset_url("img/noPerfil.png")?>" alt="180" height="90px">
                        <?php } else { ?> 
                            <img src="<?=asset_url("img/".$row['emp_foto'])?>"  alt="180" height="90px">
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
        <?php  } ?>
       <!-- <div class="col-sm-3">
            <h4>Rating breakdown</h4>
            <div class="pull-left">
                <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin-left:10px;">1</div>
            </div>
            <div class="pull-left">
                <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin-left:10px;">1</div>
            </div>
            <div class="pull-left">
                <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin-left:10px;">0</div>
            </div>
            <div class="pull-left">
                <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin-left:10px;">0</div>
            </div>
            <div class="pull-left">
                <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                </div>
                <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin-left:10px;">0</div>
            </div>
        </div>
    </div>-->
        <!-- </div> <!-- de la otra forma puede ser quitando el div-->
        <div class="row">
            <div class="col-sm-6">
                <hr/>
                <div class="review-block">

                    <?php if(empty($Comentarios)==false){ ?>
                        <?php foreach($Comentarios as $row){?>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php if (empty($row['usu_foto'])) { ?>
                                <img src="<?=asset_url("img/noPerfil.png")?>" width="60px" alt="60px" class="img-rounded">
                            <?php } else { ?>
                                <img src="<?=$row['usu_foto']?>"  width="60px" alt="60px" class="img-rounded">
                            <?php } ?>

                            <div class="review-block-name"><a href="#"><?=$row['usu_login']?></a></div>
                            <div class="review-block-date"><br/></div>
                        </div>
                        <div class="col-sm-9">
                            <div class="review-block-rate">

                                <?php if($row['valor']==1){ ?>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($row['valor']==2){ ?>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>

                                <?php }else if($row['valor']==3){?>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($row['valor']==4){?>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php }else if($row['valor']==5){?>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sms" aria-label="Left Align" >
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php } ?>





                            </div>
                            <div class="review-block-title">Comentario:</div>
                            <div class="review-block-description"><?=$row['comentario']?></div>
                        </div>
                    </div>
                            <hr/>
                            <?php }?>
                    <?php }else{ ?>
                        <h2>Sin comentarios </h2>
                   <?php }?>






                </div>
            </div>
        </div>


</section>


<!-- Bootstrap core JavaScript
================================================== -->



