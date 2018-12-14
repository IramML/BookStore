<?php
    include_once '/xampp/htdocs/bookstore/includes/db.php';

    class Domiciles extends DB{
        function getDomiciles(){
            $query=$this->connect()->query('SELECT * FROM domicile');
            return $query;
        }
        function getDomicile($id){
            $query=$this->connect()->prepare('SELECT * FROM domicile WHERE domicile_code=:id');
            $query->execute(['id'=>$id]);
            return $query;
        }
        function getDomicilesByClientId($id){
            $query=$this->connect()->prepare('SELECT * FROM domicile WHERE client_domicile=:id');
            $query->execute(['id'=>$id]);
            return $query;
        }

        function registerDomicile($data){
            $query=$this->connect()->prepare('INSERT INTO domicile(client_domicile, postal_code, colony, state, municipality,
                                                       street, outdoor_number)
                                             VALUES(:idClient, :CP, :colony, :state, :municipality,
                                             :street, :outNumber)');
            if($query->execute(['idClient'=>$data['idClient'], 'CP'=>$data['CP'], 'colony'=>$data['colony'], 'state'=>$data['state'],
                                'municipality'=>$data['municipality'],'street'=>$data['street'], 'outNumber'=>$data['outNumber']])===false){
                die('Error inserting data');
            }

            $res=$this->getDomicilesByClientId($data['idClient']);
            $domicileResponse=array('code'=>200,'domiciles'=>array());
            if($res->rowCount()>0){
                while ($row=$res->fetch(PDO::FETCH_ASSOC)){
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
            return $domicileResponse;
        }
    }
?>