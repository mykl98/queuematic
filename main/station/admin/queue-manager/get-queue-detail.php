<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function getCurrentQueueIdx($station){
            global $conn;
            $queueIdx = "";
            $table = "queue";
            $sql = "SELECT queueidx FROM `$table` WHERE station='$station'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $queueIdx = $row["queueidx"];
                }
            }
            return $queueIdx;
        }

        function getStationPrefix($station){
            global $conn;
            $prefix = "";
            $table = "station";
            $sql = "SELECT prefix FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $prefix = $row["prefix"];
                }
            }
            return $prefix;
        }

        function getQueue($idx){
            global $conn;
            $data = array();
            $table = "list";
            $sql = "SELECT * FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $value = new \StdClass();
                    $value -> idx = $row["idx"];
                    $value -> number = getStationPrefix($row["station"]) . $row["number"];
                    $value -> name = $row["name"];
                    $value -> purpose = $row["purpose"];
                    array_push($data,$value);
                }
            }
            $data = json_encode($data);
            return "true*_*" .$data;
        }

        function getNewQueueIdx($station){
            global $conn;
            $idx = "";
            $table = "list";
            $sql = "SELECT idx FROM `$table` WHERE station='$station' && status='001' ORDER BY idx INC";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $idx = $row["idx"];
                }
            }
            return $idx;
        }

        function updateQueueStatus($queueIdx){
            global $conn;
            $table = "list";
            $sql = "UPDATE `$table` SET status='002' WHERE idx='$queueIdx'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function addToQueue($queueIdx){
            global $conn;
            $table = "queue";
            $sql = "INSERT INTO `$table` (queueidx) VALUES ($queueIdx)";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function updateQueueFlag(){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='1' WHERE name='get_queue_flag'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "System Error!";
            }
        }

        function getQueueDetail($station){
            $queueIdx = getCurrentQueueIdx($station);
            if($queueIdx != ""){
                return getQueue($queueIdx);
            }
            $queueIdx = getNewQueueIdx($station);
            if($queueIdx != ""){
                $update = updateQueueStatus($queueIdx);
                if($update != "true"){
                    return $update;
                }
                $add = addToQueue($queueIdx);
                if($add != "true"){
                    return $add;
                }
                $update = updateQueueFlag();
                if($update != "true"){
                    return $update;
                }
                return getQueue($queueIdx);
            }else{
                return "Currently your station has no client in queue!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true"){
            $station = $_SESSION["station"];
            echo getQueueDetail($station);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>