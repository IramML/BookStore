<?php
    include_once 'apiClients.php';
    $api=new ApiClients();
    if(isset($_POST['email'])&& isset($_POST['password'])){
        $data=array(
            'email'=>$_POST['email'],
            'password'=>$_POST['password']
        );
        $api->login($data);
    }else{
        $api->error('Error calling the API');
    }
?>