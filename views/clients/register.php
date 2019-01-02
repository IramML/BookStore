    <?php require_once 'views/header.php'?>
    <form id="form" action="<?php echo constant('URL')?>clients/register" method="POST">
        <h2>Create new user</h2>
        <?php
            if ($this->message!="")
                if($this->message=="Successfully registered client")
                    echo '<h3 class="correct center">'.$this->message.'</h3>';
                else
                    echo '<h3 class="error center">'.$this->message.'</h3>';
        ?>
        <div class="field-conteiner">
            <p>Name:</p>
            <input name="name" type="text" class="field" placeholder="Name..." value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Last name:</p>
            <input name="last_name" type="text" class="field" placeholder="Last name..." value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Phone:</p>
            <input name="phone" type="text" class="field" placeholder="1234567890" value="" required><br/>
        </div>
        <div class="field-conteiner">
            <p>Age:</p>
            <input type="number"  value="18" name="age" min="1" max="120" required><br/>
        </div>
        <input type="submit" id="btn-save" value="Save">
    </form>

</body>
</html>