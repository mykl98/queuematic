<?php
if($_POST){
    include_once "../../../../system/backend/config.php";

    function checkUsernameExist($username){
        global $conn;
        $table = "account";
        $sql = "SELECT idx FROM `$table` WHERE username='$username'";
        if($result=mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                return "Username already exist. Please use select another username!";
            }else{
                return "true";
            }
        }else{
            return "System Error!";
        }
    }

    function getOldUsername($idx){
        global $conn;
        $username = "";
        $table = "account";
        $sql = "SELECT username FROM `$table` WHERE idx='$idx'";
        if($result=mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $username = $row["username"];
            }
        }
        return $username;
    }

    function saveAccount($idx,$name,$username,$access,$station,$status){
        global $conn;
        $table = "account";
        if($idx == ""){
            $check = checkUsernameExist($username);
            if($check != "true"){
                return $check;
            }
            $get = getOldUsername($idx);
            if($get != $username){
                $check = checkUsernameExist($username);
                if($check != "true"){
                    return $check;
                }
            }
            $sql = "INSERT INTO `$table` (name,username,password,station,access,saccess,status) VALUES ('$name','$username','123456',$station,'station','$access','$status')";
        }else{
            $sql = "UPDATE `$table` SET name='$name',username='$username',saccess='$access',status='$status' WHERE idx='$idx'";
        }
        if(mysqli_query($conn,$sql)){
            return "true*_*";
        }else{
            return "System Failed!";
        }
    }

    session_start();
    if($_SESSION["isLoggedIn"] == "true"){
        $idx = sanitize($_POST["idx"]);
        $name = sanitize($_POST["name"]);
        $username = sanitize($_POST["username"]);
        $access = sanitize($_POST["access"]);
        $status = sanitize($_POST["status"]);
        $station = $_SESSION["station"];
        if(!empty($name)&&!empty($username)&&!empty($access)&&!empty($status)){
            echo saveAccount($idx,$name,$username,$access,$station,$status);
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