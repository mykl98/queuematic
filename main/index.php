<?php
include_once "../system/backend/config.php";
    session_start();
    if($_SESSION["isLoggedIn"] == "true"){
        $access = $_SESSION["access"];
        switch ($access){
            case "admin":
                header("location:admin/queue-manager");
                exit();
                break;
            case "station":
                $saccess = $_SESSION["saccess"];
                if($saccess == "admin"){
                    header("location:station/admin/manage-account");
                    exit();
                }else if($saccess == "staff"){
                    header("location:station/staff/queue-manager");
                    exit();
                }
                break;
        }
    }else{
        session_destroy();
        header("location:../index.php");
        exit();
    }
?>