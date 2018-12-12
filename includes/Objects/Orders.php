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
    }
?>