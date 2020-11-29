<?php
require './APIAddDomicile.php';
$api = new APIAddDomicile();

if (isset($_POST['token']) && isset($_POST['postal_code']) && isset($_POST['country'])
 && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['street']) 
 && isset($_POST['outdoor_number']) ) {
    $data = [ 
        'user_id' => $api->getClientIDByToken($_POST['token']),
        'postal_code' => $_POST['postal_code'],
        'country' => $_POST['country'],
        'state' => $_POST['state'],
        'city' => $_POST['city'],
        'street' => $_POST['street'],
        'outdoor_number' => $_POST['outdoor_number'],
    ];

    if (!empty($data['user_id'])) {
        if ($api->addDomicile($data)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully']);
        } else 
            $api->error("Error when inserting data");
    }else
        $api->error("Invalid user");
} else
    $api->error("Error when calling API");