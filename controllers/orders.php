<?php
class Orders extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->message="";
        $this->view->theme="";
        $this->view->orders=[];
    }
    function render(){
        $this->view->theme="orders";
        $orders=$this->model->getAll();
        $this->view->orders=$orders;
        $this->view->render('orders/index');
    }
    function register(){
        $this->view->theme="newOrder";

        include_once 'models/clientsModel.php';
        $clientModel=new clientsModel();
        $physicalClients=$clientModel->getAllPhysical();
        $this->view->clients=$clientModel->getClientsByPhysicals($physicalClients);

        include_once 'models/booksModel.php';
        $bookModel=new booksModel();
        $physicalBooks=$bookModel->getAllPhysics();
        $this->view->books=$bookModel->getBooksByPhysicals($physicalBooks);
        if(isset($_POST['client_code']) && isset($_POST['book_code'])){
            if($_POST['client_code']!="" && $_POST['book_code']!=""){
                $clientCode=$_POST['client_code'];
                $bookCode=$_POST['book_code'];

                if($this->model->physicalOrder(['client_code'=>$clientCode, 'book_code'=>$bookCode])){
                    $this->view->message="Successfully registered order";
                }else{
                    $this->view->message="Error when inserting data";
                }
            }
        }
        $this->view->render('orders/register');
    }
}
?>