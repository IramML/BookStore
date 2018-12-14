<?php 
    include_once '../../includes/Objects/Orders.php';
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
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>