<?php
include '../../../includes/api.php';
include './AddDomicileModel.php';

class APIAddDomicile extends API {
    private $model;

    function __construct() {
        $this->model = new AddDomicileModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function addDomicile($data) {
        return $this->model->addDomicile($data);
    }
}