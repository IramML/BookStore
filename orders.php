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
                $servidor="localhost";
                $nombreUsuario="root";
                $password="123!\"#QWE";
                $db="biblioteca";
    
                $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
                if($conexion->connect_error){
                    die("Conexion fallida: ".$conexion->connect_error);
                }
                if(isset($_POST['delivered'])){
                    $id=$_POST['delivered'];

                    $sql="UPDATE orders
                            SET delivered=1 WHERE order_num=$id";
                    if($conexion->query($sql)===false){
                        die("Error al actualizar los datos".$conexion->error);
                    }
                }

                $sql="SELECT * FROM orders";
                $resultado=$conexion->query($sql);
                if($resultado->num_rows>0){
                    while($row=$resultado->fetch_assoc()){
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
                                        $sql="SELECT * FROM users where u_code=$clientCode";
                                        $resultadoUsers=$conexion->query($sql);
                                        if($resultadoUsers->num_rows>0){
                                            while($rowUsers=$resultadoUsers->fetch_assoc()){
                                                echo $rowUsers['name']." ".$rowUsers['last_name'];
                                            }
                                        }
                                    ?></p>
                                    <p class="book-code item"><?php echo "<strong>".$bookCode."</strong>"." - "; 
                                    $sql="SELECT * FROM book where b_code='$bookCode'";
                                    $resultBooks=$conexion->query($sql);
                                    if($resultBooks->num_rows>0){
                                        while($rowBooks=$resultBooks->fetch_assoc()){
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
                    $sql="SELECT * FROM orders";
                    $resultado=$conexion->query($sql);
                    if($resultado->num_rows>0){
                        while($row=$resultado->fetch_assoc()){
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
                                            $sql="SELECT * FROM users where u_code=$clientCode";
                                            $resultadoUsers=$conexion->query($sql);
                                            if($resultadoUsers->num_rows>0){
                                                while($rowUsers=$resultadoUsers->fetch_assoc()){
                                                    echo $rowUsers['name']." ".$rowUsers['last_name'];
                                                }
                                            }
                                        ?></p>
                                        <p class="book-code item"><?php echo "<strong>".$bookCode."</strong>"." - "; 
                                        $sql="SELECT * FROM book where b_code='$bookCode'";
                                        $resultBooks=$conexion->query($sql);
                                        if($resultBooks->num_rows>0){
                                            while($rowBooks=$resultBooks->fetch_assoc()){
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
                    $conexion->close();
                ?>
        </div>
    </div>
</body>
</html>
