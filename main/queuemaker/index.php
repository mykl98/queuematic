<?php
    if($_GET){
        include_once "../../system/backend/config.php";
        session_start();
        $idx = $_SESSION["queueidx"];
        if($idx != ""){
            header("location:../que-number");
            exit();
        }

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

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/vendor/jquery-modal/css/jquery-modal.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="wrapper" align="center">
        <img id="logo" src="../../system/images/logo.png">
        <p id="name">SkoolTech Solutions</p>
        <div id="station_1" class="station" onClick="showModal('1')">
            <p id="station_1_label" class="station_label">Counter 1</p>
            <p id="station_1_number" class="station_number">0</p>
        </div>
        <div id="station_2" class="station" onClick="showModal('2')">
            <p id="station_2_label" class="station_label">Counter 2</p>
            <p id="station_2_number" class="station_number">0</p>
        </div>
        <div id="station_3" class="station" onClick="showModal('3')">
            <p id="station_3_label" class="station_label">Counter 3</p>
            <p id="station_3_number" class="station_number">0</p>
        </div>
        <div id="station_4" class="station" onClick="showModal('4')">
            <p id="station_4_label" class="station_label">Counter 4</p>
            <p id="station_4_number" class="station_number">0</p>
        </div>
        <div id="station_5" class="station" onClick="showModal('5')">
            <p id="station_5_label" class="station_label">Counter 5</p>
            <p id="station_5_number" class="station_number">0</p>
        </div>
        <div id="modal_1" class="modal">
            <p id="modal_1_header_text"></p>
            <p class="modal_1_tag">Name:</p>
            <input type="text" id="client_name">
            <p class="modal_1_tag">Purpose:</p>
            <textarea id="client_purpose"></textarea>
            <p id="modal_1_error"></p>
            <input id="modal_1_submit_button" type="submit" value="Submit" onclick="modal1Response()">
        </div>
    </div><!-- wrapper -->
<script src="../../system/vendor/jquery/jquery.min.js"></script>
<script src="../../system/vendor/jquery-modal/js/jquery-modal.min.js"></script>
<script src="script.js"></script>
</body>
</html>