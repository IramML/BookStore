<?php
    include_once '/xampp/htdocs/bookstore/includes/Objects/Books.php';

    class RegisterBook{
        function registerPhysicalAndPDF($code, $title, $numPages, $editorial, $author, $cost, $image, $PDFFile){
            $bookObject=new Books();

            //image
            $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $imageName=$code.".".$imageExtension;
            $directoryImage="Images/Books/";
            $fileImage=$directoryImage.$imageName;

            //pdf
            $pdfExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
            $pdfName=$code.".".$pdfExtension;
            $directoryPDF="PDF/";
            $filePDF=$directoryPDF.$pdfName;
            if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                if(move_uploaded_file($PDFFile['tmp_name'], $filePDF)){
                    $bookObject->registerPhysicalAndPDF($code, $title, $numPages, $editorial, $author, $cost, $fileImage, $filePDF);
                }
            }


        }
        function registerPhysical($code, $title, $numPages, $editorial, $author, $cost, $image){
            $bookObject=new Books();
            //image
            $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $imageName=$code.".".$imageExtension;
            $directoryImage="Images/Books/";
            $fileImage=$directoryImage.$imageName;
            if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                $bookObject->registerPhysical($code, $title, $numPages, $editorial, $author, $cost, $fileImage);
            }
        }
        function registerPDF($code, $title, $numPages, $editorial, $author, $cost, $image, $PDFFile){
            $bookObject=new Books();

            //image
            $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $imageName=$code.".".$imageExtension;
            $directoryImage="Images/Books/";
            $fileImage=$directoryImage.$imageName;

            //pdf
            $pdfExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
            $pdfName=$code.".".$pdfExtension;
            $directoryPDF="PDF/";
            $filePDF=$directoryPDF.$pdfName;
            if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                if(move_uploaded_file($PDFFile['tmp_name'], $filePDF)){
                    $bookObject->registerPDF($code, $title, $numPages, $editorial, $author, $cost, $fileImage, $filePDF);
                }
            }
        }

    }
?>