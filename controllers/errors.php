<?php

class Errors extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->message="There was an error in the request or the page does not exist";
        $this->view->render('errors/index');
    }
}