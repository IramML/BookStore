<?php
class Orders extends Controller {
    function __construct(){
        parent::__construct();
    }
    function render(){
        $this->view->render('orders/index');
    }
    function register(){
        $this->view->render('orders/register');
    }
}
?>