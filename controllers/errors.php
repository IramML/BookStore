<?php
/**
 * Created by PhpStorm.
 * User: IramML
 * Date: 17/12/2018
 * Time: 01:12 PM
 */

class Errors extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->message="There was an error in the request or the page does not exist";
        $this->view->render('errors/index');
    }
}