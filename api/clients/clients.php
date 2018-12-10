<?php
    include_once '../../includes/db.php';
    class Clients extends DB{
        function getClients(){
            $query = $this->connect()->query('SELECT * FROM users');
            return $query;
        }
    }
?>