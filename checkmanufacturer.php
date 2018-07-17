<?php
require_once './function.php';

$newobj=new carfunction();

$manufacturername= mysqli_real_escape_string($newobj->con,trim($_POST['manufacturername']));
$checkexist=$newobj->checkManufacturer($manufacturername);
$count= mysqli_num_rows($checkexist);
if($count > 0){
    echo"false";
}else{
    echo"true";
}