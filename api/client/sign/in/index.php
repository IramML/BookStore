<?php
require './APISignIn.php';
$api = new APISignIn();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'user_id' => $api->getUserIDByEmail($_POST['email']),
    ];
    if (!empty($data['user_id'])) {
        $token = $api->validateCredentials($data);
        if (!empty($token)) {
            $api->printJSON(['code' => '200', 'message' => 'Login successfull', 'access_token' => $token]);
        } else
            $api->error("Wrong password");
    } else
        $api->error("Email doesn't registered");
} else
    $api->error("Error when calling API");
