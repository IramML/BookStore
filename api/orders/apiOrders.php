<?php 
    include_once 'orders.php';
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
                        'user_code'=>$row['user_code'],
                        'book_code'=>$row['book_code'],
                        'loan_date'=>$row['loan_date'],
                        'delivery_date'=>$row['delivery_date'],
                        'delivered'=>$row['delivered']
                    );
                    array_push($orders["orders"], $order);
                    
                }
                echo json_encode($orders);
            }else{
                $orders['code']=200;
                echo json_encode(array('message'=>'There are no elements'));
            }
        }
    }
?>