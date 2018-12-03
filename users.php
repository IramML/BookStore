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
    <div id="title">
        <h2>Clients</h2>
        <a id="add-user" href="newUser.php"><img class="option" src="img/plus.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <?php
            $servidor="localhost";
            $nombreUsuario="root";
            $password="123!\"#QWE";
            $db="biblioteca";

            $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
            if($conexion->connect_error){
                die("Conexion fallida: ".$conexion->connect_error);
            }
            $sql="SELECT * FROM users";
            $resultado=$conexion->query($sql);
            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    ?>
                    <div class="user">
                        <p class="user-code"><?php echo $row['u_code']?></p>
                        <p class="user-name"><?php echo $row['name']." ".$row['last_name']?></p>
                        <p class="user-phone"><?php echo $row['phone']?></p>
                        <form method="POST" action="users.php" class="user-options"  id="form<?php echo $row['u_code'];?>">
                            <input class="option" type="image" value="Edit" src="img/edit.png" alt="Edit User" />
                            <input class="option" type="image" value="Delete" src="img/person-remove.png" alt="Delete User" />
                        </form> 
                </div>  
                    <?php
                }
            }
            $conexion->close();
        ?>
    </div>
</body>
</html>
