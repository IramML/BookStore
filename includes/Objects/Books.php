<?php
    include_once '/xampp/htdocs/bookstore/includes/db.php';
    class Books extends DB{
        function getBooks(){
            $query = $this->connect()->query('SELECT * FROM book');
            return $query;
        }
        function getBook($id){
            $query = $this->connect()->prepare('SELECT * FROM book where b_code=:code');
            $query->execute(['code'=>$id]);
            return $query;
        }
        function registerBook(){

        }
    }
?>