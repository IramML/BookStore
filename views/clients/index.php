    <?php require_once 'views/header.php'?>
       <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"></li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="<?php echo constant('URL'); ?>clients"><i class="far fa-user"></i> <span>Clients</span></a></li>
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
        Clients
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Clients</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div id="title">
        <h2 class="center"></h2>
        <a id="add-user" href="<?php echo constant('URL'); ?>clients/register"><img class="option" src="public/img/person-add.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <table id="table-clients">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            include_once 'models/client.php';
            foreach ($this->clients as $row){
                $client=new Client();
                $client=$row;
                ?>
                <tr>
                    <td><?php echo $client->code?></td>
                    <td><?php echo $client->name?></td>
                    <td><?php echo $client->lastName?></td>
                    <td class="center"><a href=""><img class="option option-table" src="<?php echo constant('URL')?>public/img/edit.png" alt="Add user"></a></td>
                    <td class="center"><a href="#"><img class="option option-table" src="<?php echo constant('URL')?>public/img/person-remove.png" alt="Add user"></a></td>
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