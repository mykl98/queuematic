<?php
    if($_POST){
        include_once "../../../../system/backend/config.php";

        function getAccountList(){
            global $conn;
            $data = array();
            $table = "account";
            $sql = "SELECT * FROM `$table`";
            if($result=mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_array($result)){
                        if($row["idx"] != 0){
                            $value = new \StdClass();
                            $value -> idx = $row["idx"];
                            $value -> image = $row["image"];
                            $value -> name = $row["name"];
                            $value -> access = $row["access"];
                            $value -> status = $row["status"];

                            array_push($data,$value);
                        }
                    }
                }
                $data = json_encode($data);
                return "true*_*".$data;
            }else{
                return "System Error!";
            }
        }

        session_start();
        if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
            echo getAccountList();
        }else{
            echo "Access Denied!";
        }
    }else{
        echo "Access Denied!";
    }
?>