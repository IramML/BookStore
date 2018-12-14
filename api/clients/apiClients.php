<?php
    include_once '../../includes/Objects/Clients.php';
    class ApiClients{
        private $image;
        private $id;
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
                $this->printJSON($clients);
            } else {
                $this->error("There are no elements");
            }
        }

        function registerApplicationClient($clientItem){

            $id=$this->id;
            if($this->id==null){
                $id=rand(1, 9999);
                while ($this->isDuplicate($id))
                    $id=rand(1, 9999);
            }
            $clientItem['id']=$id;
            $password=$clientItem['password'];
            $hash=password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);
            $clientItem['password']=$hash;
            $clientObject=new Clients();
            $token=$clientObject->registerApplicationClient($clientItem);
            if($token!='')
                $this->printJSON(['code'=>200, 'token'=>$token]);
            else
                $this->error('Error inserting data');
            //echo password_verify($password, $hash);
        }


        function loadImage($image){
            $isImage=getimagesize($image['tmp_name']);
            $imageExtension=strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            if($isImage!=false) {
                $size = $image['size'];
                // greater than 1000 kb
                if ($size > 1000000) {
                    $this->error('Image too big, must be less than 1000 kb');
                    return false;
                }else {
                    if ($imageExtension != "jpg" && $imageExtension != "jpeg" && $imageExtension != "png") {
                        $this->error('Only admit files with jpg/jpeg/png extensions');
                        return false;
                    }else{
                        $id=rand(1, 9999);
                        while ($this->isDuplicate($id))
                            $id=rand(1, 9999);

                        $imageName=$id.".".$imageExtension;
                        $directoryImage="Images/Clients/";
                        $fileImage=$directoryImage.$imageName;
                        if(move_uploaded_file($image['tmp_name'], $fileImage)) {
                            $this->image=$fileImage;
                            return true;
                        }else{
                            $this->error('There was an error when uploading the photo');
                            return false;
                        }
                    }
                }
            }else {
                $this->error('The file is not an image');
                return false;
            }
        }
        function isDuplicate($id){
            $clientsObject=new Clients();
            return $clientsObject->getClient($id)->rowCount()>0;
        }
        function getIDClient(){
            return $this->id;
        }
        function getImage(){
            return $this->image;
        }
        function error($message){
            echo json_encode(array('code'=>404,'message' => $message));
        }
        function printJSON($array){
            echo json_encode($array);
        }
    }
?>