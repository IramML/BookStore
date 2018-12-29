<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo constant('URL')?>public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/newBook.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Merienda+One|Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Roboto" rel="stylesheet">
    <title>Book Store</title>
</head>
<body>
    <?php require_once 'views/header.php'?>
    <form id="form" method="POST" action="<?php echo constant('URL')?>books/register" enctype="multipart/form-data">
        <h2>Register new book</h2>
        <?php
        if ($this->message!="")
            if($this->message=="Successfully registered book")
                echo '<h3 class="correct center">'.$this->message.'</h3>';
            else
                echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <div class="field-conteiner">
            <p>Code:</p>
            <input name="code" type="text" class="field" placeholder="NDA97532" value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Title:</p>
            <input name="title" type="text" class="field" placeholder="Title..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>number of pages:</p>
            <input type="number"  value="300" name="num_pages" min="1" max="1267069" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Editorial:</p>
            <input name="editorial" type="text" class="field" placeholder="Editorial..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Author:</p>
            <input name="author" type="text" class="field" placeholder="Name..." value="" required><br/>
        </div>

        <div class="field-conteiner">
            <p>Cost:</p>
            <input type="number"  value="200" name="cost" min="1" max="100000000" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Upload image:</p>
            <input type="file" name="file" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Physical book:</p>
            <input type="radio" name="there_physical" value="yes" checked>Yes<br/>
            <input type="radio" name="there_physical" value="no">No<br/>
        </div>
        <div class="field-conteiner">
            <p>Upload PDF (optional if there is no a physical book):</p>
            <input type="file" name="filePDF"><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>