<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/makeOrder.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Biblioteca</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    
    <form action="makeOrder.php" id="form" method="POST">
    <?php
            $servidor="localhost";
            $nombreUsuario="root";
            $password="123!\"#QWE";
            $db="biblioteca";

            $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
            if($conexion->connect_error){
                die("Conexion fallida: ".$conexion->connect_error);
            }

            $orderCode="";
            $clientCode="";
            $bookCode="";
            $deliveryDate="";
            if(isset($_POST['order_code'])){
                $orderCode=$_POST['order_code'];
                $clientCode=$_POST['client_code'];
                $bookCode=$_POST['book_code'];
                $todayDate=date("Y-m-d");;
                $deliveryDate=$_POST['delivery'];

                $fields=array();
                if($orderCode=="")   
                    array_push($fields, "The order Code field can not be empty");
                if($clientCode=="")   
                    array_push($fields, "Select a client code");
                if($bookCode=="")   
                    array_push($fields, "Select a book code");
                if($deliveryDate<$todayDate)   
                    array_push($fields, "Select a date greater than today");
              
                if(count($fields)>0){
                    echo "<div class='error'>";
                    for($i=0; $i<count($fields); $i++){
                        echo "<li>".$fields[$i]."</li>";
                    }
                }else{
                    echo "<div class='correct'>Correct data";

                   $sql="INSERT INTO orders(order_num, user_code, book_code, delivery_date)
                        VALUES('$orderCode', '$clientCode', '$bookCode', '$deliveryDate')";
                    if($conexion->query($sql)===true){
                    }else{
                        die("Error when inserting data ".$conexion->error);
                    }
                    
                }
                echo "</div>";
            }
            $conexion->close();
        ?>
        <div class="field-conteiner">
            <p>OrderCode:</p>
            <input name="order_code" type="text" class="field" placeholder="Code..." value="<?php echo $orderCode?>"><br/>
        </div>
        <select name="client_code" id="">
            <option value="">Select a client code</option>
            <?php
                $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
                if($conexion->connect_error){
                    die("Conexion fallida: ".$conexion->connect_error);
                }
                $sql="SELECT * FROM users";
                $resultado=$conexion->query($sql);
                if($resultado->num_rows>0){
                    while($row=$resultado->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['u_code']?>" <?php if($clientCode==$row['u_code'])echo "selected"?>><?php echo $row['u_code']." - ".$row['name']." ".$row['last_name'];?></option>
                        <?php
                    }
                }
                $conexion->close();
            ?>
        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>
            <?php
                $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
                if($conexion->connect_error){
                    die("Conexion fallida: ".$conexion->connect_error);
                }
                $sql="SELECT * FROM book";
                $resultado=$conexion->query($sql);
                if($resultado->num_rows>0){
                    while($row=$resultado->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['b_code']?>" <?php if($bookCode==$row['b_code'])echo "selected"?>><?php echo $row['b_code']." - ".$row['title'];?></option>
                        <?php
                    }
                }
                $conexion->close();
            ?>
        </select>
        <div class="field-conteiner">
            <p>delivery date:</p>
            <input name="delivery" id="date" type="date" value="<?php echo $deliveryDate;?>">
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>