<?php
    include_once '/xampp/htdocs/bookstore/includes/Objects/Orders.php';
    class OrderItems{
        public function getAllItems(){
            $ordersObject=new Orders();
            $orders=array();
            $res=$ordersObject->getOrders();
            if($res->rowCount()>0){
                while ($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $orders['orders']=array();
                    $order=array(
                        'order_num'=>$row['order_num'],
                        'client_code'=>$row['client_code'],
                        'book_code'=>$row['book_code'],
                        'buy_date'=>$row['buy_date']
                    );
                    array_push($orders['orders'], $order);
                }
                $this->showItems($orders);
            }else $this->error("There are no clients");
        }
        function showItems($orders){
            foreach ($orders['orders'] as $order) {
                ?>
                <div class="order">
                    <div class="order-information">
                        <p class="order-code item"><?php echo "<strong>".$order['order_num']."</strong>";?> </p>
                        <p class="client-code item"><?php echo "<strong>".$order['client_code']."</strong>"." - ";
                            include_once '/xampp/htdocs/bookstore/includes/Objects/Clients.php';
                            $clientObject=new Clients();
                            $res=$clientObject->getClient($order['client_code']);
                            if($res->rowCount()){
                                while ($row=$res->fetch(PDO::FETCH_ASSOC)){
                                    echo $row['c_name']." ".$row['last_name'];
                                }
                            } ?></p>
                        <p class="book-code item"><?php echo "<strong>".$order['book_code']."</strong>"." - ";
                            include_once '/xampp/htdocs/bookstore/includes/Objects/Books.php';
                            $bookObject=new Books();
                            $res=$bookObject->getBook($order['book_code']);
                            if($res->rowCount()){
                                while ($row=$res->fetch(PDO::FETCH_ASSOC)){
                                    echo $row['title'];
                                }
                            } ?></p>
                        <p class="buy-date item"><strong>Buy date:</strong> <?php echo date('d/m/Y',strtotime($order['buy_date']));?></p>
                    </div>
                </div>
                <?php
            }
        }
        function error($message){

        }
    }
?>