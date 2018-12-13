<?php
    include_once '/xampp/htdocs/bookstore/includes/Objects/Clients.php';
    class ClientItems{
        function getAllItems(){
            $clientsObject=new Clients();
            $clients=array();
            $res=$clientsObject->getClients();
            if($res->rowCount()){
                $clients['clients']=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $client=array(
                        'id'=>$row['c_code'],
                        'name'=>$row['c_name'],
                        'last_name'=>$row['last_name'],
                        'phone'=>$row['phone'],
                        'age'=>$row['age']
                    );
                    array_push($clients['clients'], $client);
                }
                $this->showItems($clients);
            }else $this->error("There are no clients");
        }
        function deleteItem($id){
            $clientsObject=new Clients();
            $clientsObject->deleteUser($id);
        }
        function showItems($clients){
            foreach ($clients['clients'] as $client) {
                ?>
                <div class="user">
                    <p class="user-code"><?php echo $client['id'] ?></p>
                    <p class="user-name"><?php echo $client['name'] . " " . $client['last_name'] ?></p>
                    <p class="user-phone"><?php echo $client['phone'] ?></p>
                    <form method="POST" action="clients.php" class="user-options"
                          id="form<?php echo $client['id']; ?>">
                        <input type="hidden" name="delete" value="<?php echo $client['id']; ?>">
                        <input class="option" type="image" src="img/person-remove.png" alt="Delete User"/>
                    </form>
                </div>
                <?php
            }
        }
        function error($message){

        }
    }
?>