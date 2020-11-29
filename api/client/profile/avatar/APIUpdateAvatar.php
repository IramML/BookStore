<?php
include '../../../includes/api.php';
include './UpdateAvatarModel.php';

class APIUpdateAvatar extends API{
    private $model;

    function __construct() {
        $this->model=new UpdateAvatarModel();
    }
    
    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function saveImage($base64Img, $imageName) {
        if (!$this->saveBase64PNG($base64Img, $imageName, "clients/images/"))
          return ''; 
          
        return $imageName;
    }

    function updateAvatar($data){
        return $this->model->updateAvatar($data);
    }
}