<?php
class Books extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->books=[];
        $this->view->message="";
        $this->view->fields=[];
    }
    function render(){
        $physicBooks=$this->model->getAllPhysics();
        $books=$this->model->getBooksByPhysicals($physicBooks);
        $this->view->books=$books;
        $this->view->render('books/index');
    }
    function register(){
        if(isset($_POST['code'])){
            $bCode=$_POST['code'];
            $title=$_POST['title'];
            $numPages=$_POST['num_pages'];
            $editorial=$_POST['editorial'];
            $author=$_POST['author'];
            $cost=$_POST['cost'];
            $image=$_FILES['file'];
            $therePhysical=$_POST['there_physical'];
            $PDFFile=$_FILES['filePDF'];
            if($therePhysical=="yes" && $PDFFile['name']!=""){
                //physical and PDF
                $isImage=getimagesize($image['tmp_name']);
                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if($isImage==false) {
                    $this->view->message="The file is not an image";
                    $this->view->render('books/register');
                }else{
                    $size=$image['size'];
                    // greater than 990kb
                    if($size>990000) {
                        $this->view->message="Image too big, must be less than 900kb";
                        $this->view->render('books/register');
                    }else{
                        if($imageExtension!="jpg" && $imageExtension!="jpeg" && $imageExtension!="png") {
                            $this->view->message="Only admit files with jpg/jpeg/png extensions";
                            $this->view->render('books/register');
                        }else{
                            //Image is ok
                            $PDFExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
                            if($PDFExtension=="pdf"){
                                //PDF is ok
                                //image
                                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                                $imageName=$bCode.".".$imageExtension;
                                $directoryImage="public/Images/Books/";
                                $fileImage=$directoryImage.$imageName;
                                //pdf
                                $pdfExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
                                $pdfName=$bCode.".".$pdfExtension;
                                $directoryPDF="public/PDF/";
                                $filePDF=$directoryPDF.$pdfName;
                                if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                                    if(move_uploaded_file($PDFFile['tmp_name'], $filePDF)){
                                        if($this->model->registerPhysicalAndPDF(['code'=>$bCode, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                                                                           'author'=>$author, 'cost'=>$cost, 'image'=>$fileImage, 'pdf'=>$filePDF])){
                                            $this->view->message="Successfully registered book";
                                            $this->view->render('books/register');
                                        }else{
                                            $this->view->message="Error when inserting data";
                                            $this->view->render('books/register');
                                        }
                                    }else{
                                        $this->view->message="Error when save PDF";
                                        $this->view->render('books/register');
                                    }
                                }else{
                                    $this->view->message="Error when save image";
                                    $this->view->render('books/register');
                                }
                            }else{
                                $this->view->message="this is not a pdf file";
                                $this->view->render('books/register');
                            }

                        }
                    }
                }
            }else if($therePhysical=="no" && $PDFFile['name']!=""){
                //only PDF
                $isImage=getimagesize($image['tmp_name']);
                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if($isImage==false) {
                    $this->view->message="The file is not an image";
                    $this->view->render('books/register');
                }else{
                    $size=$image['size'];
                    // greater than 990kb
                    if($size>990000) {
                        $this->view->message="Image too big, must be less than 900kb";
                        $this->view->render('books/register');
                    }else{
                        if($imageExtension!="jpg" && $imageExtension!="jpeg" && $imageExtension!="png") {
                            $this->view->message="Only admit files with jpg/jpeg/png extensions";
                            $this->view->render('books/register');
                        }else{
                            //Image is ok
                            $PDFExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
                            if($PDFExtension=="pdf"){
                                //PDF is ok
                                //image
                                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                                $imageName=$bCode.".".$imageExtension;
                                $directoryImage="public/Images/Books/";
                                $fileImage=$directoryImage.$imageName;
                                //pdf
                                $pdfExtension=strtolower(pathinfo($PDFFile['name'], PATHINFO_EXTENSION));
                                $pdfName=$bCode.".".$pdfExtension;
                                $directoryPDF="public/PDF/";
                                $filePDF=$directoryPDF.$pdfName;
                                if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                                    if(move_uploaded_file($PDFFile['tmp_name'], $filePDF)){
                                        if($this->model->registerPDF(['code'=>$bCode, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                                            'author'=>$author, 'cost'=>$cost, 'image'=>$fileImage, 'pdf'=>$filePDF])){
                                            $this->view->message="Successfully registered book";
                                            $this->view->render('books/register');
                                        }else{
                                            $this->view->message="Error when inserting data";
                                            $this->view->render('books/register');
                                        }
                                    }else{
                                        $this->view->message="Error when save PDF";
                                        $this->view->render('books/register');
                                    }
                                }else{
                                    $this->view->message="Error when save image";
                                    $this->view->render('books/register');
                                }
                            }else{
                                $this->view->message="this is not a pdf file";
                                $this->view->render('books/register');
                            }
                        }
                    }
                }
            }else if($therePhysical=="yes" && $PDFFile['name']==""){
                //only physical
                $isImage=getimagesize($image['tmp_name']);
                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if($isImage==false) {
                    $this->view->message="The file is not an image";
                    $this->view->render('books/register');
                }else{
                    $size=$image['size'];
                    // greater than 990kb
                    if($size>990000) {
                        $this->view->message="Image too big, must be less than 900kb";
                        $this->view->render('books/register');
                    }else{
                        if($imageExtension!="jpg" && $imageExtension!="jpeg" && $imageExtension!="png") {
                            $this->view->message="Only admit files with jpg/jpeg/png extensions";
                            $this->view->render('books/register');
                        }else{
                            //Image is ok
                            //image
                            $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                            $imageName=$bCode.".".$imageExtension;
                            $directoryImage="public/Images/Books/";
                            $fileImage=$directoryImage.$imageName;

                            if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                                if($this->model->registerPhysical(['code'=>$bCode, 'title'=>$title, 'num_pages'=>$numPages, 'editorial'=>$editorial,
                                    'author'=>$author, 'cost'=>$cost, 'image'=>$fileImage])){
                                    $this->view->message="Successfully registered book";
                                    $this->view->render('books/register');
                                }else{
                                    $this->view->message="Error when inserting data";
                                    $this->view->render('books/register');
                                }
                            }else{
                                $this->view->message="Error when save image";
                                $this->view->render('books/register');
                            }
                        }
                    }
                }
            }else if($therePhysical=="no" && $PDFFile['name']==""){
                //error
                $this->view->message="Choose a PDF or if there is a physical book";
                $this->view->render('books/register');
            }
        }else
            $this->view->render('books/register');
    }
}