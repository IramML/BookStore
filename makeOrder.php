<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/makeOrder.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Book Store</a></h1>
    </header>
    
    <form action="makeOrder.php" id="form" method="POST">
        <?php
            include_once 'includes/Helpers/RegisterOrder.php';
            $register=new RegisterOrder();
            $clientCode="";
            $bookCode="";
            if(isset($_POST['client_code']) && isset($_POST['book_code'])){
                $clientCode=$_POST['client_code'];
                $bookCode=$_POST['book_code'];

                $fields=array();
                if($clientCode=="")   
                    array_push($fields, "Select a client code");
                if($bookCode=="")   
                    array_push($fields, "Select a book code");
              
                if(count($fields)>0){
                    echo "<div class='error'>";
                    for($i=0; $i<count($fields); $i++){
                        echo "<li>".$fields[$i]."</li>";
                    }
                }else{
                    echo "<div class='correct'>Correct data";
                    $register->registerPhysicalOrder($clientCode, $bookCode);
                }
                echo "</div>";
            }
        ?>
        <select name="client_code" id="">
            <option value="">Select a client code</option>
            <?php
                include_once '/xampp/htdocs/bookstore/includes/Objects/Clients.php';
                $clientObject=new Clients();
                $result=$clientObject->getPhysicalClients();
                if($result->rowCount()>0){
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        $resultClient=$clientObject->getClient($row['cp_code']);
                        if($resultClient->rowCount()>0){
                            while ($rowClient=$resultClient->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $rowClient['c_code']?>" <?php if($clientCode==$rowClient['c_code'])echo "selected"?>><?php echo $rowClient['c_code']." - ".$rowClient['c_name']." ".$rowClient['last_name'];?></option>
                                <?php
                            }
                        }
                    }
                }
            ?>
        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>
            <?php
                include_once '/xampp/htdocs/bookstore/includes/Objects/Books.php';
                $bookObject=new Books();
                $result=$bookObject->getBooks();
                if($result->rowCount()>0){
                    while($row=$result->fetch(PDO::FETCH_ASSOC)){
                        if($bookObject->existPhysical($row['b_code'])) {
                            ?>
                                <option value="<?php echo $row['b_code'] ?>" <?php if ($bookCode == $row['b_code']) echo "selected" ?>><?php echo $row['b_code'] . " - " . $row['title']; ?></option>
                            <?php
                        }
                    }
                }
            ?>
        </select>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>