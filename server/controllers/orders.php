<?php
class Orders extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab = "orders";
    }
    function render(){
        $this->view->render('orders/index');
    }
}