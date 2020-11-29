<?php
include '../../../includes/api.php';
include './SignUpModel.php';

class APISignUp extends API {
    private $model;

    function __construct() {
        $this->model = new SignUpModel();
    }

    function isEmailTaken($email) {
        return $this->model->emailExists($email);
    }

    function saveImage($base64Img, $imageName) {
        if (!$this->saveBase64PNG($base64Img, $imageName, "clients/images/"))
          return ''; 
          
        return $imageName;
    }

    function saveUser($data) {
        $data['hash'] = password_hash($data['password'], PASSWORD_DEFAULT, ['cost'=>10]);
        return $this->model->saveUser($data);
    }
}