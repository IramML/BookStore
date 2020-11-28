<?php

class Errors extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->message="Hubo un error en la solicitud o no exise la página";
        $this->view->render('error/index');
    }
}