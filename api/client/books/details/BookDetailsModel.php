<?php
include '../../../includes/model.php';

class BookDetailsModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getBookByID($bookID){
        try {
            $query = $this->db->connect()->query("SELECT book.*, book_category.name as category_name 
                FROM book 
                INNER JOIN book_category ON book.category_id = book_category.id
                WHERE book.id = '$bookID'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
}