<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/indexTheme.css">
</head>
<body>
    <?php require_once 'views/header.php'?>
    <div id="options-content">
        <a href="clients" class="option">
            <p>Clients</p>
            <img src="public/img/person.png" alt="Users">
        </a>
        <a href="books" class="option">
            <p>Books</p>
            <img src="public/img/favicon.png" alt="Books">
        </a>
        <a href="makeOrder" class="option">
            <p>Make order</p>
            <img src="public/img/shopping-cart.png" alt="Make Order">
        </a>
        <a href="orders" class="option">
            <p>Orders</p>
            <img src="public/img/swap.png" alt="Orders">
        </a>
    </div>
</body>
</html>