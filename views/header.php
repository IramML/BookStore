<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Store</title>
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/<?php echo $this->theme?>.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Merienda+One|Roboto" rel="stylesheet">
</head>
    <body>
    <header class="dark-primary-color text-primary-color">
        <span id="open-nav">&#9776;</span>
        <h1>Book Store</h1>
    </header>
    <nav id="nav-side" class="dark-primary-color">
        <span id="close-nav">X</span>
        <ul>
            <li class="no-list-style nav-element center"><a class="link-element" href="<?php echo constant('URL'); ?>clients">Clients</a></li>
            <li class="no-list-style nav-element center"><a class="link-element" href="<?php echo constant('URL'); ?>books">Books</a></li>
            <li class="no-list-style nav-element center"><a class="link-element" href="<?php echo constant('URL'); ?>orders">Orders</a></li>
            <li class="no-list-style nav-element center"><a class="link-element" href="<?php echo constant('URL'); ?>orders/register">Make Order</a></li>
            <li class="no-list-style nav-element center"><a class="link-element" href="<?php echo constant('URL'); ?>deliveries">Deliveries</a></li>
        </ul>
    </nav>
    <script src="public/js/toggleNav.js"></script>