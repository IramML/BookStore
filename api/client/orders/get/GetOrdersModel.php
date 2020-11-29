<?php
include '../../../includes/model.php';

class GetOrdersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function getOrdersByUserID($userID) {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT client_user_order.id as order_id, client_user_order.is_pdf, client_user_order.datetime as created_date, book.*  
                FROM client_user_order 
                INNER JOIN book ON client_user_order.book_id = book.id
                WHERE client_user_order.user_id = '$userID'");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            
            return [];
        }
    }
}