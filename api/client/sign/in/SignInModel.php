<?php

include '../../../includes/model.php';

class SignInModel extends Model{
    public function __construct(){
        parent::__construct();
    }
    function getUserIDByEmail($email){
        try {
            $query=$this->db->connect()->prepare('SELECT id FROM client_user WHERE email=:email');
            $query->execute(['email'=>$email]);
            $res=$query->fetch();

            if(empty($res))
                return $email;
        
            $userID=$res['id'];
            return $userID;
        } catch (PDOException $e) {
            return '';
        }
    }
    function getHashByUserID($userID){
        try {
            $query=$this->db->connect()->prepare("SELECT password FROM client_user where id=:user_id");
            $query->execute(['user_id'=>$userID]);
            $res=$query->fetch();
            if(empty($res))
                return '';

            $hash=$res['password'];
            return $hash;
        } catch (PDOException $e) {
            return '';
        }
    }
    function getAccessTokenByUserID($userID){
        try {
            $query=$this->db->connect()->prepare("SELECT access_token FROM client_user_token WHERE user_id=:user_id");
            $query->execute(['user_id'=>$userID]);
            $res=$query->fetch();
            if(empty($res))
                return '';

            $accessToken=$res['access_token'];
            return $accessToken;
        } catch (PDOException $e) {
            return '';
        }
    }
}