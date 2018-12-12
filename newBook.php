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
    <title>Library</title>
</head>
<body>
    <header>
        <h1><a href="books.php">Books</a></h1>
    </header>
        
    <form id="form" method="POST" action="newBook.php" enctype="multipart/form-data">
        <?php
            include_once 'includes/Helpers/RegisterBook.php';
            $register=new RegisterBook();

            $bCode="";
            $title="";
            $numPages=0;
            $editorial="";
            $author="";
            $cost=0;
            if(isset($_POST['code']) && isset($_FILES['file'])){
                $bCode=$_POST['code'];
                $title=$_POST['title'];
                $numPages=$_POST['num_pages'];
                $editorial=$_POST['editorial'];
                $author=$_POST['author'];
                $cost=$_POST['cost'];
                $image=$_FILES['file'];
                $fields=array();
                if($bCode=="")   
                    array_push($fields, "The code field can not be empty");
                if($title=="")   
                    array_push($fields, "The title field can not be empty");
                if($editorial=="")   
                    array_push($fields, "The editorial field can not be empty");
                if($author=="")   
                    array_push($fields, "The author field can not be empty");
                $isImage=getimagesize($image['tmp_name']);
                echo $image['tmp_name'];
                $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if($isImage==false)
                    array_push($fields, "The file is not an image");
                 else{
                     $size=$image['size'];
                     // greater than 900kb
                     if($size>900000)
                         array_push($fields, "Image too big, must be less than 900kb");
                     else{
                         if($imageExtension!="jpg" && $imageExtension!="jpeg" && $imageExtension!="png")
                             array_push($fields, "Only admit files with jpg/jpeg/png extensions");
                     }
                 }
                if(count($fields)>0){
                    echo "<div class='error'>";
                    for($i=0; $i<count($fields); $i++){
                        echo "<li>".$fields[$i]."</li>";
                    }
                }else{
                    echo "<div class='correct'>Correct data";
                    $register->register($bCode, $title, $numPages, $editorial, $author, $cost, $image, $imageExtension);
                }
                echo "</div>";
            }
        ?>
        <h2>Register new book</h2>
        <div class="field-conteiner">
            <p>Code:</p>
            <input name="code" type="text" class="field" placeholder="NDA97532" value="<?php echo $bCode?>"><br/>
        </div>
        
        <div class="field-conteiner">
            <p>Title:</p>
            <input name="title" type="text" class="field" placeholder="Title..." value="<?php echo $title?>"><br/>
        </div>
       
        <div class="field-conteiner">
            <p>number of pages:</p>
            <input type="number"  value="<?php if(isset($_POST['num_pages']))echo $numPages; else echo 300;?>" name="num_pages" min="1" max="1267069"><br/>
        </div>
       
        <div class="field-conteiner">
            <p>Editorial:</p>
            <input name="editorial" type="text" class="field" placeholder="Editorial..." value="<?php echo $editorial?>"><br/>
        </div>
       
        <div class="field-conteiner">
            <p>Author:</p>
            <input name="author" type="text" class="field" placeholder="Name..." value="<?php echo $author?>"><br/>
        </div>
       
        <div class="field-conteiner">
            <p>Cost:</p>
            <input type="number"  value="<?php if(isset($_POST['cost']))echo $cost; else echo 200;?>" name="cost" min="1" max="100000000"><br/>
        </div>
        <div class="field-conteiner">
            <p>Upload image:</p>
            <input type="file" name="file"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>