<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function finishQueue($idx){
            global $conn;
            $table = "queue";
            $sql = "DELETE FROM `$table` WHERE idx='$idx'";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully processed the client.";
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "station"){
            $idx = sanitize($_POST["idx"]);
            echo finishQueue($idx);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>