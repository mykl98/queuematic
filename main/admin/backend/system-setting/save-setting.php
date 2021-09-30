<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function updateSetting($name,$value){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='$value' WHERE name='$name'";
            if(mysqli_query($conn,$sql)){
                return "true";
            }else{
                return "false";
            }
        }

        function saveSettings($logo,$name,$color,$station1name,$station2name,$station3name,$station4name,$station5name,$station1prefix,$station2prefix,$station3prefix,$station4prefix,$station5prefix){
            if(updateSetting("logo",$logo) == "false"){
                return "System Error";
            }else if(updateSetting("name",$name) == "false"){
                return "System Error1!";
            }else if(updateSetting("color",$color) == "false"){
                return "System Error2!";
            }else if(updateSetting("counter1name",$station1name) == "false"){
                return "System Error3!";
            }else if(updateSetting("counter2name",$station2name) == "false"){
                return "System Error4!";
            }else if(updateSetting("counter3name",$station3name) == "false"){
                return "System Error5!";
            }else if(updateSetting("counter4name",$station4name) == "false"){
                return "System Error6!";
            }else if(updateSetting("counter5name",$station5name) == "false"){
                return "System Error7!";
            }else if(updateSetting("counter1prefix",$station1prefix) == "false"){
                return "System Error8!";
            }else if(updateSetting("counter2prefix",$station2prefix) == "false"){
                return "System Error9!";
            }else if(updateSetting("counter3prefix",$station3prefix) == "false"){
                return "System Error10!";
            }else if(updateSetting("counter4prefix",$station4prefix) == "false"){
                return "System Error11!";
            }else if(updateSetting("counter5prefix",$station5prefix) == "false"){
                return "System Error12!";
            }else{
                return "true*_*Successfully save the system settings.";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            $logo = $_POST["logo"];
            $name = sanitize($_POST["name"]);
            $color = sanitize($_POST["color"]);
            $station1name = sanitize($_POST["station1name"]);
            $station2name = sanitize($_POST["station2name"]);
            $station3name = sanitize($_POST["station3name"]);
            $station4name = sanitize($_POST["station4name"]);
            $station5name = sanitize($_POST["station5name"]);
            $station1prefix = sanitize($_POST["station1prefix"]);
            $station2prefix = sanitize($_POST["station2prefix"]);
            $station3prefix = sanitize($_POST["station3prefix"]);
            $station4prefix = sanitize($_POST["station4prefix"]);
            $station5prefix = sanitize($_POST["station5prefix"]);
            echo saveSettings($logo,$name,$color,$station1name,$station2name,$station3name,$station4name,$station5name,$station1prefix,$station2prefix,$station3prefix,$station4prefix,$station5prefix);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>