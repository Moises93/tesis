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
   <?php if( $j == 0 || ($j % 5 == 0)){?>
                     <tr>
          <?php}?>

   <?php if( $j == 0 || ($j % 4 == 0)){?>
                     </tr>
          <?php } ?>