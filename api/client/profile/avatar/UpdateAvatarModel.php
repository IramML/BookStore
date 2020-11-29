<?php
include '../../../includes/model.php';

class UpdateAvatarModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    function updateAvatar($data){
        try {
            $this->db->connect()->query("UPDATE client_user
                SET image = '$data[image_name]'
                WHERE id = '$data[user_id]'");

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}