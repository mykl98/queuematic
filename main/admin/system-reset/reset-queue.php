<?php
    if($_POST){
        include_once "../../../system/backend/config.php";

        function resetQueueDb(){
            global $conn;
            $table = "queue";
            $sql = "DELETE FROM `$table`";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function resetListDb(){
            global $conn;
            $table = "list";
            $sql = "DELETE FROM `$table`";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function resetQueueCounter(){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='0' WHERE name='queue_counter'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function resetQueue(){
            $reset = resetQueueDb();
            if($reset != "true"){
                return $reset;
            }
            $reset = resetListDb();
            if($reset != "true"){
                return $reset;
            }
            $reset = resetQueueCounter();
            if($reset != "true"){
                return $reset;
            }
            return "true";
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true"){
            echo resetQueue();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>