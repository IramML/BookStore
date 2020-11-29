<?php
include '../../../includes/api.php';
include './GetBooksModel.php';

class APIGetBooks extends API {
    private $model;

    function __construct() {
        $this->model=new GetBooksModel();
    }

    function getClientIDByToken($token){
        return $this->model->getClientIDByToken($token);
    }

    function getBooks(){
        return $this->model->getBooks();
    }
}