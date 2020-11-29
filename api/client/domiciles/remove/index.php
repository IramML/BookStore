<?php
require './APIRemoveDomicile.php';
$api = new APIRemoveDomicile();

if (isset($_POST['token']) && isset($_POST['domicile_id'])) {
    $data = [
        'user_id' => $api->getClientIDByToken($_POST['token']),
        'domicile_id' => $_POST['domicile_id']
    ];

    if(!empty($data['user_id'])){
        if ($api->removeDomicile($data)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully']);
        } else 
            $api->error("Error when removing domicile");
    } else 
        $api->error("Invalid user");
} else 
    $api->error("Error when calling API");