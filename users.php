<?php
    include_once 'includes/db.php';
?>
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
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Library</a></h1>
    </header>
    <div id="title">
        <h2>Clients</h2>
        <a id="add-user" href="newUser.php"><img class="option" src="img/person-add.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <?php
            $db=new DB();
           
            if(isset($_POST['delete'])){
                $id=$_POST['delete'];
                $query=$db->connect()->prepare('DELETE FROM users WHERE u_code=:id');
                if($query->execute(['id'=>$id])===false){
                    die("Error deleting data".$query->errorCode());
                }
            } 
            $result=$db->connect()->query('SELECT * FROM users');
            if($result->rowCount()>0){
                while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="user">
                        <p class="user-code"><?php echo $row['u_code']?></p>
                        <p class="user-name"><?php echo $row['name']." ".$row['last_name']?></p>
                        <p class="user-phone"><?php echo $row['phone']?></p>
                        <form method="POST" action="users.php" class="user-options"  id="form<?php echo $row['u_code'];?>">
                            <input type="hidden" name="delete" value="<?php echo $row['u_code'];?>">
                            <input class="option" type="image" src="img/person-remove.png" alt="Delete User" />
                        </form> 
                    </div>  
                    <?php
                }
            }
        ?>
    </div>
</body>
</html>
