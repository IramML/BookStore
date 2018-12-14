<?php
include_once '/xampp/htdocs/bookstore/includes/Objects/Orders.php';

class RegisterOrder{
    function registerPhysicalOrder($idClient, $idBook){
        $orderObject=new Orders();
        $orderObject->registerOrder($idClient, $idBook);
    }
}