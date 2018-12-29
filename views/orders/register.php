<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/newOrder.css">
</head>
<body>
    <?php require_once 'views/header.php'?>
    <form action="makeOrder.php" id="form" method="POST">

        <select name="client_code" id="">
            <option value="">Select a client code</option>

        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>

        </select>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>