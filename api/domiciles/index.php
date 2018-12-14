<?php
    include_once 'apiDomiciles.php';
    $api=new ApiDomiciles();
    if(isset($_GET['token'])){
        $api->getClientDomiciles($_GET['token']);
    }else
        $api->error('Error calling the API');
?>