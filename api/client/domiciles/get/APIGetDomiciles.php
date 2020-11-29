<?php
include '../../../includes/api.php';
include './GetDomicilesModel.php';

class APIGetDomiciles extends API {
    private $model;

    function __construct() {
        $this->model = new GetDomicilesAPI();
    }

    function getClientIDByToken($token){
        return $this->model->getClientIDByToken($token);
    }

    function getDomicilesByUserID($userID){
        return $this->model->getDomicilesByUserID($userID);
    }
}