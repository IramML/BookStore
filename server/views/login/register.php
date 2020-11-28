<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->strings['site_name']?> | <?php echo $this->strings['sign_up']?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo constant('URL');?>"><b><?php echo $this->strings['site_name']?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php echo $this->strings['sign_up_details']?></p>
        <form action="<?php echo constant('URL'); ?>login/register" method="post">
          <div class="form-group has-feedback">
            <input name="name" type="text" class="form-control" placeholder="<?php echo $this->strings['name']?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="email" type="email" class="form-control" placeholder="<?php echo $this->strings['email']?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="<?php echo $this->strings['password']?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password_verify" type="password" class="form-control" placeholder="<?php echo $this->strings['re_password']?>">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->strings['continue']?></button>
            </div>
          </div>
       </form>

    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo constant('URL'); ?>public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo constant('URL'); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo constant('URL'); ?>public/dist/js/adminlte.min.js"></script>

</body>
</html>

