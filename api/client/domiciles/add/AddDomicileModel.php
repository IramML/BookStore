<?php
include '../../../includes/model.php';

class AddDomicileModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    function addDomicile($data){
        try {
            $this->db->connect()->query("INSERT INTO client_user_domicile(postal_code, country, state, city, street, outdoor_number, is_archived, user_id)
                    VALUES('$data[postal_code]', '$data[country]', '$data[state]', '$data[city]', '$data[street]', '$data[outdoor_number]', 0, '$data[user_id]')");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}