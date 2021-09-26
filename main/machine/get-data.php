<?php
    if($_POST){
        include_once "../../system/backend/config.php";

        function updateUpdateSetting(){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='false' WHERE name='update'";
            if(mysqli_query($conn,$sql)){
                return "success";
            }else{
                return "System Error2!";
            }
        }

        function getData(){
            global $conn;
            $data = array();
            $table = "settings";
            $sql = "SELECT * FROM `$table`";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $value = new \StdClass();
                    while($row=mysqli_fetch_array($result)){
                        if($row["name"] == "update"){
                            $value -> update = $row["value"];
                        }
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
                    array_push($data, $value);
                }
                $data = json_encode($data);
                $updateUpdateSetting = updateUpdateSetting();
                if($updateUpdateSetting == "success"){
                    return "true*_*".$data;
                }else{
                    return $updateUpdateSetting;
                }
                
            }else{
                return "System Error1!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "machine"){
            echo getData();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>