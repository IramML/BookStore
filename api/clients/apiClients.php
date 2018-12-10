<?php 
    include_once 'clients.php';
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
                        'id'=>$row['u_code'],
                        'name'=>$row['name'],
                        'last_name'=>$row['last_name'],
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
    }
?>