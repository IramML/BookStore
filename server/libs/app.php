<?php
require_once 'controllers/errors.php';
class App{
    function __construct(){
        session_start();

        if(!isset($_SESSION['role'])){
            $archivoController='controllers/login.php';
            require_once $archivoController;
            $controller=new Login();
            $controller->loadModel('login');

            $url=isset($_GET['url']) ? $_GET['url']: null;
            $url=rtrim($url, ' /');
            $url=explode('/', $url);
            
            $nparam=sizeof($url);
            if($nparam>1){
                if($nparam>2){
                    $param=[];
                    for($i=2; $i<$nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }
        }else{
            if(isset($_SESSION['role'])){
                switch($_SESSION['role']){
                    case "admin":
                        $url=isset($_GET['url']) ? $_GET['url']: null;
                        $url=rtrim($url, ' /');
                        $url=explode('/', $url);
                        if(empty($url[0])){
                            $archivoController='controllers/main.php';
                            require_once $archivoController;
                            $controller=new Main();
                            $controller->loadModel('main');
                            $controller->render();
                            return false;
                        }
                        $archivoController='controllers/'.$url[0].".php";
                        if(file_exists($archivoController)){
                            require_once $archivoController;

                            $controller=new $url[0];
                            $controller->loadModel($url[0]);

                            $nparam=sizeof($url);

                            if($nparam>1){
                                if($nparam>2){
                                    $param=[];
                                    for($i=2; $i<$nparam; $i++){
                                        array_push($param, $url[$i]);
                                    }
                                    $controller->{$url[1]}($param);
                                }else{
                                    $controller->{$url[1]}();
                                }
                            }else{
                                $controller->render();
                            }
                        }else{
                            $controller=new Errors();
                        }
                        break;
                }
            }else{
                $archivoController='controllers/login.php';
                require_once $archivoController;
                $controller=new Login();
                $controller->loadModel('login');
                $controller->render();
            }
        }
    }
}
?>