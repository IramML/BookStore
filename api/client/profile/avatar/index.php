<?php
require './APIUpdateAvatar.php';
$api = new APIUpdateAvatar();

if (isset($_POST['token']) && isset($_POST['image'])) {
    $data = [
        'user_id' => $api->getClientIDByToken($_POST['token']),
        'image' => $_POST['image'],
        'image_name' => '',
    ];
    if (!empty($data['user_id'])) {
        $data['image_name'] = $api->saveImage(
            $data['image'],
            substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz', 5)), 0, 60) . ".png"
        );
        if (!empty($data['image_name'])) {
            if ($api->updateAvatar($data)) {
                $api->printJSON(['code' => '200', 'message' => 'Request successfully']);
            } else
                $api->error("Error when updating data");
        } else
            $api->error("Error when saving image");
    } else
        $api->error("Invalid user");
} else
    $api->error("Error when calling API");
