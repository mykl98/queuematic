<?php
    if($_POST){
        include_once "../../system/backend/config.php";
        session_start();

        function getLastNumber($station){
            global $conn;
            $number = 0;
            $table = "queue";
            $sql = "SELECT number FROM `$table` WHERE station='$station'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_array($result)){
                        $number = $row["number"];
                    }
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
                return "true*_*" . $idx;
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