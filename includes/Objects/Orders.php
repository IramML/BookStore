<?php
    include_once '/xampp/htdocs/bookstore/includes/db.php';
    class Orders extends DB{
        function getOrders(){
            $query = $this->connect()->query('SELECT * FROM orders');
            return $query;
        }
        function getOrder($id){
            $query = $this->connect()->prepare('SELECT * FROM orders where order_num=:id');
            $query->execute(['id'=>$id]);
            return $query;
        }
        function registerOrder($idClient, $idBook){
            $query=$this->connect()->prepare('INSERT INTO orders(client_code, book_code)
                                            VALUES(:idClient, :idBook)');
            if($query->execute(['idClient'=>$idClient, 'idBook'=>$idBook])===false)
                die("Error when inserting data");

        }
        function getOrdersByClientID($id){
            $query=$this->connect()->prepare('SELECT * FROM orders WHERE client_code=:id');
            $query->execute(['id'=>$id]);
            return $query;
        }
    }
?>