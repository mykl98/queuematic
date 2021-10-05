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
        //echo "Access Denied!";
    }
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/vendor/bootstrap/css/bootstrap.min.css">
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
    </div><!-- wrapper -->
    <!-- modals -->
    <div class="modal fade" id="add-queue-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary" id="add-queue-modal-header"><strong>Add Queue</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="add-queue-modal-client_name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="add-queue-modal-client_name">
                        </div>
                        <div class="form-group">
                            <label for="add-queue-modal-client-purpose" class="col-form-label">Purpose:</label>
                            <textarea class="form-control" id="add-queue-modal-client-purpose"></textarea>
                        </div>
                    </form>
                    <p id="add-queue-error" class="text-danger font-italic small"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="addQueue()">Add</button>
                </div>
            </div>
        </div>
    </div>
<script src="../../system/vendor/jquery/js/jquery.min.js"></script>
<script src="../../system/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="script.js?c=1"></script>
</body>
</html>