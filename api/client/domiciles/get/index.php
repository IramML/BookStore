<?php
require './APIGetDomiciles.php';
$api = new APIGetDomiciles();

if (isset($_GET['token'])) {
    $userID = $api->getClientIDByToken($_GET['token']);
    
    if(!empty($userID)) {
        $domiciles = $api->getDomicilesByUserID($userID);

        if (!empty($domiciles)) {
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'domiciles' => $domiciles]);
        } else 
            $api->error("No domiciles");
    } else 
        $api->error("Invalid user");
} else 
    $api->error("Error when calling API");