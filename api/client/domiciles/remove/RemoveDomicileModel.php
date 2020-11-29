<?php
include '../../../includes/model.php';

class RemoveDomicileModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function removeDomicile($data){
        try {
            $this->db->connect()->query("DELETE FROM client_user_domicile 
                    WHERE id = '$data[domicile_id]' AND user_id = '$data[user_id]'");
            return true;
        } catch (PDOException $e) {
            return true;
        }
    }

    function archiveDomicile($data){
        try {
            $this->db->connect()->query("UPDATE client_user_domicile 
                    SET is_archived = 1
                    WHERE id = '$data[domicile_id]' AND user_id = '$data[user_id]'");
            return true;
        } catch (PDOException $e) {
            return true;
        }
    }

    function isDomicileInUse($data){
        try {
            $query = $this->db->connect()->query("SELECT COUNT(*) AS total FROM client_user_domicile
                WHERE id = '$data[domicile_id]' AND user_id = '$data[user_id]'");
            $total = $query->fetch(PDO::FETCH_OBJ)->total;
            return $total > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}