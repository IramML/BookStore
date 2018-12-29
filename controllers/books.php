<?php
class Books extends Controller {
    function __construct(){
        parent::__construct();
    }
    function render(){
        $this->view->render('books/index');
    }
    function register(){
        $this->view->render('books/register');
    }
}
?>