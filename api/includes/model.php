<?php
include_once 'db.php';

class Model{
    public $db;

    function __construct(){
        $this->db = new DB();
    }

    function getClientIDByToken($token){
        try {
            $query = $this->db->connect()->prepare('SELECT user_id FROM client_user_token 
                            WHERE access_token=:token');
            $query->execute(['token'=>$token]);
            $res = $query->fetch();

            if(empty($res['user_id']))
                return "";

            return $res['user_id'];
        } catch (PDOException $ex) {
            return "";
        }
    }

}