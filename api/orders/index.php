<?php
    include_once 'apiOrders.php';
    $api =new ApiOrders();
    if(isset($_GET['token'])){
        $api->getClientOrders($_GET['token']);
    }else if(isset($_GET['id'])){
        $id=$_GET['id'];
        $api->getById($id);
    }else
        $api->getAll();
?>