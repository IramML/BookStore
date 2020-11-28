<?php
class booksModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getAllBooks(){
        try {
            $query = $this->db->connect()->query("SELECT * FROM book WHERE is_archived = 0");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            if(empty($items))
                return [];
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    function getBookbyID($bookID){
        try {
            $query = $this->db->connect()->query("SELECT * FROM book WHERE id = '$bookID'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(empty($res))
                return [];
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
    function getAllBookCategories(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM book_category WHERE is_archived = 0");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            if(empty($items))
                return [];
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    function addBook($data){
        try {
            $this->db->connect()->query("INSERT INTO book (title, author, editorial, num_pages, description, cost, stock, is_archived, pdf, image, category_id) 
                VALUES ('$data[title]', '$data[author]', '$data[editorial]', '$data[num_pages]', '$data[description]', '$data[cost]', '$data[stock]', 0, '$data[pdf]', '$data[image]', '$data[category]')");
            return true;
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }
    function updateBook($data){
        try {
            if(!empty($data['pdf']) ){
                $this->db->connect()->query("UPDATE book 
                SET title = '$data[title]',  author = '$data[author]', editorial = '$data[editorial]',
                 num_pages = '$data[num_pages]', description = '$data[description]', cost = '$data[cost]', 
                 stock = '$data[stock]', pdf = '$data[pdf]', image = '$data[image]', category_id = '$data[category]'
                WHERE id = '$data[id]'");
            }else{
                $this->db->connect()->query("UPDATE book 
                SET title = '$data[title]',  author = '$data[author]', editorial = '$data[editorial]',
                 num_pages = '$data[num_pages]', description = '$data[description]', cost = '$data[cost]', 
                 stock = '$data[stock]', image = '$data[image]', category_id = '$data[category]'
                WHERE id = '$data[id]'");
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    function isBookOrdered($bookID){
        try {
            $query = $this->db->connect()->query("SELECT COUNT(*) AS total FROM client_user_order WHERE book_id = '$bookID'");
            $total = $query->fetch(PDO::FETCH_OBJ)->total;
            return $total > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    function deleteBookByID($bookID){
        try {
            $query = $this->db->connect()->query("DELETE FROM book WHERE id = '$bookID'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            if(empty($res))
                return [];
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
    function archiveBookByID($bookID){
        try {
            $this->db->connect()->query("UPDATE FROM book 
                    SET is_archived = 1
                    WHERE id = '$bookID'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}