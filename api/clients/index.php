<?php
    include_once 'apiClients.php';
    $api =new ApiClients();
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        if(is_numeric($id)){
            $api->getById($id);
        }else{
            $api->error('The id is wrong');
        }
    }else $api->getAll();
?>