<?php
include '../../../includes/model.php';

class GetDomicilesAPI extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getDomicilesByUserID($userID){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM client_user_domicile WHERE user_id = '$userID' AND is_archived = 0");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
}