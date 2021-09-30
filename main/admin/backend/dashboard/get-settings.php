<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function getSettings(){
            global $conn;
            $data = array();
            $table = "settings";
            $sql = "SELECT * FROM `$table`";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $value = new \StdClass();
                    while($row=mysqli_fetch_array($result)){
                        if($row["name"] == "name"){
                            $value -> name = $row["value"];
                        }
                        if($row["name"] == "logo"){
                            $value -> logo = $row["value"];
                        }
                        if($row["name"] == "color"){
                            $value -> color = $row["value"];
                        }
                        if($row["name"] == "counter1name"){
                            $value -> station1name = $row["value"];
                        }
                        if($row["name"] == "counter2name"){
                            $value -> station2name = $row["value"];
                        }
                        if($row["name"] == "counter3name"){
                            $value -> station3name = $row["value"];
                        }
                        if($row["name"] == "counter4name"){
                            $value -> station4name = $row["value"];
                        }
                        if($row["name"] == "counter5name"){
                            $value -> station5name = $row["value"];
                        }
                        if($row["name"] == "counter1prefix"){
                            $value -> station1prefix = $row["value"];
                        }
                        if($row["name"] == "counter2prefix"){
                            $value -> station2prefix = $row["value"];
                        }
                        if($row["name"] == "counter3prefix"){
                            $value -> station3prefix = $row["value"];
                        }
                        if($row["name"] == "counter4prefix"){
                            $value -> station4prefix = $row["value"];
                        }
                        if($row["name"] == "counter5prefix"){
                            $value -> station5prefix = $row["value"];
                        }
                    }
                    array_push($data,$value);
                }
                $data = json_encode($data);
                return "true*_*" . $data;
            }else{
                return "System Error!";
            }
        }

        session_start();
        $_SESSION["isLoggedIn"] = "true";
        $_SESSION["access"] = "admin";
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            echo getSettings();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>