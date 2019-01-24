<?php
require 'models/client.php';
class clientsModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getAll(){
        $items=[];
        try{
            $query=$this->db->connect()->query('SELECT * FROM client');

            while($row=$query->fetch()){
                $item=new Client();
                $item->code=$row['c_code'];
                $item->name=$row['c_name'];
                $item->lastName=$row['last_name'];
                $item->phone=$row['phone'];
                $item->age=$row['age'];
                array_push($items, $item);
            }
            return $items;
        }catch (PDOException $e){
            return [];
        }
    }
    function getClientsByPhysicals($physicalClients){
        $clientItems=[];
        try{
            foreach($physicalClients as $rowPhysical){
                $query=$this->db->connect()->prepare('SELECT * FROM client WHERE c_code=:code');
                $query->execute(['code'=>$rowPhysical->code]);
                while($row=$query->fetch()){
                    $item=new Client();
                    $item->code=$row['c_code'];
                    $item->name=$row['c_name'];
                    $item->lastName=$row['last_name'];
                    $item->phone=$row['phone'];
                    $item->age=$row['age'];
                    array_push($clientItems, $item);
                }
            }
            return $clientItems;
        }catch (PDOException $e){
            return [];
        }
    }
    function getAllPhysical(){
        $items=[];
        try{
            $query=$this->db->connect()->query('SELECT * FROM clientphysical');

            while($row=$query->fetch()){
                $item=new Client();
                $item->code=$row['cp_code'];
                array_push($items, $item);
            }
            return $items;
        }catch (PDOException $e){
            return [];
        }
    }
    function registerPhysical($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO client(c_code, c_name, last_name, phone, age) 
                                                  VALUES(:id, :name, :last_name, :phone, :age)');
            $query->execute(['id'=>$data['id'], 'name'=>$data['name'], 'last_name'=>$data['last_name'], 'phone'=>$data['phone'], 'age'=>$data['age']]);

            $query=$this->db->connect()->prepare('INSERT INTO clientphysical(cp_code) 
                                                  VALUES(:id)');
            $query->execute(['id'=>$data['id']]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
    function isIDDuplicate($id){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM client WHERE c_code=:code');
            $query->execute(['code'=>$id]);

            return $query->rowCount()>0;
        }catch (PDOException $e){
            return false;
        }
    }
    function getTokenById($ID){
        $token="";
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM token WHERE id_client=:id');
            $query->execute(['id'=>$ID]);
            while ($row=$query->fetch()){
                $token=$row['token'];
            }
            return $token;
        }catch (PDOException $e){
            return "";
        }
    }
    function validateToken($token){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM token WHERE token=:token');
            $query->execute(['token'=>$token]);

            if($query->rowCount()>0)return true;
            else return false;
        }catch (PDOException $e){
            return false;
        }
    }
    function getIdByToken($token){
        $ID="";
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM token WHERE token=:token');
            $query->execute(['token'=>$token]);
            while($row=$query->fetch()){
                $ID=$row['id_client'];
            }
            return $ID;
        }catch (PDOException $e){
            return "";
        }
    }
    function getClientIdByEmail($email){
        $ID="";
       try{
           $query=$this->db->connect()->prepare('SELECT * FROM clientapplication WHERE email=:email');
           $query->execute(['email'=>$email]);
           while($row=$query->fetch()){
                $ID=$row['ca_code'];
           }
           return $ID;
       }catch (PDOException $e){
           return [];
       }
    }
    function getPasswordByEmail($email){
        $password="";
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM clientapplication WHERE email=:email');
            $query->execute(['email'=>$email]);
            while($row=$query->fetch()){
                $password=$row['password'];
            }
            return $password;
        }catch (PDOException $e){
            return "";
        }
    }
    function getClientById($ID){
        $client=[];
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM client WHERE c_code=:code');
            $query->execute(['code'=>$ID]);
            while($row=$query->fetch()){
                $client=[
                    'name'=>$row['c_name'],
                    'last_name'=>$row['last_name'],
                    'phone'=>$row['phone'],
                    'age'=>$row['age']
                ];
            }
            return $client;
        }catch (PDOException $e){
            return [];
        }
    }
    function getAvatarByIDUser($ID){
        $avatar;
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM clientapplication WHERE ca_code=:code');
            $query->execute(['code'=>$ID]);
            while($row=$query->fetch()){
                $avatar=$row['c_image'];
            }
            return $avatar;
        }catch (PDOException $e){
            return "";
        }
    }
    function uploadAvatar($data){
        try{
            $query=$this->db->connect()->prepare('UPDATE clientapplication 
                                                SET c_image=:image
                                                WHERE ca_code=:code');
            return $query->execute(['code'=>$data['id'], 'image'=>$data['image']]);;
        }catch (PDOException $e){
            return false;
        }
    }
    function isClientIDDuplicate($ID){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM client WHERE c_code=:code');
            $query->execute(['code'=>$ID]);
           
            return $query->rowCount()>0;
        }catch (PDOException $e){
            return false;
        }
    }
    function registerApplication($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO client(c_code, c_name, last_name, phone, age) 
                                                  VALUES(:id, :name, :last_name, :phone, :age)');
            $query->execute(['id'=>$data['id'], 'name'=>$data['name'], 'last_name'=>$data['last_name'], 'phone'=>$data['phone'], 'age'=>$data['age']]);

            $query=$this->db->connect()->prepare('INSERT INTO clientapplication(ca_code, email, password, c_image) 
                                                  VALUES(:id, :email, :password, :image)');
            $query->execute(['id'=>$data['id'], 'email'=>$data['email'], 'password'=>$data['password'], 'image'=>$data['image']]);

            $query=$this->db->connect()->prepare('INSERT INTO token(id_client, token)
                                               VALUES(:id, :token)');
            $query->execute(['id'=>$data['id'], 'token'=>$data['token']]);
            return true;
        }catch (PDOException $e){
            return false;
        }
    }
}
?>