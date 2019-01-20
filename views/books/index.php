<?php require_once 'views/header.php'?>
    <div id="title">
        <h2 class="center">Books</h2>
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
<?php require_once 'views/footer.php'?>