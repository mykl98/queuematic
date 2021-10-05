<?php
    if($_POST){
        include_once "../../system/backend/config.php";
        session_start();
        $stationName;

        function setSettings($value){
            global $conn,$stationName;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='$value' WHERE name='$stationName'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "false";
            }
        }

        function getLastNumber($station){
            global $conn,$stationName;
            $number = 0;
            $table = "settings";
            switch($station){
                case "1":
                    $stationName = "counter1last";
                    break;
                case "2":
                    $stationName = "counter2last";
                     break;
                case "3":
                    $stationName = "counter3last";
                    break;
                case "4":
                    $stationName = "counter4last";
                    break;
                case "5":
                    $stationName = "counter5last";
                    break;   
            }
            $sql = "SELECT value FROM `$table` WHERE name='$stationName'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $number = $row["value"];
                }
            }
            return $number;
        }

        function getIdx($number,$station){
            global $conn;
            $idx = 0;
            $table = "queue";
            $sql = "SELECT idx FROM `$table` WHERE number='$number' AND station='$station'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $idx = $row["idx"];
                }
            }
            return $idx;
        }

        function setAppointment($station,$name,$purpose){
            global $conn;
            $number = getLastNumber($station);
            $number = $number + 1;
            $table = "queue";
            $sql = "INSERT INTO `$table` (number,name,purpose,station) VALUES ('$number','$name','$purpose','$station')";
            if(mysqli_query($conn,$sql)){
                $idx = getIdx($number,$station);
                $_SESSION["queueidx"] = $idx;
                $setSettings = setSettings($number);
                if($setSettings == "true"){
                    return "true*_*" . $idx;
                }else{
                    return "System Error!";
                }
            }else{
                return "System Error!";
            }
        }

        $station = sanitize($_POST["station"]);
        $name = sanitize($_POST["name"]);
        $purpose = sanitize($_POST["purpose"]);

        echo setAppointment($station,$name,$purpose);
    }else{
        echo "Access Denied!";
    }
?>