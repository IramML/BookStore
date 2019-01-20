<?php
class Deliveries extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->theme="";
    }
    function render(){
        $this->view->theme="deliveries";
        $this->view->render('deliveries/index');
    }
}
