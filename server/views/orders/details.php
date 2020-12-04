<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->strings['site_name'] ?> | <?php echo $this->strings['nav_orders'] ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/dist/css/adminlte.min.css">
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
                            <h1><?php echo $this->strings['nav_orders'] ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo constant('URL') ?>orders"><?php echo $this->strings['nav_orders'] ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->strings['nav_order_details'] ?></li>
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
                                <h3 class="card-title"><?php echo $this->strings['clients_list'] ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3><?php echo $this->strings['personal_details'] ?></h3>
                                    </div>
                                    <div class="col-6 col-xs-6 col-md-4">
                                        <strong><?php echo $this->strings['name']?></strong>
                                        <p>
                                            <?php echo $this->order['first_name'] . " " . $this->order['last_name'] ?>
                                        </p>
                                    </div>
                                    <div class="col-6 col-xs-6 col-md-4">
                                        <strong><?php echo $this->strings['email']?></strong>
                                        <p>
                                            <?php echo $this->order['email']?>
                                        </p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <h3><?php echo $this->strings['shipment_details'] ?></h3>
                                    </div>
                                    <div class="col-6 col-xs-6 col-md-4">
                                        <strong><?php echo $this->strings['address']?></strong>
                                        <p>
                                            <?php echo $this->order['country'] . ", " . $this->order['state'] . ", " . $this->order['city']
                                                    . ", " . $this->order['postal_code']. ", " . $this->order['street']. ", #" . $this->order['outdoor_number'] ?>
                                        </p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <h3><?php echo $this->strings['book_details'] ?></h3>
                                    </div>
                                    <div class="col-6 col-xs-6 col-md-4">
                                        <strong><?php echo $this->strings['title']?></strong>
                                        <p>
                                            <?php echo $this->order['title']?>
                                        </p>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-12 col-xs-12 col-md-6 mt-2">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="i-status"><?php echo $this->strings['order_status'] ?></label>
                                                <select name="status" id="i-status" class="form-control">
                                                    <option value="pending" <?php echo $this->order['status'] == 'pending' ? "selected" : ""; ?>>
                                                        <?php echo $this->strings['status_pending'] ?>
                                                    </option>
                                                    <option value="on_way" <?php echo $this->order['status'] == 'on_way' ? "selected" : ""; ?>>
                                                        <?php echo $this->strings['status_on_way'] ?>
                                                    </option>
                                                    <option value="complete" <?php echo $this->order['status'] == 'complete' ? "selected" : ""; ?>>
                                                        <?php echo $this->strings['status_complete'] ?>
                                                    </option>
                                                </select>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="<?php echo $this->strings['save'] ?>">
                                        </form>
                                    </div>

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
    <!-- AdminLTE App -->
    <script src="<?php echo constant('URL') ?>public/dist/js/adminlte.min.js"></script>
</body>

</html>