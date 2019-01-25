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
    <li class="active"><a href="<?php echo constant('URL'); ?>Orders"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
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
        Orders
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#" class="active"><i class="fa fa-dashboard"></i> Orders</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
     <div id="title">
        <h2 class="center"></h2>
        <a id="add-user" href="<?php echo constant('URL'); ?>orders/register"><img class="option" src="public/img/plus.png" alt="Add user"></a>
    </div>
    <div id="order-content">
        <table id="table-orders">
            <thead>
            <tr>
                <th>Number of order</th>
                <th>Client code</th>
                <th>Book code</th>
                <th>Date of purchase</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once 'models/order.php';
            foreach ($this->orders as $row){
                $order=new Order();
                $order=$row;
                ?>
                <tr>
                    <td><?php echo $order->numOrder?></td>
                    <td><?php echo $order->clientCode?></td>
                    <td><?php echo $order->bookCode?></td>
                    <td><?php echo $order->buyDate?></td>
                    <td class="center"><a href=""><img class="option option-table" src="<?php echo constant('URL')?>public/img/edit.png" alt="Add user"></a></td>
                    <td class="center"><a href="#"><img class="option option-table" src="<?php echo constant('URL')?>public/img/trash.png" alt="Add user"></a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    </section>
    <!-- /.content -->
  </div>
 <?php require_once 'views/footer.php'?>