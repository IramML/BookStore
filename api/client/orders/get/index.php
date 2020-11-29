<?php
require './APIGetOrders.php';
$api = new APIGetOrders();

if (isset($_GET['token'])) {
    $userID = $api->getClientIDBByToken($_GET['token']);

    if (!empty($userID)) {
        $orders = $api->getOrdersByUserID($userID);
        if (!empty($orders)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'orders' => $orders]);
        } else 
            $api->error("No orders");
    } else
        $api->error("Invalid user");
} else
    $api->error("Error when calling API");