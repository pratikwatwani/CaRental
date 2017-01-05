<?php
require 'connect.php';
$name=$_POST['name'];
$age=$_POST['age'];
$type=$_POST['type'];
$reg=$_POST['reg'];
$fee=$_POST['fee'];



$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$url=$target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$query="INSERT INTO vehicle(name,age,type,regnum,fee,image) VALUES ('" . $name . "'," . $age . "," . $type . ",'" . $reg . "'," . $fee . ",'" . $url . "')";
$result=mysql_query($query,$db) or die(mysql_error($db));
echo 'data send successfully';

//update supply relation
$query="INSERT INTO supply(vid,dealer_id) values ('" .$reg. "',15)";
$result=mysql_query($query,$db) or die('supply update failed');
echo 'Successfully completed all task';
?>