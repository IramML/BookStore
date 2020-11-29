<?php
require './APISignUp.php';
$api = new APISignUp();

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'image_name' => '',
        'access_token' => '',
    ];


    if (!$api->isEmailTaken($data['email'])) {
        if (isset($_POST['image'])){
            $data['image_name'] = $api->saveImage($_POST['image'],
                substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz',5)), 0, 60).".png");
        }
        $data['access_token'] = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz', 5)), 0, 70);
        if ($api->saveUser($data)) {
            $api->printJSON(['code' => '200', 'message' => 'User created successfully', 'access_token' => $data['access_token']]);
        } else
            $api->error("Error when saving user");
    } else
        $api->error("Email already taken");
} else
    $api->error("Error when calling API");
