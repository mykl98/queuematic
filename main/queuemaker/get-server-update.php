<?php
    if($_POST){
        include_once "../../system/backend/config.php";

        function getServerUpdate(){
            global $conn;
            $data = array();
            $table = "settings";
            $sql = "SELECT * FROm `$table`";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $value = new \StdClass();
                    while($row=mysqli_fetch_array($result)){
                        if($row["name"] == "counter1serving"){
                            $value -> counter1serving = $row["value"];
                        }
                        if($row["name"] == "counter2serving"){
                            $value -> counter2serving = $row["value"];
                        }
                        if($row["name"] == "counter3serving"){
                            $value -> counter3serving = $row["value"];
                        }
                        if($row["name"] == "counter4serving"){
                            $value -> counter4serving = $row["value"];
                        }
                        if($row["name"] == "counter5serving"){
                            $value -> counter5serving = $row["value"];
                        }
                    }
                    array_push($data,$value);
                }
                $data = json_encode($data);
                return "true*_*". $data;
            }else{
                echo "System Error!";
            }
        }
        echo getServerUpdate();
    }else{
        echo "Access Denied!";
    }
?>