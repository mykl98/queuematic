<?php
    if($_POST){
        include_once "../../system/backend/config.php";
        function getToken($length){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function generateToken(){
            global $conn;
            $token = getToken(100);
            $table = "settings";
            $sql = "UPDATE `$table` SET value='$token' WHERE name='token'";
            if(mysqli_query($conn,$sql)){
                return "true*_*".$token;
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "machine"){
            echo generateToken();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>