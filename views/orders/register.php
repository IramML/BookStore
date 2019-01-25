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
        Register
        <small>Orders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo constant('URL'); ?>Orders""><i class="fa fa-dashboard"></i> Orders</a></li>
        <li class="active">Register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form action="<?php echo constant('URL')?>orders/register" id="form" method="POST">
        <h2>Register new order</h2>
        <?php
        if ($this->message!="")
            if($this->message=="Successfully registered order")
                echo '<h3 class="correct center">'.$this->message.'</h3>';
            else
                echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <select name="client_code" id="">
            <option value="">Select a client code</option>
            <?php
                include_once 'models/client.php';
                foreach ($this->clients as $row){
                    $client=new Client();
                    $client=$row;
                    ?>
                    <option value="<?php echo $client->code?>"><?php echo $client->code." - ".$client->name?></option>
                    <?php
                }
            ?>

        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>
            <?php
            include_once 'models/book.php';
            foreach ($this->books as $row){
                $book=new Book();
                $book=$row;
                ?>
                <option value="<?php echo $book->code?>"><?php echo $book->code." - ".$book->title?></option>
                <?php
            }
            ?>
        </select>
        <input type="submit" id="btn-save" value="Save">
    </form>

    </section>
    <!-- /.content -->
  </div>
 <?php require_once 'views/footer.php'?>