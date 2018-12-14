<?php
    include_once 'apiClients.php';
    $api=new ApiClients();
    if(isset($_POST['name']) && isset($_POST['last_name']) && isset($_POST['phone'])
        && isset($_POST['age']) && isset($_POST['email']) && isset($_POST['password'])){
        if(isset($_FILES['image'])) {
            $image = $_FILES['image'];
            if($image!=null) {
                if($api->loadImage($image)) {
                    $clientItem = array(
                        'id' => '',
                        'name' => $_POST['name'],
                        'last_name' => $_POST['last_name'],
                        'phone' => $_POST['phone'],
                        'age' => $_POST['age'],
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                        'image' => $api->getImage()
                    );
                    $api->registerApplicationClient($clientItem);
                }
            }
        }else{
            $clientItem=array(
                'id'=>'',
                'name'=>$_POST['name'],
                'last_name'=>$_POST['last_name'],
                'phone'=>$_POST['phone'],
                'age'=>$_POST['age'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
                'image'=>''
            );
            $api->registerApplicationClient($clientItem);
        }
    }else{
        $api->error('Error calling the API');
    }
?>