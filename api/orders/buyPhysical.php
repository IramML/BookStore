<?php
    include_once 'apiOrders.php';
    $api=new ApiOrders();
    if(isset($_GET['token']) && isset($_GET['id_book']) && isset($domicileID)){
        $token=$_GET['token'];
        $idBook=$_GET['id_book'];
        $api->buyPhysical($token, $idBook, $domicileID);
    }else $api->error('Error calling the API');
?>