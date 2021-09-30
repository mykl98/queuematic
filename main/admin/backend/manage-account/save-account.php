<?php
if($_POST){
    include_once "../../../../system/backend/config.php";

    function saveAccount($idx,$name,$username,$access,$station,$status){
        global $conn;
        $table = "account";
        if($idx == ""){
            $sql = "INSERT INTO `$table` (name,username,password,access,station,status) VALUES ('$name','$username','123456','$access','$station','$status')";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully added " . $name . "'s account to account list.";
            }else{
                return "System Failed!";
            }
        }else{
            $sql = "UPDATE `$table` SET name='$name',username='$username',access='$access',station='$station',status='$status' WHERE idx='$idx'";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully updated " . $name . "'s account in account list.";
            }else{
                return "System Failed2!";
            }
        }
    }

    session_start();
    if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
        $idx = sanitize($_POST["idx"]);
        $name = sanitize($_POST["name"]);
        $username = sanitize($_POST["username"]);
        $access = sanitize($_POST["access"]);
        $station = sanitize($_POST["station"]);
        $status = sanitize($_POST["status"]);

        echo saveAccount($idx,$name,$username,$access,$station,$status);
    }else{
        echo "Access Denied!";
    }
}else{
    echo "Access Denied!";
}
?>