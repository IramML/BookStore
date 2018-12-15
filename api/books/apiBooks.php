<?php
    include_once '../../includes/Objects/Books.php';
    include_once '../../includes/Objects/Clients.php';
    include_once '../../includes/Objects/Orders.php';
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
            if ($res->rowCount()>0) {
                $books['code'] = 200;
                $books["books"] = array();
                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                    $book = array(
                        'id' => $row['b_code'],
                        'title' => $row['title'],
                        'num_pages' => $row['num_pages'],
                        'editorial' => $row['editorial'],
                        'author' => $row['author'],
                        'cost' => $row['cost'],
                        'is_pdf'=>''
                    );
                    if($booksObject->existPDF($book['id']))$book['is_pdf']='yes';
                    else $book['is_pdf']='no';
                    array_push($books["books"], $book);

                }
               $this->printJSON($books);
            } else {
                $this->error('There are no elements');
            }
        }
        function getBooksToClient($token){
            $clientObject=new Clients();
            $booksObject=new Books();
            $idClient='';
            $resUserID= $clientObject->getUserIDByToken($token);
            if ($resUserID->rowCount()>0){
                while ($row=$resUserID->fetch(PDO::FETCH_ASSOC)){
                    $idClient=$row['id_client'];
                }

                //then filter books
                $ordersObject=new Orders();
                $resOrders=$ordersObject->getOrdersByClientID($idClient);
                if($resOrders->rowCount()>0){
                    $purchasedBooks=array();
                    while($rowOrders=$resOrders->fetch(PDO::FETCH_ASSOC)){
                        array_push($purchasedBooks, $rowOrders['book_code']);
                    }
                    $res = $booksObject->getbooks();
                    if ($res->rowCount()>0) {
                        $books = array('code' => 200, 'books' => array());
                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                            $book = array(
                                'id' => $row['b_code'],
                                'title' => $row['title'],
                                'pages' => $row['num_pages'],
                                'editorial' => $row['editorial'],
                                'author' => $row['author'],
                                'cost' => $row['cost'],
                                'image' => $row['b_image'],
                                'is_pdf'=>''
                            );
                            if($booksObject->existPDF($book['id']))$book['is_pdf']='yes';
                            else $book['is_pdf']='no';
                            if(!$this->isPurchased($purchasedBooks, $book))
                                array_push($books["books"], $book);
                        }
                        $this->printJSON($books);
                    }
                }else{
                    $res = $booksObject->getbooks();
                    if ($res->rowCount()>0) {
                        $books = array('code'=>200, 'books'=>array());
                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                            $book = array(
                                'id'=>$row['b_code'],
                                'title'=>$row['title'],
                                'pages'=>$row['num_pages'],
                                'editorial'=>$row['editorial'],
                                'author'=>$row['author'],
                                'cost'=>$row['cost'],
                                'image'=>$row['b_image'],
                                'is_pdf'=>''
                            );
                            if($booksObject->existPDF($book['id']))$book['is_pdf']='yes';
                            else $book['is_pdf']='no';
                            array_push($books["books"], $book);
                        }
                        $this->printJSON($books);
                    } else {
                        $this->error('There are no elements');
                    }
                }
            }else $this->error('No user');
        }
        function isPurchased($idBooks, $book){
            $isDuplicate=false;
            foreach ($idBooks as $idBook) {
                if($isDuplicate) break;
                if ($idBook == $book['id']) $isDuplicate = true;
            }
            return $isDuplicate;
        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>