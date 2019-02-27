<?php
class Main extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->theme="";
        
    }
    function render(){
        $this->view->numClients=$this->model->getNumClients();
        $this->view->numBooks=$this->model->getNumBooks();
        $this->view->numOrders=$this->model->getNumOrders();
        $this->view->numDeliveries=$this->model->getNumDeliveries();
        $this->view->theme="main";
        $this->view->render('main/index');
    }
}
?>