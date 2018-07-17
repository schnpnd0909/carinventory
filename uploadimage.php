<?php
session_start();
require_once './function.php';

$newobj=new carfunction();

$uploads = "uploads/";
$tmpname_image = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$imagetype = $_FILES['file']['type'];
$allowed = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
$datetimestr = date("Ymd") . "_" . date("His");
$my_date = date("Y-m-d H:i:s");

if (!empty($tmpname_image)) {

    if (in_array($imagetype, $allowed)) {
        $imagename = 'img_' . $datetimestr . '.' . pathinfo($name, PATHINFO_EXTENSION);
        $target_file_image = $uploads . "/" . str_replace(" ", "", $imagename);    //   Image 383x235
        $maxheight = 100;
        $maxwidth = 200;
        //Start Image Resize  and Move to Folder
        list($width, $height, $type, $attr) = getimagesize($tmpname_image);

        if ($width >= $maxwidth || $height >= $maxheight) {
            $newwidth = "500";
            $newheight = "400";
            switch ($imagetype) {
                case 'image/jpg':
                case 'image/jpeg':
                    $img = imagecreatefromjpeg($tmpname_image);
                    $transColor = imagecolorallocatealpha($img, 255, 255, 255, 127);
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagejpeg($thumb, $target_file_image, 10);
                    break;
                case 'image/png':
                    $img = imagecreatefrompng($tmpname_image);
                    ///  $transColor = imagecolorallocatealpha($img, 255, 255, 255, 127);
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagepng($thumb, $target_file_image, 0);
                    break;
                case 'image/gif':
                    $img = imagecreatefromgif($tmpname_image);
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagegif($thumb, $target_file_image);
                    break;
            }
            @imagedestroy($src);
            @imagedestroy($thumb);
            
            
            
            $data=array(
                'name'=>$name,
                'image_name'=>$imagename,
                'session'=>$_SESSION['savemodelimage'],
                'image_path'=>$target_file_image,
                'modifiedat'=>$my_date
            );
         $saveimage=$newobj->uploadImage($data);
        } else {
                //Please upload image more than 380x230 resolution.
            
        }
        //End Image Resize   and Move to Folder
    } else {
        //File is not an Image. please upload again
    }
}