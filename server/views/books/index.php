<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->strings['site_name'] ?> | <?php echo $this->strings['nav_dashboard'] ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo constant('URL') ?>public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo constant('URL') ?>public/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo constant('URL') ?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo constant('URL') ?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-green navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo constant('URL') ?>" class="nav-link"><?php echo $this->strings['nav_dashboard'] ?></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-green elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo constant('URL') ?>" class="brand-link">
        <img src="<?php echo constant('URL') ?>public/img/favicon.png" alt="BookStore Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $this->strings['site_name'] ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <?php require 'views/asideBar.php' ?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo $this->strings['nav_books'] ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <!--
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
-->
                <li class="breadcrumb-item"><?php echo $this->strings['nav_books'] ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $this->strings['books_list']?></h3>
                <div class="card-tools">
                  <a href="<?php echo constant('URL') ?>books/add" class="btn bg-info"><?php echo $this->strings['add_book']?> <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="main-table">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo $this->strings['id']?></th>
                        <th scope="col"><?php echo $this->strings['image']?></th>
                        <th scope="col"><?php echo $this->strings['title']?></th>
                        <th scope="col"><?php echo $this->strings['author']?></th>
                        <th scope="col"><?php echo $this->strings['stock']?></th>
                        <th scope="col"><?php echo $this->strings['actions']?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($this->books as $index => $item) {
                      ?>
                        <tr>
                          <th scope="row"><?php echo $item['id'] ?></th>
                          <td><img src="<?php echo constant('URL_UPLOADS')."books/images/".$item['image'] ?>" width="62" height="62"></td>
                          <td><?php echo $item['title'] ?></td>
                          <td><?php echo $item['author'] ?></td>
                          <td><?php echo $item['stock'] ?></td>
                          <td class="d-flex">
                            <form action="" method="post">
                              <input type="hidden" name="delete_book_id" value="<?php echo $item['id'] ?>">
                              <input class="btn btn-danger" type="submit" value="<?php echo $this->strings['delete']?>">
                            </form>
                            <a class="ml-1 btn btn-info" href="<?php echo constant('URL')."books/edit/".$item['id'] ?>"><?php echo $this->strings['edit']?></a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo constant('URL') ?>public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo constant('URL') ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo constant('URL') ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo constant('URL') ?>public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo constant('URL') ?>public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo constant('URL') ?>public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo constant('URL') ?>public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo constant('URL') ?>public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo constant('URL') ?>public/dist/js/adminlte.min.js"></script>
</body>

</html>