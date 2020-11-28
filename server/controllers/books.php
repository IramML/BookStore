<?php
class Books extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab = "books";
    }
    function render(){
        if(isset($_POST['delete_book_id'])){
            $bookID = $_POST['delete_book_id'];
            if($this->model->isBookOrdered($bookID))
                $this->model->archiveBookByID($bookID);
            else
                $this->model->deleteBookByID($bookID);
        }
        $this->view->books = $this->model->getAllBooks();
        $this->view->subTab = "list";
        $this->view->render('books/index');
    }
    function add(){
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['editorial'])
         && isset($_POST['num_pages']) && isset($_POST['cost']) && isset($_POST['stock'])
         && isset($_POST['description'])&& isset($_POST['category']) && !empty($_FILES['image']['tmp_name'])){
            $data = $_POST;
            $imageName = $this->saveImage($_FILES['image']);

            if(!empty($_FILES['pdf']['tmp_name']))
                $PDFName = $this->savePDF($_FILES['pdf']);
            else 
                $PDFName = null;

            if($imageName != ""){
                $data['image'] = $imageName;
                $data['pdf'] = $PDFName;
              
                if($this->model->addBook($data)){
                    header("location: ".constant('URL')."books");
                }
            }
        }

        $this->view->categories = $this->model->getAllBookCategories();
        $this->view->subTab = "add";
        $this->view->render('books/add');
    }
    function edit($params = null){
        if(!empty($params[0])){
            $bookID = $params[0];
            $bookDetails = $this->model->getBookbyID($bookID);
            $this->view->bookDetails = $bookDetails;

            if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['editorial'])
            && isset($_POST['num_pages']) && isset($_POST['cost']) && isset($_POST['stock'])
            && isset($_POST['description'])&& isset($_POST['category']) && !empty($_FILES['image']['tmp_name'])){
                $data = $_POST;
                $data = $bookDetails;
                $data['title'] = $_POST['title'];
                $data['author'] = $_POST['author'];
                $data['editorial'] = $_POST['editorial'];
                $data['num_pages'] = $_POST['num_pages'];
                $data['cost'] = $_POST['cost'];
                $data['stock'] = $_POST['stock'];
                $data['description'] = $_POST['description'];
                $data['category'] = $_POST['category'];

                $imageName = $this->saveImage($_FILES['image']);

                if(!empty($_FILES['pdf']['tmp_name']))
                    $PDFName = $this->savePDF($_FILES['pdf']);
                else 
                    $PDFName = $bookDetails['pdf'];

                if($imageName != ""){
                    $data['image'] = $imageName;
                    $data['pdf'] = $PDFName;
                
                    if($this->model->updateBook($data))
                        header("location: ".constant('URL')."books");
                    
                }
            }
            $this->view->categories = $this->model->getAllBookCategories();
            $this->view->subTab = "add";
            $this->view->render('books/edit');
        }else
            header("location: ".constant('URL')."books"); 
    }
    function saveImage($file){
        $info = pathinfo($file['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz',5)), 0, 34).".".$ext;
    
        if(!($ext=="png" || $ext=="jpg"|| $ext=="PNG" || $ext=="jpeg" || $ext=="gif"))
            return "";
        echo "saved";
        $target = 'uploads/books/images/'.$newname;
    
        if(move_uploaded_file( $file['tmp_name'], $target))
            return $newname;
        else
            return "";
    }
    function savePDF($file){
        $info = pathinfo($file['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstuvwxyz',5)), 0, 34).".".$ext;
        
        if($ext=="")
            return "";

        $target = 'uploads/books/pdf/'.$newname;
    
        if(move_uploaded_file( $file['tmp_name'], $target))
            return $newname;
        else
            return "";
    }
}