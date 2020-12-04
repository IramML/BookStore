<?php
class clientsModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getAllUsers(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT id, first_name, last_name, email, image FROM client_user ORDER BY id DESC");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
}