<?php
include '../../../includes/model.php';

class GetBooksModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getBooks(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT book.*, book_category.name as category_name 
                FROM book 
                INNER JOIN book_category ON book.category_id = book_category.id
                WHERE book.is_archived = 0");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            var_dump($e);
            return [];
        }
    }
}