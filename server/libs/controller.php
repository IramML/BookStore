<?php
class Controller{
    function __construct(){
        $this->view=new View();
        $this->view->strings=$this->getStrings();
    }
    function loadModel($model){
        $url="models/".$model."Model.php";
        if(file_exists($url)){
            require $url;
            $modelName=$model."Model";
            $this->model=new $modelName();
        }
    }
    function getStrings(){
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $acceptLang = ['es', 'en', 'pt']; 
        $lang = in_array($lang, $acceptLang) ? $lang : 'en';
        require_once "./strings/{$lang}.php"; 

        return $strings;
    }
}
