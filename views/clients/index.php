<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/clients.css">
    <title>Book Store</title>

</head>
<body>
    <?php require_once 'views/header.php'?>
    <div id="title">
        <h2>Clients</h2>
        <a id="add-user" href="clients/register"><img class="option" src="public/img/person-add.png" alt="Add user"></a>
    </div>
</body>
</html>