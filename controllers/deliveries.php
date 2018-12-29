<?php
class Deliveries extends Controller {
    function __construct(){
        parent::__construct();
    }
    function render(){
        $this->view->render('deliveries/index');
    }
}
?>