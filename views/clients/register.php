<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/newUser.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Book Store</title>
</head>
<body>
    <?php require_once 'views/header.php'?>
    <form id="form" action="clients/register" method="POST">

        <h2>Create new user</h2>
        <div class="field-conteiner">
            <p>Name:</p>
            <input name="name" type="text" class="field" placeholder="Name..." value=""><br/>
        </div>
        <div class="field-conteiner">
            <p>Last name:</p>
            <input name="last_name" type="text" class="field" placeholder="Last name..." value=""><br/>
        </div>
        <div class="field-conteiner">
            <p>Phone:</p>
            <input name="phone" type="text" class="field" placeholder="1234567890" value=""><br/>
        </div>
        <div class="field-conteiner">
            <p>Age:</p>
            <input type="number"  value="18" name="age" min="1" max="120"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>

</body>
</html>