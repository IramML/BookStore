<?php
    include_once 'apiBooks.php';
    $api =new ApiBooks();
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $api->getById($id);
    }else
        $api->getAll();
?>