<?php
include_once '../../includes/Objects/Books.php';
    class ApiBooks{
        function getAll(){
            $booksObject = new Books();
            $books = array();
            $res = $booksObject->getbooks();
            if ($res->rowCount()) {
                $books['code'] = 200;
                $books["books"] = array();
                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                    $book = array(
                        'id'=>$row['b_code'],
                        'title'=>$row['title'],
                        'pages'=>$row['num_pages'],
                        'editorial'=>$row['editorial'],
                        'author'=>$row['author'],
                        'cost'=>$row['cost'],
                        'image'=>$row['b_image']
                    );
                    array_push($books["books"], $book);
                }
                $this->printJSON($books);
            } else {
                $this->error('There are no elements');
            }
        }

        function getById($id){
            $booksObject = new Books();
            $books = array();
            $res = $booksObject->getBook($id);
            if ($res->rowCount()) {
                $books['code'] = 200;
                $books["books"] = array();
                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                    $book = array(
                        'id' => $row['b_code'],
                        'title' => $row['title'],
                        'num_pages' => $row['num_pages'],
                        'editorial' => $row['editorial'],
                        'author' => $row['author'],
                        'cost' => $row['cost']
                    );
                    array_push($books["books"], $book);

                }
               $this->printJSON($books);
            } else {
                $this->error('There are no elements');
            }
        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>