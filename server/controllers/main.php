<?php
class Main extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab="dashboard";
        $this->view->activeAccounts=0;
    }
    function render(){
        if(isset($_POST["reject_id"])){
            $this->model->rejectUserByID($_POST['reject_id']);
        }
        if(isset($_POST["approve_id"])){
            $this->model->approveUserByID($_POST['approve_id']);
        }
        $this->view->users=$this->model->getUsers();
        $this->view->activeAccounts=$this->model->countActiveAccounts();
        $this->view->render('main/index');
    }

}
