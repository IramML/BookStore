<?php
class Categories extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab = "categories";
    }
    function render(){
        if(isset($_POST['delete_category_id'])){
            $categoryID = $_POST['delete_category_id'];
            if($this->model->isCategoryInUse($categoryID))
                $this->model->archiveCategory($categoryID);
            else
                $this->model->deleteCategory($categoryID);
        }
        $this->view->categories = $this->model->getAllCategories();
        $this->view->subTab = "list";
        $this->view->render('categories/index');
    }
    function add(){
        if(isset($_POST['category_name']))
            if($this->model->addCategory($_POST['category_name']))
                header("location: ".constant('URL')."categories");
            
        $this->view->subTab = "add";
        $this->view->render('categories/add');
    }
}