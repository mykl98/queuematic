<?php
    if(isset($_POST)){
        include_once "../../../../system/backend/config.php";

        function getQueue($station){
            global $conn;
            $data = array();
            $table = "queue";
            $sql = "SELECT * FROM `$table` WHERE station='$station'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_array($result)){
                        $value = new \StdClass();
                        $value -> idx = $row["idx"];
                        $value -> number = $row["number"];
                        $value -> name = $row["name"];
                        $value -> purpose = $row["purpose"];
                        $value -> station = $row["station"];

                        array_push($data,$value);
                    }
                }
            }

            $data = json_encode($data);
            return $data;
        }

        function getServerData($station){
            global $conn;
            $data = array();
            $table = "settings";
            $sql = "SELECT * FROM `$table`";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $value = new \StdClass();
                    while($row=mysqli_fetch_array($result)){
                        if($row["name"] == "counter1serving"){
                            $value -> station1serving = $row["value"];
                        }
                        if($row["name"] == "counter2serving"){
                            $value -> station2serving = $row["value"];
                        }
                        if($row["name"] == "counter3serving"){
                            $value -> station3serving = $row["value"];
                        }
                        if($row["name"] == "counter4serving"){
                            $value -> station4serving = $row["value"];
                        }
                        if($row["name"] == "counter5serving"){
                            $value -> station5serving = $row["value"];
                        }
                    }
                    $value -> queue = getQueue($station);
                    array_push($data,$value);
                }
                $data = json_encode($data);
                return "true*_*".$data;
            }else{
                return "System Failed!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "station"){
            $station = sanitize($_POST["station"]);

            echo getServerData($station);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>