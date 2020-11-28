<?php

class mainModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function countActiveAccounts(){
        try{
            $query=$this->db->connect()->query("SELECT COUNT(*) AS total FROM professional_user WHERE status='approved'");
            return $query->fetch(PDO::FETCH_OBJ)->total;
        }catch (PDOException $e){
            return 0;
        }
    }
    function getUsers(){
        $users=[];
        try {
            $query=$this->db->connect()->query("SELECT * FROM professional_user ORDER BY id DESC LIMIT 5");

            while($row=$query->fetch()){
                array_push($users, $row);
            }
            return $users;
        } catch (PDOException $e) {
            return [];
        }
    }
    function approveUserByID($userID){
        try {
            $this->db->connect()->query("UPDATE professional_user
                    SET status='approved'
                    WHERE id='$userID'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    function rejectUserByID($userID){
        try {
            $this->db->connect()->query("UPDATE professional_user
                    SET status='rejected'
                    WHERE id='$userID'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

