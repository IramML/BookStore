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
                            <h1><?php echo $this->strings['nav_categories'] ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                                <li class="breadcrumb-item"><a href="<?php echo constant('URL') ?>categories"><?php echo $this->strings['nav_categories'] ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->strings['nav_add_categories'] ?></li>
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
                                <h3 class="card-title"><?php echo $this->strings['add_category'] ?></h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" class="row" enctype="multipart/form-data">
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-title"><?php echo $this->strings['title'] ?></label>
                                        <input type="text" name="title" id="i-title" class="form-control" value="<?php echo $this->bookDetails['title'] ?>" required>
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-author"><?php echo $this->strings['author'] ?></label>
                                        <input type="text" name="author" id="i-author" class="form-control" value="<?php echo $this->bookDetails['author'] ?>" required>
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-editorial"><?php echo $this->strings['editorial'] ?></label>
                                        <input type="text" name="editorial" id="i-editorial" class="form-control" value="<?php echo $this->bookDetails['editorial'] ?>" required>
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-num-pages"><?php echo $this->strings['num_pages'] ?></label>
                                        <input type="number" min="1" value="<?php echo $this->bookDetails['num_pages'] ?>" name="num_pages" id="i-num-pages" class="form-control">
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-cost"><?php echo $this->strings['cost'] ?></label>
                                        <input type="number" min="1" value="<?php echo $this->bookDetails['cost'] ?>" name="cost" id="i-cost" class="form-control">
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-stock"><?php echo $this->strings['stock'] ?></label>
                                        <input type="number" min="0" value="<?php echo $this->bookDetails['stock'] ?>" name="stock" id="i-stock" class="form-control">
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-description"><?php echo $this->strings['description'] ?></label>
                                        <textarea name="description" id="i-description" cols="30" rows="10" class="form-control" required><?php echo $this->bookDetails['description'] ?></textarea>
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-category"><?php echo $this->strings['category'] ?></label>
                                        <select name="category" id="i-category" class="form-control" required>
                                            <option value=""><?php echo $this->strings['select_category'] ?></option>
                                            <?php
                                            foreach ($this->categories as $index => $category) { ?>
                                                <option value="<?php echo $category['id'] ?>" <?php if ($category['id'] == $this->bookDetails['category_id']) echo "selected" ?>>
                                                    <?php echo $category['name'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-pdf"><?php echo $this->strings['pdf_optional'] ?></label>
                                        <input type="file" name="pdf" id="i-pdf" class="form-control">
                                    </div>
                                    <div class="col-12 col-xs-12 col-md-6 form-group">
                                        <label for="i-image"><?php echo $this->strings['image'] ?></label>
                                        <input type="file" name="image" id="i-image" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <input class="btn btn-primary" type="submit" value="<?php echo $this->strings['save'] ?>">
                                    </div>

                                </form>
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