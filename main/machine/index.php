<?php
session_start();
if($_SESSION["isLoggedIn"] != "true"){
    //header("location: ../../index.php");
    //exit();
}
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="wrapper" align="center">
        <div id="qr_code_container">
            <canvas id="qr_code"></canvas>
        </div>
        <div id="row_1">
            <div id="row_1_col_1">
                <video id="video" width="1200" height="650" autoplay muted loop>
                    <source src="../../system/videos/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div id="row_1_col_2" align="center"> 
                <img id="logo" src="../../system/images/logo.png">
                <p id="name">SkoolTech Solutions</p>
                <div id="now_serving_container">
                    <p id="now_serving_tag">NOW SERVING</p>
                    <p id="now_serving_counter" class="tag_number"></p>
                    <p id="now_serving_number" class="tag_number"><p>
                </div>
                <p id="date">February 9, 1986</p>
                <p id="time">11:58 AM</p>
            </div>
        </div>
        <div id="row_2">
            <div id="row_2_col_1" class="station">
                <p id="station_1_tag" class="station_tag">Counter 1</p>
                <p id="station_1_number" class="station_number">0</p>
            </div>
            <div id="row_2_col_2" class="station">
                <p id="station_2_tag" class="station_tag">Counter 2</p>
                <p id="station_2_number" class="station_number">0</p>
            </div>
            <div id="row_2_col_3" class="station">
                <p id="station_3_tag" class="station_tag">Counter 3</p>
                <p id="station_3_number" class="station_number">0</p>
            </div>
            <div id="row_2_col_4" class="station">
                <p id="station_4_tag" class="station_tag">Counter 4</p>
                <p id="station_4_number" class="station_number">0</p>
            </div>
            <div id="row_2_col_5" class="station">
                <p id="station_5_tag" class="station_tag">Counter 5</p>
                <p id="station_5_number" class="station_number">0</p>
            </div>
        </div>
        <div id="row_3" width="100%" direction="left">
            <marquee id="announcement">
                Powered by: SkoolTech Solutions
            </marquee>
        </div>
    </div> <!-- wrapper -->
<script src="../../system/vendor/jquery/js/jquery.min.js"></script>
<script src="../../system/vendor/qr/qr.min.js"></script>
<script src="../../system/js/script.js"></script>
<script src="script.js"></script>
</body>
</html>