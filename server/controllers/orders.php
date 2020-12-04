<?php
class Orders extends Controller {
    function __construct(){
        parent::__construct();
        $this->view->tab = "orders";
    } 

    function render(){
        $this->view->orders = $this->model->getOrders();
        $this->view->render('orders/index');
    }

    function details($params = null){
        if (!empty($params)) {
            $orderID = $params[0];
            if (isset($_POST['status'])) {
                $data = [
                    'order_id' => $orderID,
                    'status' => $_POST['status'],
                ];
                $this->model->updateStatus($data);
            }
            $this->view->order = $this->model->getOrderByID($orderID);
            $this->view->render('orders/details');
        }
        
    }
}