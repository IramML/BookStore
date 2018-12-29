<?php
class Clients extends Controller {
    function __construct(){
        parent::__construct();
    }
    function render(){
        $this->view->render('clients/index');
    }
    function register(){
        $this->view->render('clients/register');
    }
}
?>