<?php 
require 'models/domicile.php';
class domicilesModel extends Model{
    function __construct(){
        parent::__construct();
    }
    function getDomicilesByClientID($ID){
        $items=[];
        try{
            $query=$this->db->connect()->prepare('SELECT * FROM domicile WHERE client_domicile=:id');
            $query->execute(['id'=>$ID]);
            while($row=$query->fetch()){
                $domicile=new Domicile();
                $domicile->domicileCode=$row['domicile_code'];
                $domicile->clientDomicile=$row['client_domicile'];
                $domicile->postalCode=$row['postal_code'];
                $domicile->colony=$row['colony'];
                $domicile->state=$row['state'];
                $domicile->municipality=$row['municipality'];
                $domicile->street=$row['street'];
                $domicile->outDoorNum=$row['outdoor_number'];
                array_push($items, $domicile);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}