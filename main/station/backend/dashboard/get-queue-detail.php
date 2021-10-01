<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function setSetting($name, $value){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='$value' WHERE name='$name'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "false";
            }
        }

        function getQueueDetail($idx){
            global $conn;
            $data = array();
            $table = "queue";
            $sql = "SELECT * FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $station = $row["station"];
                    $number = $row["number"];
                    $value = new \StdClass();
                    $value -> name = $row["name"];
                    $value -> purpose = $row["purpose"];
                    $value -> station = $station;
                    $value -> number = $number;
                    array_push($data,$value);
                    switch($station){
                        case "1":
                            setSetting("counter1serving", $number);
                            break;
                        case "2":
                            setSetting("counter2serving", $number);
                            break;
                        case "3":
                            setSetting("counter3serving", $number);
                            break;
                        case "4":
                            setSetting("counter4serving", $number);
                            break;
                        case "5":
                            setSetting("counter5serving", $number);
                            break;
                    }
                }
                $data = json_encode($data);
                return "true*_*".$data;
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "station"){
            $idx = sanitize($_POST["idx"]);
            echo getQueueDetail($idx);
        }else{
            "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>