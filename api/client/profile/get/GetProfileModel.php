<?php
include '../../../includes/model.php';

class GetProfileModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getProfileByUserID($userID) {
        try {
            $query = $this->db->connect()->query("SELECT * FROM client_user WHERE id = '$userID'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
}