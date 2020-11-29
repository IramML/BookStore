<?php
require './APIOrderDetails.php';
$api = new APIOrderDetails();

if (isset($_GET['token']) && isset($_GET['order_id'])) {
    $data = [
        'user_id' => $api->getClientIDByToken($_GET['token']),
        'order_id' => $_GET['order_id']
    ];

    if (!empty($data['user_id'])) {
        $order = $api->getOrder($data);

        if (!empty($order)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'order' => $order]);
        } else 
            $api->error("Error when obtaining order");
    } else 
        $api->error("Invalid user");
} else 
    $api->error("Error when calling API");