<?php
    include_once '/xampp/htdocs/bookstore/includes/db.php';
    class Clients extends DB{
        function getClients(){
            $query = $this->connect()->query('SELECT * FROM client');
            return $query;
        }
        function getClient($id){
            $query = $this->connect()->prepare('SELECT * FROM client where c_code=:id');
            $query->execute(['id'=>$id]);
            return $query;
        }
        function deleteUser($id){
            $query=$this->connect()->prepare('DELETE FROM client WHERE c_code=:id');
            if($query->execute(['id'=>$id])===false){
                die("Error deleting data ".$query->errorInfo());
            }
        }
    }
?>