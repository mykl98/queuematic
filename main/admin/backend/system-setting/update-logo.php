<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function updateLogo($logo){
            global $conn;
            $table = "settings";
            $sql = "UPDATE `$table` SET value='$logo' WHERE name='logo'";
            if(mysqli_query($conn,$sql)){
                return "true*_*Successfully update client logo.";
            }else{
                return "System Failed!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            $logo = sanitize($_POST["logo"]);
            echo updateLogo($logo);
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>