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
    <link rel="stylesheet" href="css/makeOrder.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    
    <form action="makeOrder.php" id="form" method="POST">
        <?php
            $db=new DB();
            $orderCode="";
            $clientCode="";
            $bookCode="";
            $deliveryDate="";
            $todayDate=date("Y-m-d");
            if(isset($_POST['order_code'])){
                $orderCode=$_POST['order_code'];
                $clientCode=$_POST['client_code'];
                $bookCode=$_POST['book_code'];
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
                    $query=$db->connect()->prepare('INSERT INTO orders(order_num, client_code, book_code, delivery_date, delivered)
                        VALUES(:order_num, :client_code, :book_code, :delivery_date, 0)');
                    if($query->execute(['order_num'=>$orderCode,'client_code'=>$clientCode,'book_code'=>$bookCode,'delivery_date'=>$deliveryDate])===false) {
                        die("Error when inserting data " . $query->errorCode());
                    }
                }
                echo "</div>";
            }
        ?>
        <div class="field-conteiner">
            <p>OrderCode:</p>
            <input name="order_code" type="text" class="field" placeholder="Code..." value="<?php echo $orderCode?>"><br/>
        </div>
        <select name="client_code" id="">
            <option value="">Select a client code</option>
            <?php
                $result=$db->connect()->query('SELECT * FROM client');
                if($result->rowCount()>0){
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row['c_code']?>" <?php if($clientCode==$row['c_code'])echo "selected"?>><?php echo $row['c_code']." - ".$row['name']." ".$row['last_name'];?></option>
                        <?php
                    }
                }
            ?>
        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>
            <?php
                $result=$db->connect()->query('SELECT * FROM book');
                if($result->rowCount()>0){
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row['b_code']?>" <?php if($bookCode==$row['b_code'])echo "selected"?>><?php echo $row['b_code']." - ".$row['title'];?></option>
                        <?php
                    }
                }
            ?>
        </select>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>