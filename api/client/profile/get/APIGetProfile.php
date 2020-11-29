<?php
include '../../../includes/api.php';
include './GetProfileModel.php';

class APIGetProfile extends API {
    private $model;

    function __construct() {
        $this->model=new GetProfileModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function getProfileByUserID($userID) {
        return $this->model->getProfileByUserID($userID);
    }
}