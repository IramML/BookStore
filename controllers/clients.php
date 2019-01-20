<?php
class Clients extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->clients=[];
        $this->view->message="";
        $this->view->theme="";
    }
    function render(){
        $clientsPhysical=$this->model->getAllPhysical();
        $clients=$this->model->getClientsByPhysicals($clientsPhysical);
        $this->view->clients=$clients;
        $this->view->theme="clients";
        $this->view->render('clients/index');
    }
    function register(){
        $this->view->theme="newClient";
        if(isset($_POST['name'])){
            $name=$_POST['name'];
            $lastName=$_POST['last_name'];
            $phone=$_POST['phone'];
            $age=$_POST['age'];
            $id=rand(1, 9999);
            while($this->model->isIDDuplicate($id))
                $id=rand(1, 9999);
            if($this->model->registerPhysical(['id'=>$id, 'name'=>$name, 'last_name'=>$lastName, 'phone'=>$phone, 'age'=>$age])){
                $this->view->message="Successfully registered client";
            }else{
                $this->view->message="Error when inserting data";
            }
            $this->view->render('clients/register');
        }else{
            $this->view->render('clients/register');
        }
    }
}
?>