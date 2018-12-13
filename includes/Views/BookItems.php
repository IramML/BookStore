<?php
include_once '/xampp/htdocs/bookstore/includes/Objects/Books.php';
    class BookItems{
        function getAllItems(){
            $booksObject=new Books();
            $books=array();
            $res=$booksObject->getBooks();
            if($res->rowCount()){
                $books['books']=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $book=array(
                        'id'=>$row['b_code'],
                        'title'=>$row['title'],
                        'pages'=>$row['num_pages'],
                        'editorial'=>$row['editorial'],
                        'author'=>$row['author'],
                        'cost'=>$row['cost'],
                        'image'=>$row['b_image']
                    );
                    array_push($books['books'], $book);
                }
                $this->showItems($books);
            }else $this->error("There are no clients");
        }
        function showItems($books){
            foreach ($books['books'] as $book) {
                ?>
                    <div class="book">
                        <img class="book-img" src="<?php echo $book['image']?>" alt="<?php echo $book['title']?>">
                        <div class="book-information">
                            <p class="book-code item"><?php echo $book['id']?></p>
                            <p class="book-title item"><?php echo $book['title']?></p>
                            <p class="book-editorial item"><strong>Editorial:</strong> <?php echo $book['editorial']?></p>
                            <p class="book-author item"><strong>Author:</strong> <?php echo $book['author']?></p>
                            <p class="book-num-pages item"><strong>number of pages:</strong> <?php echo $book['pages']?></p>
                            <p class="book-cost item"><strong>Cost:</strong> <?php echo $book['cost']?>$</p>
                        </div>
                        <form method="POST" class="book-options" action="books.php" id="form<?php echo $book['id'];?>">
                            <input type="hidden" name="delete" value="<?php echo $book['id'];?>">
                            <input class="option" type="image" src="img/trash.png" alt="Delete book" />
                        </form>
                    </div>
                <?php
            }
        }
        function error($message){

        }
    }
?>