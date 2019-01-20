<?php
require 'models/booksModel.php';
require 'models/clientsModel.php';
require 'models/ordersModel.php';
class apiModel extends Model{
    function __construct(){
        parent::__construct();
        $this->clientsModel=new clientsModel();
        $this->booksModel=new booksModel();
        $this->ordersModel=new ordersModel();
    }
    function getTokenByID($ID){
        return $this->clientsModel->getTokenById($ID);
    }
    function validateToken($token){
        return $this->clientsModel->validateToken($token);
    }
    function getAllBooks(){
        return $this->booksModel->getAll();
    }
    function getIdByToken($token){
        return $this->clientsModel->getIdByToken($token);
    }
    function getOrdersByClientID($ID){
        return $this->ordersModel->getOrdersByClientID($ID);
    }
    function existPDF($bookCode){
        return $this->booksModel->existPDF($bookCode);
    }
    function existPhysical($bookCode){
        return $this->booksModel->existPhysical($bookCode);
    }
    function getPasswordByEmail($email){
        return $this->clientsModel->getPasswordByEmail($email);
    }
    function getClientIdByEmail($email){
        return $this->clientsModel->getClientIdByEmail($email);
    }
    function getUserByID($ID){
        return $this->clientsModel->getClientById($ID);
    }
    function getAvatarByIDUser($ID){
        return $this->clientsModel->getAvatarByIDUser($ID);
    }
    function uploadAvatar($data){
        return $this->clientsModel->uploadAvatar($data);
    }
}