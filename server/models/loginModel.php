<?php

class loginModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function adminAvailable(){
        try{
            $query=$this->db->connect()->query('SELECT * FROM admin_user');

            return $query->rowCount()>0;
        }catch(PDOException $e){
            return false;
        }
    }
    
    function loginVerification($data){
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM admin_user WHERE email=:email');
            $query->execute(['email'=>$data['email']]);
            while($row=$query->fetch()){
                if($query->rowCount()>0){
                    if(password_verify($data['password'], $row['password'])){
                        $_SESSION['role']='admin';
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['user_name']=$row['name'];
                        return true;
                    }else
                        return false;
                }else{
                    return false;
                }
            }
            if(!$query->rowCount()>0)
                return false;
            
        }catch (PDOException $e){
            return false;
        }
    }
    function registerUser($data){
        try{
            $query=$this->db->connect()->prepare('INSERT INTO admin_user(name, email, password) 
                            VALUES(:name, :email, :password)');
            $query->execute(['name'=>$data['name'], 'email'=>$data['email'],
                    'password'=>$data['password']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}