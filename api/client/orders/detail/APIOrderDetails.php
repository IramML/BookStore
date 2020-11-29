<?php
include '../../../includes/api.php';
include './OrderDetailsModel.php';

class APIOrderDetails extends API {
    private $model;

    function __construct() {
        $this->model = new OrderDetailsModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function getOrder($data){
        return $this->model->getOrderDetails($data);
    }
}