<?php
include '../../../includes/api.php';
include './SignInModel.php';

class APISignIn extends API{
    private $model;
    function __construct(){
        $this->model=new SignInModel();
    }
    function getUserIDByEmail($email){
        return $this->model->getUserIDByEmail($email);
    }
    function validateCredentials($data){
        $hash=$this->model->getHashByUserID($data['user_id']);
        if(password_verify($data['password'], $hash)){
            return $this->model->getAccessTokenByUserID($data['user_id']);
        }else
            return '';
    }
}