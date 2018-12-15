<?php
    include_once 'apiBooks.php';
    $api =new ApiBooks();
    if(isset($_GET['token'])){
        $api->getBooksToClient($_GET['token']);
    }else if(isset($_GET['id'])){
        $id=$_GET['id'];
        $api->getById($id);
    }else
        $api->getAll();
?>