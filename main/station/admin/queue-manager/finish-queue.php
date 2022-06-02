<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function updateQueueStatus($queueIdx){
            global $conn;
            $table = "list";
            $sql = "UPDATE `$table` SET status='003' WHERE idx='$queueIdx'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function removeFromQueue($queueIdx){
            global $conn;
            $table = "queue";
            $sql = "DELETE FROM `$table` WHERE queueidx='$queueIdx'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function finishQueue($queueIdx){
            $update = updateQueueStatus($queueIdx);
            if($update != "true"){
                return $update;
            }
            $remove = removeFromQueue($queueIdx);
            if($remove != "true"){
                return $remove;
            }
            return "true*_*";
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true"){
            $queueIdx = $_SESSION["queueidx"];
            echo finishQueue($queueIdx);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>