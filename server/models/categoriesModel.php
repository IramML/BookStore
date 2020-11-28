<?php
class categoriesModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getAllCategories(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT id, name FROM book_category WHERE is_archived = '0'");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($items))
                return [];
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    function addCategory($name){
        try {
            $this->db->connect()->query("INSERT INTO book_category(name, is_archived) VALUES('$name', 0)");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    function isCategoryInUse($categoryID){
        try {
            $query = $this->db->connect()->query("SELECT COUNT(*) AS total FROM book WHERE category_id = '$categoryID'");
            $total = $query->fetch(PDO::FETCH_OBJ)->total;
            return $total>0;
        } catch (PDOException $e) {
            return false;
        }
    }
    function archiveCategory($categoryID){
        try {
            $this->db->connect()->query("UPDATE book_category
                    SET is_archived = 1
                    WHERE id = '$categoryID'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    function deleteCategory($categoryID){
        try {
            $this->db->connect()->query("DELETE FROM book_category WHERE id = '$categoryID'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}