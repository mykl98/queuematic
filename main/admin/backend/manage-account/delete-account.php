<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function deleteAccount($idx,$name){
            global $conn;
            $table = "account";
            $sql = "DELETE FROM `$table` WHERE idx='$idx'";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully deleted " . $name . "'s account.";
            }else{
                return "System Failed!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            $idx = sanitize($_POST["idx"]);
            $name = sanitize($_POST["name"]);
            echo deleteAccount($idx,$name);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>