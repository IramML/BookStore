<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->strings['site_name']?> | 404 Página no encontrada</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo constant('URL')?>public/svg/favicon.svg" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-blue navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo constant('URL')?>" class="nav-link">Tablero</a>
            </li>
        </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo constant('URL')?>" class="brand-link">
            <img src="<?php echo constant('URL') ?>public/img/favicon.png" alt="BookStore Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">BookStore</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->

            <!-- Sidebar Menu -->
            <?php require 'views/asideBar.php'?>
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
                        <h1>404 Error Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo constant('URL')?>">Home</a></li>
                            <li class="breadcrumb-item active">404 Error Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-warning"> 404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="<?php echo constant('URL')?>">return to dashboard</a> or try using the search form.
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
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
<script src="<?php echo constant('URL')?>public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo constant('URL')?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo constant('URL')?>public/dist/js/adminlte.min.js"></script>
</body>
</html>
