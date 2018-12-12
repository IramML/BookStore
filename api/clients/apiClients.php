<?php
    include_once '../../includes/Objects/Clients.php';
    class ApiClients{
        function getAll(){
            $clientsObject=new Clients();
            $clients=array();
            
            $res=$clientsObject->getClients();
            if($res->rowCount()){
                $clients['code']=200;
                $clients["clients"]=array();
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $client=array(
                        'id'=>$row['c_code'],
                        'name'=>$row['c_name'],
                        'last_name'=>$row['last_name'],
                        'email'=>$row['email'],
                        'password'=>$row['password'],
                        'phone'=>$row['phone'],
                        'age'=>$row['age']
                    );
                    array_push($clients["clients"], $client);
                    
                }
                echo json_encode($clients);
            }else{
                $clients['code']=404;
                echo json_encode(array('message'=>'There are no elements'));
            }
        }
        function getById($id){
            $clientsObject = new Clients();
            $clients = array();

            $res = $clientsObject->getClient($id);
            if ($res->rowCount()) {
                $clients['code'] = 200;
                $clients["clients"] = array();
                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                    $client = array(
                        'id' => $row['c_code'],
                        'name' => $row['name'],
                        'last_name' => $row['last_name'],
                        'phone' => $row['phone'],
                        'age' => $row['age']
                    );
                    array_push($clients["clients"], $client);

                }
                $this->printJSON($client);
            } else {
                $this->error("There are no elements");
            }
        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo '<code>'.json_encode($array).'</code>';
        }
    }
?>