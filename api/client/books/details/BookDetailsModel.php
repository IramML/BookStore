<?php
include '../../../includes/model.php';

class BookDetailsModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getBookByID($bookID){
        try {
            $query = $this->db->connect()->query("SELECT * FROM book WHERE id = '$bookID'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
}