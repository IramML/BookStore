<?php
include '../../../includes/api.php';
include './BookDetailsModel.php';

class APIBookDetails extends API {
    private $model;

    function __construct() {
        $this->model=new BookDetailsModel();
    }

    function getClientIDByToken($token) {
        return $this->model->getClientIDByToken($token);
    }

    function getBookByID($bookID){
        return $this->model->getBookByID($bookID);
    }
}