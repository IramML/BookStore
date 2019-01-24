<?php
require 'models/booksModel.php';
require 'models/clientsModel.php';
require 'models/ordersModel.php';
require 'models/domicilesModel.php';
class apiModel extends Model{
    function __construct(){
        parent::__construct();
        $this->clientsModel=new clientsModel();
        $this->booksModel=new booksModel();
        $this->ordersModel=new ordersModel();
        $this->domicilesModel=new domicilesModel();
    }
    //Client
    function getTokenByID($ID){
        return $this->clientsModel->getTokenById($ID);
    }
    function validateToken($token){
        return $this->clientsModel->validateToken($token);
    }
    function getIdByToken($token){
        return $this->clientsModel->getIdByToken($token);
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
    function isClientIDDuplicate($ID){
        return $this->clientsModel->isClientIDDuplicate($ID);
    }
    function registerApplication($data){
        return $this->clientsModel->registerApplication($data);
    }
     //Books
    function getAllBooks(){
        return $this->booksModel->getAll();
    }
    function getBookByCode($code){
        return $this->booksModel->getBookByCode($code);
    }
    function existPDF($bookCode){
        return $this->booksModel->existPDF($bookCode);
    }
    function existPhysical($bookCode){
        return $this->booksModel->existPhysical($bookCode);
    }
    //Orders
    function getOrdersByClientID($ID){
        return $this->ordersModel->getOrdersByClientID($ID);
    }
    //Domiciles
    function getDomicilesByClientID($ID){
        return $this->domicilesModel->getDomicilesByClientID($ID);
    }
}