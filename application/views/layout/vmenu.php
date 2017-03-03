<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- s<idebar menu: : style can be found in sidebar.less -->
        <?php
       // $menu = new cadministrador();
        $ci = &get_instance();
        $ci->load->model("model_usuario");
        ?>
        <div id="menuDinamico">
            <ul class="sidebar-menu" >
                <li class="header">MENU PRINCIPAL</li>

                <?php foreach ( $menu as $m): ?>
                  <?php if($m['hijos'] != null){ ?>
                    <li class="treeview">
                        <a href="<?php echo $m['url'];?>">
                            <i class="<?php echo $m['clase'];?>"></i> <span><?php echo $m['nombre'];?></span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php foreach ( $m['hijos'] as $s): ?>
                                <li><a href="<?php echo base_url() .$s['url'] ?>"><i class="<?php echo $s['clase'];?>"></i> <?php echo $s['nombre'];?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                  <?php }else{ ?>
                    <li><a href="<?php echo base_url() .$m['url'];?>"><i class="<?php echo $m['clase'];?>"></i> <span><?php echo $m['nombre'];?></span></a></li>
                  <?php } ?>
                <?php endforeach; ?>

                
            </ul>
        </div>
    </section>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
    </script>