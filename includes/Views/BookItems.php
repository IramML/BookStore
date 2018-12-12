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
                        'id'=>$row['c_code'],
                        'name'=>$row['c_name'],
                        'last_name'=>$row['last_name'],
                        'email'=>$row['email'],
                        'password'=>$row['password'],
                        'phone'=>$row['phone'],
                        'age'=>$row['age']
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
                        <div class="book-information">
                            <p class="book-code item"><?php echo $row['b_code']?></p>
                            <p class="book-title item"><?php echo $row['title']?></p>
                            <p class="book-editorial item"><strong>Editorial:</strong> <?php echo $row['editorial']?></p>
                            <p class="book-author item"><strong>Author:</strong> <?php echo $row['author']?></p>
                            <p class="book-num-pages item"><strong>number of pages:</strong> <?php echo $row['num_pages']?></p>
                            <p class="book-cost item"><strong>Cost:</strong> <?php echo $row['cost']?>$</p>
                        </div>
                        <form method="POST" class="book-options" action="books.php" id="form<?php echo $row['b_code'];?>">
                            <input type="hidden" name="delete" value="<?php echo $row['b_code'];?>">
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