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
        Register
        <small>Books</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo constant('URL'); ?>Books"><i class="fa fa-dashboard"></i> Books</a></li>
        <li class="active">Register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <form id="form" method="POST" action="<?php echo constant('URL')?>books/register" enctype="multipart/form-data">
        <h2>Register new book</h2>
        <?php
        if ($this->message!="")
            if($this->message=="Successfully registered book")
                echo '<h3 class="correct center">'.$this->message.'</h3>';
            else
                echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <div class="field-conteiner">
            <p>Code:</p>
            <input name="code" type="text" class="field" placeholder="NDA97532" value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Title:</p>
            <input name="title" type="text" class="field" placeholder="Title..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>number of pages:</p>
            <input type="number"  value="300" name="num_pages" min="1" max="1267069" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Editorial:</p>
            <input name="editorial" type="text" class="field" placeholder="Editorial..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Author:</p>
            <input name="author" type="text" class="field" placeholder="Name..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Cost:</p>
            <input type="number"  value="200" name="cost" min="1" max="100000000" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Upload image:</p>
            <input type="file" name="file" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Physical book:</p>
            <input type="radio" name="there_physical" value="yes" checked>Yes<br/>
            <input type="radio" name="there_physical" value="no">No<br/>
        </div>
        <div class="field-conteiner">
            <p>Upload PDF (optional if there is no a physical book):</p>
            <input type="file" name="filePDF"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
    </section>
    <!-- /.content -->
  </div>
<?php require_once 'views/footer.php'?>