<?php
    include_once '../../includes/db.php';
    class Orders extends DB{
        function getorders(){
            $query = $this->connect()->query('SELECT * FROM orders');
            return $query;
        }
    }
?>