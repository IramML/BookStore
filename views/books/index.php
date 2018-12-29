<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/books.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Book Store</title>
</head>
<body>
    <?php require_once 'views/header.php'?>
    <div id="book-content">
    <div id="title">
        <h2>Books</h2>
        <a id="add-book" href="<?php constant('URL')?>books/register"><img class="option" src="public/img/plus.png" alt="Add book"></a>
    </div>
</div>
</body>
</html>