<?php

class API{
    public $uploadsLocation="../../../../server/uploads/";

    public function __construct(){
    }

    function error($message){
        echo json_encode(array('code' => '400','message' => $message));
    }

    function printJSON($array){
        echo json_encode($array);
    }

    function saveBase64PNG($base64Img, $imageName, $route){
        $img_file = "$this->uploadsLocation$route$imageName";
        
        if(!file_put_contents($img_file, base64_decode($base64Img)))
            return false;
        
        return true;
    }
}