<?php

class Login extends Controller{
    function __construct(){
        parent::__construct();
    }
    function render(){
        if($this->model->adminAvailable()){
            if(isset($_POST['email']) && isset($_POST['password'])){
                if($this->model->loginVerification(['email'=>$_POST['email'], 'password'=>$_POST['password']])){
                    header('location: index.php');
                }else
                    $this->view->render('login/index');
            }else{
                $this->view->render('login/index');
            }
        }else{
            $this->view->render('login/register');
        }

        
    }
    function register(){
        if(isset($_POST['email']) && isset($_POST['password'])){
            if($_POST['password']==$_POST['password_verify']){
                $hash=password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost'=>10]);
                if($this->model->registerUser(['name'=>$_POST['name'], 'email'=>$_POST['email'],
                            'password'=>$hash])){
                    $this->view->render('login/index');
                }else{
                    $this->view->render('login/register');
                }
            }else
                $this->view->render('login/register');
        }else{
            $this->view->render('login/register');
        }
    }
    function logout(){
        session_unset();
        // destroy the session
        session_destroy();
        $this->view->render('login/index');
    }
}