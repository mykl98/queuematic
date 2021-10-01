<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function getUserDetail($idx){
            global $conn;
            $data = array();
            $table = "account";
            $sql = "SELECT * FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $value = new \StdClass();
                    $value -> name = $row["name"];
                    $value -> image = $row["image"];
                    $value -> username = $row["username"];
                    $value -> station = $row["station"];

                    array_push($data,$value);
                }
                $data = json_encode($data);
                return "true*_*" . $data;
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "station"){
            $idx = sanitize($_POST["idx"]);
            echo getUserDetail($idx);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>