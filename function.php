<?php

define("DBHOST", "localhost");
define("DBUSER", "phpwdide_carinve");
define("DBPWD", "ej8S,134(#-(");
define("DB", "phpwdide_carinven");

class carfunction {

    public $con;

    public function __construct() {

        $this->con = mysqli_connect(DBHOST, DBUSER, DBPWD, DB);
    }

    public function insertManufacturer($data) {
        $sql = "INSERT INTO `manufacturer`(`name`, `status`,`modifiedat`) VALUES ('" . $data['manufacturername'] . "','" . $data['status'] . "','" . $data['modifiedat'] . "')";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function checkManufacturer($manufacturer) {
        $sql = "SELECT `name` FROM `manufacturer` WHERE `name` = '" . $manufacturer . "'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function getManufacturer($id = null, $status = null) {
        if ($id != null) {
            $manid = " `id` IN ('" . $id . "')";
        } else {
            $manid = " 1=1 ";
        }
        if ($status != NULL) {
            $stat = " AND `status` = '" . $status . "'";
        } else {
            $stat = " AND 1=1";
        }
        $sql = "SELECT * FROM `manufacturer` WHERE " . $manid . " " . $stat;
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function uploadImage($data) {
         $sql = "INSERT INTO `modelimages`(`name`, `image_name`, `session`, `image_path`,`modifiedat`)"
                . " VALUES ('" . $data['name'] . "','" . $data['image_name'] . "','" . $data['session'] . "',"
                . "'" . $data['image_path'] . "','" . $data['modifiedat'] . "')";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    public function insertModel($data){
        $sql="INSERT INTO `model`(`name`, `manufacturerid`, `price`, `fueltype`, `mileage`, `engine`,"
                . " `transmission`, `weight`, `modifiedat`) VALUES "
                . "('".$data['name']."','".$data['manufacturerid']."','".$data['price']."','".$data['fueltype']."'"
                . ",'".$data['mileage']."','".$data['engine']."','".$data['transmission']."','".$data['weight']."'"
                . ",'".$data['modifiedat']."')";
        $result = mysqli_query($this->con, $sql);
        $lastid = mysqli_insert_id($this->con); 
        return $lastid;
    }
    
    public function updateModelimage($modelid,$date,$session){
         $sql="UPDATE `modelimages` SET `modelid`='".$modelid."', `modifiedat`='".$date."', `status`='1' WHERE `session` = '".$session."'";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function getCars($id=null){
        if ($id != null) {
            $modelid = " m.id IN ('" . $id . "')";
        } else {
            $modelid = " 1=1 ";
        }
         $sql="SELECT  m.*,mf.*,m.name as modelname,m.id as modelid FROM `model` m inner join  manufacturer mf on mf.id=m.`manufacturerid` where ".$modelid;
        $result = mysqli_query($this->con, $sql);
        return $result;
        
    }
    
    public function getImages($modelid){
        if ($modelid != null) {
            $model = " AND mimg.modelid IN ('" . $modelid . "')";
        } else {
            $model = " AND 1=1 ";
        }
         $sql="select * from modelimages mimg where  mimg.`status`=1 ".$model;
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function saleModel($id){
        $sqldeletemodel="DELETE FROM `model` WHERE `id` =".$id;
        $result = mysqli_query($this->con, $sqldeletemodel);
        if($result){
            $sqlmodelimg="DELETE FROM `modelimages` WHERE `modelid` =".$id;
            $result = mysqli_query($this->con, $sqlmodelimg);
            echo "1";
        }else{
            echo "2";
        }
    }
    
}
