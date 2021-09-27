<?php
    if($_POST){
        include_once "../../system/backend/config.php";
        session_start();

        function deleteQueueNumber(){
            global $conn;
            $idx = $_SESSION["queueidx"];
            $table = "queue";
            $sql = "DELETE FROM `$table` WHERE idx='$idx'";
            if(mysqli_query($conn,$sql)){
                return "true*_*";
            }else{
                return "false*_*";
            }
        }

        echo deleteQueueNumber();
    }else{
        echo "Access Denied!";
    }
?>