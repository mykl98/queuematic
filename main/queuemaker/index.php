<?php
    if($_GET){
        include_once "../../system/backend/config.php";

        function getToken(){
            global $conn;
            $table = "settings";
            $sql = "SELECT * FROM `$table` WHERE name='token'";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result)){
                    $row = mysqli_fetch_array($result);
                    $token = $row["value"];
                }
                return $token;
            }
        }

        $token = $_GET["token"];
        $serverToken = getToken();
        if($token == $serverToken){
            echo $serverToken;
        }else{
            echo "Token Expired!";
        }
    }else{
        echo "Access Denied!";
    }
?>