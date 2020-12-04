<?php
include '../../../includes/model.php';

class BuyBookModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function buyPhysicBook($data) {
        try {
            $this->db->connect()->query("INSERT INTO client_user_order(is_pdf, status, user_id, domicile_id, book_id)
                    VALUES(0, 'pending, '$data[user_id]', '$data[domicile_id]', '$data[book_id]')");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function buyPDFBook($data) {
        try {
            $this->db->connect()->query("INSERT INTO client_user_order(is_pdf, status, user_id, domicile_id, book_id)
                    VALUES(1, 'complete', '$data[user_id]', NULL, '$data[book_id]')");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function isAlreadyPDFOrdered($data){
        try {
            $query = $this->db->connect()->query("SELECT COUNT(*) AS total FROM client_user_order WHERE is_pdf = 1 AND user_id = '$data[user_id]' AND book_id = '$data[book_id]'");
            $total = $query->fetch(PDO::FETCH_OBJ)->total;
            return $total > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}