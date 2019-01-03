 <?php require_once 'views/header.php'?>
     <div id="title">
         <h2 class="center">Orders</h2>
     </div>
    <div id="order-content">
        <table id="table-orders">
            <thead>
            <tr>
                <th>Number of order</th>
                <th>Client code</th>
                <th>Book code</th>
                <th>Date of purchase</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once 'models/order.php';
            foreach ($this->orders as $row){
                $order=new Order();
                $order=$row;
                ?>
                <tr>
                    <td><?php echo $order->numOrder?></td>
                    <td><?php echo $order->clientCode?></td>
                    <td><?php echo $order->bookCode?></td>
                    <td><?php echo $order->buyDate?></td>
                    <td class="center"><a href=""><img class="option option-table" src="<?php echo constant('URL')?>public/img/edit.png" alt="Add user"></a></td>
                    <td class="center"><a href="#"><img class="option option-table" src="<?php echo constant('URL')?>public/img/trash.png" alt="Add user"></a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

</body>
</html>