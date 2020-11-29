<?php
include '../../../includes/model.php';

class OrderDetailsModel extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    function getOrderDetails($data) {
        try {
            $query = $this->db->connect()->query("SELECT client_user_order.id as order_id, client_user_order.is_pdf, client_user_order.datetime as created_date, book.*  
                FROM client_user_order 
                INNER JOIN book ON client_user_order.book_id = book.id
                WHERE client_user_order.user_id = '$data[user_id]' AND client_user_order.id = '$data[order_id]'");
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }
}