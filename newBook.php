<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/newBookTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Biblioteca</title>
</head>
<body>
    <header>
        <h1><a href="books.php">Books</a></h1>
    </header>
    <?php
        $servidor="localhost";
        $nombreUsuario="root";
        $password="123!\"#QWE";
        $db="biblioteca";

        $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
    ?>
    <form action="newUser.php">
        <h2>Create new book</h2>
        <p>Code:</p>
        <div class="field-conteiner">
            <input name="code" type="text" class="field" placeholder="NDA97532" value=""><br/>
        </div>
        <p>Title:</p>
        <div class="field-conteiner">
            <input name="title" type="text" class="field" placeholder="Title..." value=""><br/>
        </div>
        <p>number of pages:</p>
        <div class="field-conteiner">
            <input type="number"  value="300" name="num_pages" min="1" max="1267069"><br/>
        </div>
        <p>Editorial:</p>
        <div class="field-conteiner">
            <input name="editorial" type="text" class="field" placeholder="Editorial..." value=""><br/>
        </div>
        <p>Cost:</p>
        <div class="field-conteiner">
            <input type="number"  value="200" name="cost" min="1" max="100000000"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>