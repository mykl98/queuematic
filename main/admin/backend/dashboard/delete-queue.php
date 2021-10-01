<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function deleteQueue($idx){
            global $conn;
            $table = "queue";
            $sql = "DELETE FROM `$table` WHERE idx='$idx'";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully deleted the queue number.";
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            $idx = sanitize($_POST["idx"]);
            echo deleteQueue($idx);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>