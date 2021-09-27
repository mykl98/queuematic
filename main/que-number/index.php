<?php
    session_start();
    $idx = $_SESSION["queueidx"];
    if($idx == ""){
        header("location:../queuemaker");
        exit();
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
        <div id="container">
            <div id="header">
                <img id="logo" src="../../system/images/logo.png">
                <p id="name">SkoolTech Solutions</p>
            </div>
            <p id="station_label">Station 1</p>
            <p id="station_number">8888</p>
            <p id="date_time"><p>
            <div id="footer" onClick="cancelNumber()">
                <p id="cancel_text">Cancel</p>
            </div>
        </div>
    </div>
    <script src="../../system/vendor/jquery/jquery.min.js"></script>
    <script src="../../system/vendor/jquery-modal/js/jquery-modal.min.js"></script>
    <script src="script.js"></script>
</body>
</html>