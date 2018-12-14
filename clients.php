<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/mainTheme.css">
    <link rel="stylesheet" href="css/usersTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Book Store</title>
</head>
<body>
    <header>
        <h1><a href="index.php">Book Store</a></h1>
    </header>
    <div id="title">
        <h2>Clients</h2>
        <a id="add-user" href="newClient.php"><img class="option" src="img/person-add.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <?php
            include_once 'includes/Views/ClientItems.php';
            $clientItems=new ClientItems();
            if(isset($_POST['delete'])){
                $id=$_POST['delete'];
                $clientItems->deleteItem($id);
            }else $clientItems->getAllItems();
        ?>
    </div>
</body>
</html>
