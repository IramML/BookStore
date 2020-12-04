<?php
include '../../../includes/model.php';

class GetOrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getOrdersByUserID($userID) {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT client_user_order.id as order_id, 
                client_user_order.is_pdf, client_user_order.datetime as created_date, 
                book.*,
                book_category.name as category_name
                FROM client_user_order 
                INNER JOIN book ON client_user_order.book_id = book.id
                INNER JOIN book_category ON book.category_id = book_category.id
                WHERE client_user_order.user_id = '$userID'
                ORDER BY client_user_order.id DESC");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            
            return [];
        }
    }
}