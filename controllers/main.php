<?php
class Main extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->theme="";
    }
    function render(){
        $this->view->theme="main";
        $this->view->render('main/index');
    }
}
?>