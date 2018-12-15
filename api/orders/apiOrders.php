<?php 
    include_once '../../includes/Objects/Orders.php';
    include_once '../../includes/Objects/Clients.php';
    include_once '../../includes/Objects/Books.php';
    class ApiOrders{
        function getAll(){
            $ordersObject=new orders();
            $orders=array();
            $res=$ordersObject->getorders();
            if($res->rowCount()){
                $orders['code']=200;
                $orders["orders"]=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $order=array(
                        'order_num'=>$row['order_num'],
                        'user_code'=>$row['client_code'],
                        'book_code'=>$row['book_code'],
                        'buy_date'=>$row['buy_date']
                    );
                    array_push($orders["orders"], $order);
                }
                $this->printJSON($orders);
            }else{
                $this->error('There are no elements');
            }
        }
        function getById($id){
            $ordersObject=new orders();
            $orders=array();
            $res=$ordersObject->getorder($id);
            if($res->rowCount()){
                $orders['code']=200;
                $orders["orders"]=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $order=array(
                        'order_num'=>$row['order_num'],
                        'user_code'=>$row['client_code'],
                        'book_code'=>$row['book_code'],
                        'buy_date'=>$row['buy_date']
                    );
                    array_push($orders["orders"], $order);
                }
                $this->printJSON($orders);
            }else{
                $this->error('There are no elements');
            }
        }
        function getClientOrders($token){
            $clientObject=new Clients();
            $ordersObject=new Orders();
            $idUser='';
            $resUserID=$clientObject->getUserIDByToken($token);
            if($resUserID->rowCount()>0){
                while ($rowUserID=$resUserID->fetch(PDO::FETCH_ASSOC)){
                    $idUser=$rowUserID['id_client'];
                }
                $resOrders=$ordersObject->getOrdersByClientID($idUser);
                if($resOrders->rowCount()>0){
                    $books = array('code'=>200, 'books'=>array());
                    while ($rowOrders=$resOrders->fetch(PDO::FETCH_ASSOC)){
                        $bookObject=new Books();
                        $resBooks=$bookObject->getBook($rowOrders['book_code']);
                        if($resBooks->rowCount()>0){
                            while($rowBook=$resBooks->fetch(PDO::FETCH_ASSOC)){
                                $book = array(
                                    'id'=>$rowBook['b_code'],
                                    'title'=>$rowBook['title'],
                                    'pages'=>$rowBook['num_pages'],
                                    'editorial'=>$rowBook['editorial'],
                                    'author'=>$rowBook['author'],
                                    'cost'=>$rowBook['cost'],
                                    'image'=>$rowBook['b_image'],
                                    'is_pdf'=>''
                                );
                                if($bookObject->existPDF($book['id']))$book['is_pdf']='yes';
                                else $book['is_pdf']='no';
                                array_push($books["books"], $book);
                            }
                        }else
                            $this->error('There are no elements');
                    }
                    $this->printJSON($books);
                }else{
                    $this->error('There are no elements');
                }
            }else
                $this->error('No ID user');
        }
        function downloadPDF(){

        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>