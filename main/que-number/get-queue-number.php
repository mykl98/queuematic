<?php
    if($_POST){
        include_once "../../system/backend/config.php";
        session_start();

        function getQueueNumber(){
            global $conn;
            $idx = $_SESSION["queueidx"];
            $data = array();
            $table = "queue";
            $sql = "SELECT * FROM `$table` WHERE idx='$idx'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $value = new \StdClass();
                    $value -> idx = $row["idx"];
                    $value -> number = $row["number"];
                    $value -> station = $row["station"];
                    array_push($data,$value);
                    $data = json_encode($data);
                    return "true*_*".$data;
                }else{
                    $_SESSION["queueidx"] = "";
                    return "false*_*";
                }
                
            }else{
                return "System Error!";
            }
        }

        echo getQueueNumber();
    }else{
        echo "Access Denied!";
    }
?>