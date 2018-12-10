<?php
    include_once '../../includes/db.php';
    class Books extends DB{
        function getBooks(){
            $query = $this->connect()->query('SELECT * FROM book');
            return $query;
        }
    }
?>