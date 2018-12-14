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
        function registerApplicationClient($clientItem){
            $query=$this->connect()->prepare('INSERT INTO client(c_code, c_name, last_name, phone, age)
                                              VALUES(:id, :name, :last_name, :phone, :age)');
            if($query->execute(['id'=>$clientItem['id'], 'name'=>$clientItem['name'], 'last_name'=>$clientItem['last_name'],
                'phone'=>$clientItem['phone'], 'age'=>$clientItem['age']])===false)
                die("Error inserting data ".$query->errorInfo());

            $query=$this->connect()->prepare('INSERT INTO clientapplication(ca_code, email, password, c_image)
                                            VALUES(:id, :email, :password, :image)');

            if($clientItem['image']!=""){
                $image=$clientItem['image'];
                if($query->execute(['id'=>$clientItem['id'], 'email'=>$clientItem['email'], 'password'=>$clientItem['password'],
                        'image'=>$image])===false)
                    die("Error inserting data ".$query->errorInfo());
            }else{
                if($query->execute(['id'=>$clientItem['id'], 'email'=>$clientItem['email'], 'password'=>$clientItem['password'],
                        'image'=>null])===false)
                    die("Error inserting data ".$query->errorInfo());
            }


            $query=$this->connect()->prepare('INSERT INTO token(id_client, token)
                                               VALUES(:id, :token)');

            $token=substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz",
                5)), 0, 40);
            $query->execute(['id'=>$clientItem['id'], 'token'=>$token]);
            return $token;


        }
        function generateToken(){

        }
    }
?>