<?php
    if($_POST){
        include_once "../../system/backend/config.php";

        function getSettings(){
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
                        if($row["name"] == "name"){
                            $value -> name = $row["value"];
                        }
                        if($row["name"] == "logo"){
                            $value -> logo = $row["value"];
                        }
                        if($row["name"] == "counter1name"){
                            $value -> counter1name = $row["value"];
                        }
                        if($row["name"] == "counter2name"){
                            $value -> counter2name = $row["value"];
                        }
                        if($row["name"] == "counter3name"){
                            $value -> counter3name = $row["value"];
                        }
                        if($row["name"] == "counter4name"){
                            $value -> counter4name = $row["value"];
                        }
                        if($row["name"] == "counter5name"){
                            $value -> counter5name = $row["value"];
                        }
                        
                        if($row["name"] == "counter1prefix"){
                            $value -> counter1prefix = $row["value"];
                        }
                        if($row["name"] == "counter2prefix"){
                            $value -> counter2prefix = $row["value"];
                        }
                        if($row["name"] == "counter3prefix"){
                            $value -> counter3prefix = $row["value"];
                        }
                        if($row["name"] == "counter4prefix"){
                            $value -> counter4prefix = $row["value"];
                        }
                        if($row["name"] == "counter5prefix"){
                            $value -> counter5prefix = $row["value"];
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
                        if($row["name"] == "color"){
                            $value -> color = $row["value"];
                        }
                    }
                    array_push($data, $value);
                }
                $data = json_encode($data);
                return "true*_*".$data;
            }else{
                return "System Failed!";
            }
        }

        session_start();
        //$_SESSION["isLoggedIn"] = "true";
        //$_SESSION["access"] = "machine";
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "machine"){
            echo getSettings();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>