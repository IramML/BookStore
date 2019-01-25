 <?php require_once 'views/header.php'?>
   <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="<?php echo constant('URL'); ?>clients"><i class="far fa-user"></i> <span>Clients</span></a></li>
    <li><a href="<?php echo constant('URL'); ?>Books"><i class="fas fa-book"></i> <span>Books</span></a></li>
    <li><a href="<?php echo constant('URL'); ?>Orders"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
    <li><a href="<?php echo constant('URL'); ?>Deliveries"><i class="fas fa-truck"></i> <span>Deliveries</span></a></li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
 <?php require_once 'views/footer.php'?>