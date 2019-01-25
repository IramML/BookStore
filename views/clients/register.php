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
        Register
        <small>Clients</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo constant('URL');?>clients"><i class="fa fa-dashboard"></i> Clients</a></li>
        <li class="active">Register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form id="form" action="<?php echo constant('URL')?>clients/register" method="POST">
        <h2>Create new user</h2>
        <?php
            if ($this->message!="")
                if($this->message=="Successfully registered client")
                    echo '<h3 class="correct center">'.$this->message.'</h3>';
                else
                    echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <div class="field-conteiner">
            <p>Name:</p>
            <input name="name" type="text" class="field" placeholder="Name..." value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Last name:</p>
            <input name="last_name" type="text" class="field" placeholder="Last name..." value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Phone:</p>
            <input name="phone" type="text" class="field" placeholder="1234567890" value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Age:</p>
            <input type="number"  value="18" name="age" min="1" max="120" required><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
    </section>
    <!-- /.content -->
  </div>
    <?php require_once 'views/footer.php'?>