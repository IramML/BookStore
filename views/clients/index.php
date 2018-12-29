<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/header.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/clients.css">
    <title>Book Store</title>

</head>
<body>
    <?php require_once 'views/header.php'?>
    <div id="title">
        <h2 class="center">Clients</h2>
        <a id="add-user" href="<?php echo constant('URL'); ?>clients/register"><img class="option" src="public/img/person-add.png" alt="Add user"></a>
    </div>
    <div id="users-content">
        <table id="table-clients">
            <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Last Name</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once 'models/client.php';
            foreach ($this->clients as $row){
                $client=new Client();
                $client=$row;
                ?>
                <tr>
                    <td><?php echo $client->code?></td>
                    <td><?php echo $client->name?></td>
                    <td><?php echo $client->lastName?></td>
                    <td class="center"><a href=""><img class="option" src="public/img/edit.png" alt="Add user"></a></td>
                    <td class="center"><a href="#"><img class="option" src="public/img/person-remove.png" alt="Add user"></a></td>
                </tr>
                <?php
            }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>