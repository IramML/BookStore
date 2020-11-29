<?php
include '../../../includes/model.php';

class SignUpModel extends Model{
    public function __construct(){
        parent::__construct();
    }
    function emailExists($email){
        try {
            $query = $this->db->connect()->query("SELECT count(*) as total FROM client_user WHERE email = '$email'");
            $total = $query->fetch(PDO::FETCH_OBJ)->total;
            return $total>0;
        } catch (PDOException $e) {
            return false;
        }
    }
    function saveUser($data){
        try {   
            $conn=$this->db->connect();
            $conn->exec("INSERT INTO client_user(first_name, last_name, email, password, image)
                VALUES('$data[first_name]', '$data[last_name]', '$data[email]', '$data[hash]', '$data[image_name]')");

            $userID=$conn->lastInsertId();
            $this->db->connect()->query("INSERT INTO client_user_token(access_token, user_id)
                    VALUES('$data[access_token]', '$userID')");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}