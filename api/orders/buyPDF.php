<?php
    include_once 'apiOrders.php';
    $api=new ApiOrders();
    if(isset($_GET['token']) && isset($_GET['id_book']) ){
        $token=$_GET['token'];
        $idBook=$_GET['id_book'];
        $api->buyPDF($token, $idBook);
    }else $api->error('Error calling the API');
?>