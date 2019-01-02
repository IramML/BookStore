<?php
require 'models/order.php';
class ordersModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        $items=[];
        try{
            $query=$this->db->connect()->query('SELECT * FROM orders');
            while($row=$query->fetch()){
                $order=new Order();
                $order->numOrder=$row['order_num'];
                $order->clientCode=$row['client_code'];
                $order->bookCode=$row['book_code'];
                $order->buyDate=$row['buy_date'];
                array_push($items, $order);
            }
            return $items;
        }catch (PDOException $e){
            return [];
        }
    }
    function physicalOrder($data){
        return true;
    }
}