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
    <link rel="stylesheet" href="css/newUserTheme.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ultra" rel="stylesheet">
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="users.php">Clients</a></h1>
    </header>
    <form id="form" action="newUser.php" method="POST">
        <?php
            $db=new DB();

            $name="";
            $lastName="";
            $phone="";
            $age=0;
            if(isset($_POST['name'])){
                $name=$_POST['name'];
                $lastName=$_POST['last_name'];
                $phone=$_POST['phone'];
                $age=$_POST['age'];

                $fields=array();
                if($name=="")   
                    array_push($fields, "The name field can not be empty");
                if($lastName=="")   
                    array_push($fields, "The last name field can not be empty");
                if($phone=="")   
                    array_push($fields, "The phone field can not be empty");
                if(strlen($phone)!=10)   
                    array_push($fields, "The phone field is not correct");
                if($age<18)   
                    array_push($fields, "You are not old enough");
                    
                if(count($fields)>0){
                    echo "<div class='error'>";
                    for($i=0; $i<count($fields); $i++){
                        echo "<li>".$fields[$i]."</li>";
                    }
                }else{
                    echo "<div class='correct'>Correct data";
                    $query=$db->connect()->prepare('INSERT INTO users(name, last_name, phone, age)
                    VALUES(:name, :last_name, :phone, :age)');
                    if($query->execute(['name'=>$name, 'last_name'=>$lastName,
                            'phone'=>$phone, 'age'=>$age])===false){
                        die("Error when inserting data ".$query->errorCode());
                    }
                }
                echo "</div>";
            }
        ?>
        <h2>Create new user</h2>
        <div class="field-conteiner">
            <p>Name:</p>
            <input name="name" type="text" class="field" placeholder="Name..." value="<?php echo $name?>"><br/>
        </div>
        <div class="field-conteiner">
            <p>Last name:</p>
            <input name="last_name" type="text" class="field" placeholder="Last name..." value="<?php echo $lastName?>"><br/>
        </div>
        <div class="field-conteiner">
            <p>Phone:</p>
            <input name="phone" type="text" class="field" placeholder="1234567890" value="<?php echo $phone?>"><br/>
        </div>
        <div class="field-conteiner">
            <p>Age:</p>
            <input type="number"  value="<?php if(isset($_POST['age']))echo $age; else echo 18; ?>" name="age" min="1" max="120"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>

</body>
</html>