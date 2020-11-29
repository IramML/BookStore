<?php
require './APIGetProfile.php';
$api = new APIGetProfile();

if (isset($_GET['token'])) {
    $userID = $api->getClientIDByToken($_GET['token']);

    if (!empty($userID)) {
        $profile = $api->getProfileByUserID($userID);
        if (!empty($profile)){
            $api->printJSON(['code' => '200', 'message' => 'Request successfully', 'user' => $profile]);
        } else
            $api->error("Error when getting profile");
    }else
        $api->error("Invalid user");
} else
    $api->error("Error when calling API");