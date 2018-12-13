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
            $query=$this->connect()->prepare('DELETE FROM clientphysical WHERE cp_code=:id');
            if($query->execute(['id'=>$id])===false){
                die("Error deleting data ".$query->errorInfo());
            }
            $query=$this->connect()->prepare('DELETE FROM client WHERE c_code=:id');
            if($query->execute(['id'=>$id])===false){
                die("Error deleting data ".$query->errorInfo());
            }
        }
        function registerPhysical($id, $name, $lastName, $phone, $age){
            $query=$this->connect()->prepare('INSERT INTO client(c_code, c_name, last_name, phone, age)
                                              VALUES(:id, :name, :last_name, :phone, :age)');
            $query->execute(['id'=>$id, 'name'=>$name, 'last_name'=>$lastName, 'phone'=>$phone, 'age'=>$age]);
            $query=$this->connect()->prepare('INSERT INTO clientphysical(cp_code)
                                              VALUES(:id)');
            $query->execute(['id'=>$id]);
        }
    }
?>