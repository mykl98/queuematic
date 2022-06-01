<?php
if($_POST){
    include_once "../../../system/backend/config.php";

    function checkIfNameExist($name){
        global $conn;
        $table = "station";
        $sql = "SELECT idx FROM `$table` WHERE name='$name'";
        if($result=mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                return "Station name is already in use. Please use another name!";
            }else{
                return "true";
            }
        }else{
            return "System Error!";
        }
    }

    function checkIfPrefixExist($prefix){
        global $conn;
        $table = "station";
        $sql = "SELECT idx FROM `$table` WHERE prefix='$prefix'";
        if($result=mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                return "Prefix is already in use. Please use another prefix!";
            }else{
                return "true";
            }
        }else{
            return "System Error!";
        }
    }

    function saveStation($idx,$image,$name,$prefix,$status){
        $check = checkIfNameExist($name);
        if($check != "true"){
            return $check;
        }
        $check = checkIfPrefixExist($prefix);
        if($check != "true"){
            return $check;
        }
        global $conn;
        $table = "station";
        if($idx == ""){
            $sql = "INSERT INTO `$table` (image,name,prefix,status) VALUES ('$image','$name','$prefix','$status')";
        }else{
            $sql = "UPDATE `$table` SET image='$image',name='$name',prefix='$prefix',status='$status' WHERE idx='$idx'";
        }
        if(mysqli_query($conn,$sql)){
            return "true*_*";
        }else{
            return "System Error!";
        }
    }

    session_start();
    if($_SESSION["isLoggedIn"] == "true"){
        $idx = sanitize($_POST["idx"]);
        $image = sanitize($_POST["image"]);
        $name = sanitize($_POST["name"]);
        $prefix = sanitize($_POST["prefix"]);
        $status = sanitize($_POST["status"]);

        if(!empty($image)&&!empty($name)&&!empty($prefix)&&!empty($status)){
            echo saveStation($idx,$image,$name,$prefix,$status);
        }else{
            echo "Network Error!";
        }
    }else{
        echo "Access Denied!";
    }
}else{
    echo "Access Denied!";
}
?>