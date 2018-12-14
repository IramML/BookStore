<?php
    include_once 'apiDomiciles.php';
    $api=new ApiDomiciles();

    if(isset($_POST['token']) && isset($_POST['postal_code']) && isset($_POST['colony']) && isset($_POST['state'])
       && isset($_POST['municipality']) && isset($_POST['street']) && isset($_POST['outdoor_number'])){
        $data=array(
            'code'=>200,
            'token'=>$_POST['token'],
            'idClient'=>'',
            'CP'=>$_POST['postal_code'],
            'colony'=>$_POST['colony'],
            'state'=>$_POST['state'],
            'municipality'=>$_POST['municipality'],
            'street'=>$_POST['street'],
            'outNumber'=>$_POST['outdoor_number']
        );
        $api->registerClientDomicile($data);
    }else
        $api->error('Error calling the API');
?>