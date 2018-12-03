<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/newUserTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Biblioteca</title>
</head>
<body>
    <header>
        <h1><a href="users.php">Clients</a></h1>
    </header>
    <?php
        $servidor="localhost";
        $nombreUsuario="root";
        $password="123!\"#QWE";
        $db="biblioteca";

        $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
    ?>
    <form action="newUser.php">
        <h2>Create new user</h2>
        <p>Name:</p>
        <div class="field-conteiner">
            <input name="name" type="text" class="field" placeholder="Name..." value=""><br/>
        </div>
        <p>Last name:</p>
        <div class="field-conteiner">
            <input name="last_name" type="text" class="field" placeholder="Last name..." value=""><br/>
        </div>
        <p>Phone:</p>
        <div class="field-conteiner">
            <input name="email" type="text" class="field" placeholder="1234567890" value=""><br/>
        </div>
        <p>Age:</p>
        <div class="field-conteiner">
            <input type="number"  value="18" name="age" min="1" max="120"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>