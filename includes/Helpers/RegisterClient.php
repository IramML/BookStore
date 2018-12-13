<?php
    include_once '/xampp/htdocs/bookstore/includes/Objects/Clients.php';

    class RegisterClient{
        function registerPhysical($name, $lastName, $phone, $age){
            $clientObject=new Clients();
            $id=rand(1, 9999);
            while ($this->isDuplicate($id))
                $id=rand(1, 9999);
            $clientObject->registerPhysical($id, $name, $lastName, $phone, $age);
        }
        function isDuplicate($id){
            $booksObject=new Clients();
            return $booksObject->getClient($id)->rowCount()>0;
        }
    }
?>