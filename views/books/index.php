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
    <li class="active"><a href="<?php echo constant('URL'); ?>Books"><i class="fas fa-book"></i> <span>Books</span></a></li>
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
        Books
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Books</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div id="title">
            <h2 class="center"></h2>
            <a id="add-book" href="<?php constant('URL')?>books/register"><img class="option" src="public/img/plus.png" alt="Add book"></a>
        </div>
        <div id="book-content">
            <?php
                include_once 'models/book.php';
                foreach($this->books as $item){
                    $book=new Book();
                    $book=$item;
                    ?>
                    <div class="book">
                        <img class="book-img" src="<?php echo constant('URL').$book->bImage?>" alt="<?php echo $book->title?>">
                        <div class="book-information">
                            <p class="book-code item"><?php echo $book->code?></p>
                            <p class="book-title item"><?php echo $book->title?></p>
                            <p class="book-editorial item"><strong>Editorial:</strong> <?php echo $book->editorial?></p>
                            <p class="book-author item"><strong>Author:</strong> <?php echo $book->author?></p>
                            <p class="book-num-pages item"><strong>number of pages:</strong> <?php echo $book->numPages?></p>
                            <p class="book-cost item"><strong>Cost:</strong> <?php echo $book->cost?>$</p>
                        </div>
                        <form method="POST" class="book-options" action="books.php" id="form<?php echo $book->code;?>">
                            <input type="hidden" name="delete" value="<?php echo $book->code;?>">
                            <input class="option" type="image" src="<?php constant('URL')?>public/img/trash.png" alt="Delete book" />
                        </form>
                    </div>
                    <?php
                }
            ?>
        </div>

    </section>
    <!-- /.content -->
  </div>
<?php require_once 'views/footer.php'?>