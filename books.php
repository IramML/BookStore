<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/booksTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    <div id="title">
        <h2>Books</h2>
        <a id="add-book" href="newBook.php"><img class="option" src="img/plus.png" alt="Add book"></a>
    </div>
    <div id="book-content">
    <?php
            $servidor="localhost";
            $nombreUsuario="root";
            $password="123!\"#QWE";
            $db="biblioteca";

            $conexion=new mysqli($servidor, $nombreUsuario, $password, $db);
            if($conexion->connect_error){
                die("Conexion fallida: ".$conexion->connect_error);
            }
            if(isset($_POST['delete'])){
                $id=$_POST['delete'];
                $sql="DELETE FROM book WHERE b_code='$id'";
                if($conexion->query($sql)===false){
                    die("Error".$conexion->error);
                }
            }
            $sql="SELECT * FROM book";
            $resultado=$conexion->query($sql);
            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    ?>
               <div class="book">
                    <div class="book-information">
                        <p class="book-code item"><?php echo $row['b_code']?></p>
                        <p class="book-title item"><?php echo $row['title']?></p>
                        <p class="book-editorial item"><strong>Editorial:</strong> <?php echo $row['editorial']?></p>
                        <p class="book-author item"><strong>Author:</strong> <?php echo $row['author']?></p>
                        <p class="book-num-pages item"><strong>number of pages:</strong> <?php echo $row['num_pages']?></p>
                        <p class="book-cost item"><strong>Cost:</strong> <?php echo $row['cost']?>$</p>
                    </div>
                    <form method="POST" class="book-options" action="books.php" id="form<?php echo $row['b_code'];?>">
                        <input type="hidden" name="delete" value="<?php echo $row['b_code'];?>">
                        <input class="option" type="image" src="img/trash.png" alt="Delete book" />
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