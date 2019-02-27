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
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $this->numClients?></h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="far fa-user"></i>
            </div>
            <a href="<?php echo constant('URL'); ?>clients" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->numBooks?></h3>

              <p>Books</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="<?php echo constant('URL'); ?>books" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $this->numOrders?></h3>

              <p>Orders</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="<?php echo constant('URL'); ?>orders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $this->numDeliveries?></h3>

              <p>Deliveries</p>
            </div>
            <div class="icon">
              <i class="fas fa-truck"></i>
            </div>
            <a href="<?php echo constant('URL'); ?>deliveries" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
    </section>
    <!-- /.content -->
  </div>
 <?php require_once 'views/footer.php'?>