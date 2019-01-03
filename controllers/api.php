<?php
class Api extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->json=array();
    }
    function render(){
        $this->view->render('api/index');
    }
    function books($param = null){
        $method = $param[0];

        if($method=="get"){
            //get books
            if(isset($_GET['token'])){
                if($this->model->validateToken($_GET['token'])) {
                //filter books by client
                $idClient=$this->model->getIdByToken($_GET['token']);

                $orders=$this->model->getOrdersByClientID($idClient);

                $purchasedBooks=array();
                foreach ($orders as $row){
                    $order=new Order();
                    $order=$row;
                    array_push($purchasedBooks, $order->bookCode);
                }
                $books=$this->model->getAllBooks();
                $this->view->json['code']=200;
                $this->view->json['books']=array();
                foreach ($books as $row){
                    $booksObject=new Book();
                    $booksObject= $row;
                    $book = array(
                        'id'=>$booksObject->code,
                        'title'=>$booksObject->title,
                        'pages'=>$booksObject->numPages,
                        'editorial'=>$booksObject->editorial,
                        'author'=>$booksObject->author,
                        'cost'=>$booksObject->cost,
                        'image'=>$booksObject->bImage,
                        'there_pdf'=>'',
                        'there_physical'=>''
                    );
                    if($this->model->existPDF($book['id']))$book['there_pdf']='yes';
                    else $book['there_pdf']='no';

                    if($this->model->existPhysical($book['id']))$book['there_physical']='yes';
                    else $book['there_physical']='no';
                    //don't add if is purchased
                    if(!$this->isPurchased($purchasedBooks, $book))
                        array_push($this->view->json['books'], $book);
                }
                }else
                    $this->error("Token is wrong");
            }else{
                //get all books
                $this->view->json['code']=200;
                $this->view->json['books']=array();
                $books=$this->model->getAllBooks();
                foreach ($books as $row){
                    $booksObject=new Book();
                    $booksObject= $row;
                    $book = array(
                        'id'=>$booksObject->code,
                        'title'=>$booksObject->title,
                        'pages'=>$booksObject->numPages,
                        'editorial'=>$booksObject->editorial,
                        'author'=>$booksObject->author,
                        'cost'=>$booksObject->cost,
                        'image'=>$booksObject->bImage
                    );
                    array_push($this->view->json['books'], $book);
                }
            }
        }

        if ($this->view->json==[] || $this->view->json['books']==[])
            $this->error('There are no elements');

        $this->view->render('api/index');
    }
    function clients($param = null){
        $method = $param[0];

        if($method=="login"){
            if(isset($_POST['email'])&& isset($_POST['password'])){
                $data=array(
                    'email'=>$_POST['email'],
                    'password'=>$_POST['password']
                );
                $this->view->json['code']=200;
                $this->view->json['token']=$this->model->login($data);
            }
        }else  $this->error('Error calling the API');
        if ($this->view->json==[] || $this->view->json['token']=="")
            $this->error('Error calling the API');

        $this->view->render('api/index');
    }
    function isPurchased($idBooks, $book){
        $isDuplicate=false;
        foreach ($idBooks as $idBook) {
            if($isDuplicate) break;
            if ($idBook == $book['id']) $isDuplicate = true;
        }
        return $isDuplicate;
    }
    function error($message){
        $this->view->json=array('code'=>404,'message' => $message);
    }
}