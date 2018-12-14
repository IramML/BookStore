<?php
    include_once '../../includes/Objects/Domiciles.php';
    include_once '../../includes/Objects/Clients.php';
    class ApiDomiciles{
        function registerClientDomicile($data){
            $domicileObject=new Domiciles();
            $clientObject=new Clients();
            $res=$clientObject->getUserIDByToken($data['token']);
            if($res->rowCount()>0){
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $data['idClient']=$row['id_client'];
                }
                $this->printJSON($domicileObject->registerDomicile($data));
            }else{
                $this->error("There are no user");
            }

        }
        function getClientDomiciles($token){
            $domicileObject=new Domiciles();
            $clientObject=new Clients();
            $idClient='';
            $res=$clientObject->getUserIDByToken($token);
            if($res->rowCount()>0){
                while($row=$res->fetch(PDO::FETCH_ASSOC)){
                    $idClient=$row['id_client'];
                }
                $resDomicile=$domicileObject->getDomicilesByClientId($idClient);
                $domicileResponse=array('code'=>200,'domiciles'=>array());
                if($resDomicile->rowCount()>0){
                    while ($row=$resDomicile->fetch(PDO::FETCH_ASSOC)){
                        $domicile=array(
                            'postal_code'=>$row['postal_code'],
                            'colony'=>$row['colony'],
                            'state'=>$row['state'],
                            'municipality'=>$row['municipality'],
                            'street'=>$row['street'],
                            'outdoor_number'=>$row['outdoor_number']);
                        array_push($domicileResponse['domiciles'], $domicile);
                    }
                }
                $this->printJSON($domicileResponse);
            }else $this->error('There are no user');
        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>