<?php
    if($_POST){
        include_once "../../../system/backend/config.php";

        function getStationPrefix($idx){
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

        function getStationName($idx){
            global $conn;
            $name = "";
            $table = "station";
            $sql = "SELECT name FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $name = $row["name"];
                }
            }
            return $name;
        }

        function getQueueList(){
            global $conn;
            $data = array();
            $table = "list";
            $sql = "SELECT * FROM `$table` ORDER by idx DESC";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_array($result)){
                        if($row["idx"] != 0){
                            $value = new \StdClass();
                            $value -> idx = $row["idx"];
                            $value -> number = getStationPrefix($row["station"]) . $row["number"];
                            $value -> date = $row["date"];
                            $value -> time = $row["time"];
                            $value -> name = $row["name"];
                            $value -> purpose = $row["purpose"];
                            $value -> station = getStationName($row["station"]);
                            $value -> status = $row["status"];
                            array_push($data,$value);
                        }
                    }
                }
                $data = json_encode($data);
                return "true*_*".$data;
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true"){
            echo getQueueList();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>