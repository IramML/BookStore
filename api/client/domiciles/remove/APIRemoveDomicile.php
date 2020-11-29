<?php
include '../../../includes/api.php';
include './RemoveDomicileModel.php';

class APIRemoveDomicile extends API {
    private $model;

    function __construct() {
        $this->model = new RemoveDomicileModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function removeDomicile($data){
        if ($this->model->isDomicileInUse($data)) {
            return $this->model->archiveDomicile($data);
        } else {
            return $this->model->removeDomicile($data);
        }
    }
}