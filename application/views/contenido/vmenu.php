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
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <div id="menuDinamico">
            <ul class="sidebar-menu" >
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                <div id="menuHijo">
                    <ul class="treeview-menu">
                    </ul>
                </div>
            </ul>
        </div>
    </section>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
    </script>