<?php 
    include_once 'books.php';
    class ApiBooks{
        function getAll(){
            $booksObject=new Books();
            $books=array();
            $res=$booksObject->getbooks();
            if($res->rowCount()){
                $books['code']=200;
                $books["books"]=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $book=array(
                        'id'=>$row['b_code'],
                        'title'=>$row['title'],
                        'num_pages'=>$row['num_pages'],
                        'editorial'=>$row['editorial'],
                        'author'=>$row['author'],
                        'cost'=>$row['cost']
                    );
                    array_push($books["books"], $book);
                    
                }
                echo json_encode($books);
            }else{
                $books['code']=404;
                echo json_encode(array('message'=>'There are no elements'));
            }
        }
    }
?>