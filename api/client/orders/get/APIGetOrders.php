<?php
include '../../../includes/api.php';
include './GetOrdersModel.php';

class APIGetOrders extends API {
    private $model;

    function __construct() {
        $this->model=new GetOrdersModel();
    }

    function getClientIDBByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function getOrdersByUserID($userID) {
        return $this->model->getOrdersByUserID($userID);
    }
}