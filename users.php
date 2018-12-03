<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/usersTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Biblioteca</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    <?php
        $servidor="localhost";
        $nombreUsuario="root";
        $password="123!\"#QWE";
        $db="biblioteca";

        $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
    ?>
    <div id="title">
        <h2>Clients</h2>
        <a id="add-user" href="newUser.php"><img class="option" src="img/plus.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <!--
        <form class="user" action="users.php">
            <p class="user-name">Person 1</p>
            <p class="user-phone">1234567890</p>
            <div class="user-options">
                <input class="option" type="image" value="Edit" src="img/edit.png" alt="Edit User" />
                <input class="option" type="image" value="Delete" src="img/person-remove.png" alt="Delete User" />
            </div> 
        </form>
        -->
    </div>
</body>
</html>
