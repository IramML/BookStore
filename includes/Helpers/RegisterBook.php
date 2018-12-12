<?php
    include_once '/xampp/htdocs/bookstore/includes/Objects/Books.php';

    class RegisterBook{
        function register($code, $title, $numPages, $editorial, $author, $cost, $image, $imageExtension){
            $bookObject=new Books();
            $directory="Images/Books/";
            $file=$directory.$code.".".$imageExtension;
            if(move_uploaded_file($image['tmp_name'], $file))
                echo 'archivo subido correctamente';
            else{
                echo 'error en subir la imagen';
            }
            $bookObject->registerBook($code, $title, $numPages, $editorial, $author, $cost, $file);
        }
    }
?>