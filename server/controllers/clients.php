<?php
class Clients extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab = "clients";
    }
    function render(){
        $this->view->render('clients/index');
    }
}