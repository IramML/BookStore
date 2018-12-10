<?php
    include_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/ordersTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    
    <div id="orders-content">
        <div id="orders-today">
            <h2>Delivery today</h2>
            <?php 
                $db=new DB();
                if(isset($_POST['delivered'])){
                    $id=$_POST['delivered'];
                    $query=$db->connect()->prepare('UPDATE orders
                            SET delivered=1 WHERE order_num=:id');
                    if($query->execute(['id'=>$id])===false){
                        die("Error updating data ".$query->errorCode());
                    }
                }
                $result=$db->connect()->query('SELECT * FROM orders');
                if($result->rowCount()>0){
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        $orderNum=$row['order_num'];
                        $clientCode=$row['user_code'];
                        $bookCode=$row['book_code'];
                        if($row['delivered']==0){
                            if(date('d/m/Y',strtotime($row['loan_date']))==date('d/m/Y',strtotime($row['delivery_date']))){
                            ?>
                            <div class="order">
                                <div class="order-information">
                                    <p class="order-code item"><?php echo "<strong>".$orderNum."</strong>";?> </p>
                                    <p class="client-code item"><?php echo "<strong>".$clientCode."</strong>"." - ";
                                        $resultUsers=$db->connect()->query("SELECT * FROM users where u_code='$clientCode'");
                                        if($resultUsers->rowCount()>0){
                                            while($rowUsers=$resultUsers->fetch(PDO::FETCH_ASSOC)){
                                                echo $rowUsers['name']." ".$rowUsers['last_name'];
                                            }
                                        }
                                    ?></p>
                                    <p class="book-code item"><?php echo "<strong>".$bookCode."</strong>"." - ";
                                    $resultBooks=$db->connect()->query("SELECT * FROM book where b_code='$bookCode'");
                                    if($resultBooks->rowCount()>0){
                                        while($rowBooks=$resultBooks->fetch(PDO::FETCH_ASSOC)){
                                            echo $rowBooks['title'];
                                        }
                                    }?></p>
                                    <p class="loan-date item"><strong>Loan:</strong> <?php echo date('d/m/Y',strtotime($row['loan_date']));?></p>
                                    <p class="delivery-date item"><strong>Delivery:</strong> <?php echo date('d/m/Y',strtotime($row['delivery_date']));?></p>
                                </div>
                                <form method="POST" class="order-options" action="orders.php" id="form<?php echo $row['order_num'];?>">
                                        <input type="hidden" name="delivered" value="<?php echo $orderNum;?>">
                                        <input class="option" type="image" src="img/checkmark.png" alt="Delivered" />
                                </form> 
                            </div>
                            <?php
                            }
                        }
                    }
                }
            ?>
            <h2>Delivery later</h2>
                <?php
                    $result=$db->connect()->query('SELECT * FROM orders');
                    if($result->rowCount()>0){
                        while($row=$result->fetch(PDO::FETCH_ASSOC)){
                            $orderNum=$row['order_num'];
                            $clientCode=$row['user_code'];
                            $bookCode=$row['book_code'];
                            if($row['delivered']==0){
                                if(date('d/m/Y',strtotime($row['loan_date']))!=date('d/m/Y',strtotime($row['delivery_date']))){
                                ?>
                                <div class="order">
                                    <div class="order-information">
                                        <p class="order-code item"><?php echo $orderNum;?> </p>
                                        <p class="client-code item"><?php echo "<strong>".$clientCode."</strong>"." - ";
                                            $resultUsers=$db->connect()->query("SELECT * FROM users where u_code='$clientCode'");
                                            if($resultUsers->rowCount()>0){
                                                while($rowUsers=$resultUsers->fetch(PDO::FETCH_ASSOC)){
                                                    echo $rowUsers['name']." ".$rowUsers['last_name'];
                                                }
                                            }
                                        ?></p>
                                        <p class="book-code item"><?php echo "<strong>".$bookCode."</strong>"." - "; 
                                        $sql="";

                                        $resultBooks=$db->connect()->query("SELECT * FROM book where b_code='$bookCode'");
                                        if($resultBooks->rowCount()>0){
                                            while($rowBooks=$resultBooks->fetch(PDO::FETCH_ASSOC)){
                                                echo $rowBooks['title'];
                                            }
                                        }?></p>
                                        <p class="loan-date item"><strong>Loan:</strong> <?php echo date('d/m/Y',strtotime($row['loan_date']));?></p>
                                        <p class="delivery-date item"><strong>Delivery:</strong> <?php echo date('d/m/Y',strtotime($row['delivery_date']));?></p>
                                    </div>
                                    <form method="POST" class="order-options" action="orders.php" id="form<?php echo $row['order_num'];?>">
                                        <input type="hidden" name="delivered" value="<?php echo $orderNum;?>">
                                        <input class="option" type="image" src="img/checkmark.png" alt="Delivered" />
                                    </form> 
                                </div>
                                <?php
                                }
                            }
                        }
                    }
                ?>
        </div>
    </div>
</body>
</html>
