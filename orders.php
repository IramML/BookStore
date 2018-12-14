<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/ordersTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Book Store</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Book Store</a></h1>
    </header>
    
    <div id="orders-content">
        <?php
            include_once 'includes/Views/OrderItems.php';
            $orderItems=new OrderItems();
            $orderItems->getAllItems();
        ?>
    </div>
</body>
</html>
