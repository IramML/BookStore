<?php
include '../../../includes/api.php';
include './BuyBookModel.php';

class APIBuyBook extends API {
    private $model;

    function __construct() {
        $this->model = new BuyBookModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function buyPhysicBook($data){
        $data['domicile_id'] = $_POST['domicile_id'];
        return $this->model->buyPhysicBook($data);
    }

    function buyPDFBook($data){
        return $this->model->buyPDFBook($data);
    }

    function isAlreadyPDFOrdered($data){
        return $this->model->isAlreadyPDFOrdered($data);
    }
}