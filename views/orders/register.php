 <?php require_once 'views/header.php'?>
    <form action="<?php echo constant('URL')?>orders/register" id="form" method="POST">
        <h2>Register new order</h2>
        <?php
        if ($this->message!="")
            if($this->message=="Successfully registered order")
                echo '<h3 class="correct center">'.$this->message.'</h3>';
            else
                echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <select name="client_code" id="">
            <option value="">Select a client code</option>
            <?php
                include_once 'models/client.php';
                foreach ($this->clients as $row){
                    $client=new Client();
                    $client=$row;
                    ?>
                    <option value="<?php echo $client->code?>"><?php echo $client->code." - ".$client->name?></option>
                    <?php
                }
            ?>

        </select>
        <select name="book_code" id="">
            <option value="">Select a book code</option>
            <?php
            include_once 'models/book.php';
            foreach ($this->books as $row){
                $book=new Book();
                $book=$row;
                ?>
                <option value="<?php echo $book->code?>"><?php echo $book->code." - ".$book->title?></option>
                <?php
            }
            ?>
        </select>
        <input type="submit" id="btn-save" value="Save">
    </form>
</body>
</html>