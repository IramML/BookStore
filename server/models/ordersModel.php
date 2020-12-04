<?php
class ordersModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getOrders() {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT client_user_order.id, client_user_order.status,
                client_user.first_name, client_user.last_name, client_user.email,
                book.title, book.image,
                client_user_domicile.postal_code, client_user_domicile.country, client_user_domicile.state,
                client_user_domicile.city, client_user_domicile.street, client_user_domicile.outdoor_number 
                FROM client_user_order 
                INNER JOIN client_user ON client_user_order.user_id = client_user.id
                INNER JOIN book ON client_user_order.book_id = book.id
                INNER JOIN client_user_domicile ON client_user_order.domicile_id = client_user_domicile.id
                WHERE is_pdf = 0
                ORDER BY client_user_order.id DESC");
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    function getOrderByID($orderID) {
        try {
            $query = $this->db->connect()->query("SELECT client_user_order.id, client_user_order.status,
                client_user.first_name, client_user.last_name, client_user.email,
                book.title, book.image,
                client_user_domicile.postal_code, client_user_domicile.country, client_user_domicile.state,
                client_user_domicile.city, client_user_domicile.street, client_user_domicile.outdoor_number 
                FROM client_user_order  
                INNER JOIN client_user ON client_user_order.user_id = client_user.id
                INNER JOIN book ON client_user_order.book_id = book.id
                INNER JOIN client_user_domicile ON client_user_order.domicile_id = client_user_domicile.id
                WHERE client_user_order.id = '$orderID'");

                
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return [];
        }
    }

    function updateStatus($data) {
        try {
            $this->db->connect()->query("UPDATE client_user_order
                    SET status = '$data[status]'
                    WHERE id = '$data[order_id]'");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}