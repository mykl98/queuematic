<?php
    include_once "../../system/backend/config.php";
    $name = "Michael Martin G. Abellana";
    $image = "../../system/images/blank-profile.png";

    session_start();
    $idx = $_SESSION["loginidx"];

    if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "station"){
        
    }else{
        //header("location:../../index.php");
        //exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../../system/vendor/bootstrap/css/bootstrap.min.css">
    <!--Datatable-->
    <link rel="stylesheet" href="../../system/vendor/datatables/css/dataTables.bootstrap4.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="../../system/vendor/quick-sand/css/quicksand.css">
    <link rel="stylesheet" href="css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="../../system/vendor/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../system/vendor/fontawesome/css/fontawesome.css">
    <!--Animate CSS-->
    <link rel="stylesheet" href="../../system/vendor/animate/css/animate.min.css">
    <!--Croppie-->
    <link rel="stylesheet" href="../../system/vendor/croppie/css/croppie.css">

    <title>SkoolTech Solutions</title>
  </head>
  <body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class="container-fluid">

        <!--Header-->
        <div class="row header shadow-sm">
            
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
               <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                    <h3 class="logo"><a href="#" class="text-secondary logo">SkoolTech Solutions</a></h3>
               </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    
                    <!--Menu Icons-->
                    <div class="col-sm-4 col-8 pl-0">

                        <!--Toggle sidebar-->
                        <span class="menu-icon" onclick="toggle_sidebar()">
                            <span id="sidebar-toggle-btn"></span>
                        </span>
                        <!--Toggle sidebar-->
                        
                    </div>
                    <!--Menu Icons-->

                    <!--Search box and avatar-->
                    <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                        <div class="p-3">
                            <p id="user-global-name" class=""><?php echo $idx;?></p>
                        </div>
                        <div class="mr-4">
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="user-global-image" src="../../system/images/blank-profile.png" class="rounded-circle" width="40px" height="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" onclick="toggle_menu('profile_settings')"><i class="fa fa-user pr-2"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="$('#logout-modal').modal('show');"><i class="fa fa-power-off pr-2"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->

        <div class="row main-content">
            <!--Sidebar left-->
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-3">
                    <!--Image Avatar-->
                    <div class="avatar text-center">
                        <img id="global-client-logo" src="../../system/images/logo.png" alt="" class="rounded-circle" />
                        <p id="global-client-name"><strong>SkoolTech Solutions</strong></p>
                    </div>
                    <!--Image Avatar-->

                    <!--Sidebar Navigation Menu-->
                    <div class="sidebar-menu-container">
                        <ul class="sidebar-menu mt-4 mb-4">
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('dashboard'); return false" class=""><i class="fa fa-dashboard mr-3"> </i>
                                    <span class="none">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>
            <!--Sidebar left-->

            <!--Content right-->
            <div id="dashboard" class="col-sm-9 col-xs-12 content pt-3 pl-0 page">
                <h5 class="mb-3" ><strong>Dashboard</strong></h5>
                
                <!--Dashboard widget-->
                <div class="mt-1 mb-3 button-container">
                    <div class="row pl-0">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="bg-secondary border shadow rounded">
                                <div class="p-2 text-center">
                                    <h5 id="station_1_name" class="mb-0 mt-2 text-light"><small><strong>Station 1</strong></small></h5>
                                    <h1 id="station_1_number">A0</h1>
                                </div>
                                <div id="dashboard_station_1_queue" class="text-center text-light">
                                    5 Currently in queue
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="bg-success border shadow rounded">
                                <div class="p-2 mb-1 text-center">
                                    <h5 id="station_2_name" class="mb-0 mt-2 text-light"><small><strong>Station 2</strong></small></h5>
                                    <h1 id="station_2_number" class="text-white">B0</h1>
                                </div>
                                <div id="dashboard_station_2_queue" class="text-center text-light">
                                    8 Currently in queue
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="bg-primary border shadow rounded">
                                <div class="p-2 text-center">
                                    <h5 id="station_3_name" class="mb-0 mt-2 text-light"><small><strong>Station 3</strong></small></h5>
                                    <h1 id="station_3_number" class="text-white">C0</h1>
                                </div>
                                <div id="dashboard_station_3_queue" class="text-center text-light">
                                    8 Currently in queue
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Dashboard widget-->

                <!--Dashboard widget-->
                <div class="mt-1 mb-3 button-container">
                    <div class="row pl-0">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="bg-warning border shadow rounded">
                                <div class="p-2 text-center">
                                    <h5 id="station_4_name" class="mb-0 mt-2 text-light"><small><strong>Station 4</strong></small></h5>
                                    <h1 id="station_4_number">D0</h1>
                                </div>
                                <div id="dashboard_station_4_queue" class="text-center text-light">
                                    5 Currently in queue
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="bg-dark border shadow rounded">
                                <div class="p-2 mb-1 text-center">
                                    <h5 id="station_5_name" class="mb-0 mt-2 text-light"><small><strong>Station 5</strong></small></h5>
                                    <h1 id="station_5_number" class="text-white">E0</h1>
                                </div>
                                <div id="dashboard_station_5_queue" class="text-center text-light">
                                    8 Currently in queue
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <div id="now_serving" class="bg-danger border shadow rounded">
                                <div class="p-2 text-center">
                                    <h5 id="now_serving_station" class="mb-0 mt-2 text-light"><small><strong>Now Serving</strong></small></h5>
                                    <h1 id="now_serving_number" class="text-white">C0</h1>
                                </div>
                                <div id="dashboard_now_serving_queue" class="text-center text-light">
                                    100 Currently in queue
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Dashboard widget-->

                <!--Datatable-->
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Datatable-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <h6 id="station-current-queue-table-label" class="mb-2 float-left">Currently in Queue</h6>
                                <div class="float-right">
                                    <button class="btn btn-theme" onclick="acceptQueue()">Accept</button>
                                </div>
                            <div class="table-responsive">
                                <div id="dashboard-table-container"></div>
                            </div>
                        </div>
                        <!--/Datatable-->

                    </div>
                </div>

                <!--Footer-->
                <div class="row mt-5 mb-2 footer">
                    <div class="col-sm-8 text-right">
                        <span>&copy; All rights reserved 2021 designed by <a class="text-theme" href="#">SkoolTech Solutions</a></span>
                    </div>
                    <div class="col-sm-4 text-left">
                        <a href="#" class="ml-2">Contact Us</a>
                        <a href="#" class="ml-2">Support</a>
                    </div>
                </div>
                <!--Footer-->

            </div> <!-- Dashboard -->

            <div id="profile_settings" class="col-sm-9 col-xs-12 content pt-3 pl-0 page">
                <h5 class="mb-3" ><strong>Profile Settings</strong></h5>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Default elements-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            
                            <form class="form-horizontal mt-4 mb-5">
                                <div class="mb-4">
                                <input type="file" accept="image/*" onchange="loadProfileImage(event)" style="display:none;" id="load-profile-picture-btn">
                                    <img id="profile-settings-picture" src="../../system/images/blank-profile.png" onclick="$('#load-profile-picture-btn').click()" width="150" >
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="profile-settings-name">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="profile-settings-name" placeholder="Your name" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="profile-settings-username">Username:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="profile-settings-username" placeholder="Your username" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12" align="right">
                                        <button class="form-control btn bg-danger text-white col-sm-2" onclick="profileChangePassword()">Change Password</button>
                                        <button class="form-control btn bg-theme col-sm-2" onclick="saveProfileSettings()">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="row mt-5 mb-2 footer">
                    <div class="col-sm-8 text-right">
                        <span>&copy; All rights reserved 2021 designed by <a class="text-theme" href="#">SkoolTech Solutions</a></span>
                    </div>
                    <div class="col-sm-4 text-left">
                        <a href="#" class="ml-2">Contact Us</a>
                        <a href="#" class="ml-2">Support</a>
                    </div>
                </div>
                <!--Footer-->

            </div> <!-- Profile Settings -->
        </div>

        <!--Main Content-->

    </div>

    <!--Page Wrapper-->

    <!-- Modals -->

    <!-- Accept Queue Modal -->
    <div class="modal fade" id="dashboard-accept-queue-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accept Queue Number</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <h1 class="display-1 text-center" id="dashboard-accept-queue-modal-number"></h1>
                        <div class="form-group">
                            <label for="dashboard-accept-queue-modal-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="dashboard-accept-queue-modal-name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dashboard-accept-queue-modal-purpose" class="col-form-label">Purpose:</label>
                            <input type="text" class="form-control" id="dashboard-accept-queue-modal-purpose">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="finishQueueNumber()">Finish</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Change Password Modal -->
    <div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manage-account-add-edit-account-modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearChangePasswordModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="profile-setting-old-password" class="col-form-label">Old Password:</label>
                            <input type="text" class="form-control" id="profile-setting-old-password">
                        </div>
                        <div class="form-group">
                            <label for="profile-setting-new-password" class="col-form-label">New Password:</label>
                            <input type="text" class="form-control" id="profile-setting-new-password">
                        </div>
                        <div class="form-group">
                            <label for="profile-setting-retype-password" class="col-form-label">Retype Password:</label>
                            <input type="text" class="form-control" id="profile-setting-retype-password">
                        </div>
                    </form>
                    <p id="change-password-modal-error" class="text-danger font-italic small"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearChangePasswordModal()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="savePassword()">Change</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Image Editor Modal -->
    <div class="modal" id="profile-image-editor-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary"><strong>Profile images Editor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="profileImageEditorCancel()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="profile-image-editor-buffer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="profileImageEditorRotate()">Rotate</button>
                    <button type="button" class="btn btn-theme" data-dismiss="modal" id="profile-image-editor-ok-btn">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary"><strong>Logout</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="logout()">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page JavaScript Files-->
    <!-- jQuery -->
    <script src="../../system/vendor/jquery/js/jquery.min.js"></script>
    <script src="../../system/vendor/jquery/js/jquery.dataTables.min.js"></script>
    <!--Popper JS-->
    <script src="../../system/vendor/popper/js/popper.min.js"></script>
    <!--Bootstrap-->
    <script src="../../system/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--Datatables-->
    <script src="../../system/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <!--Sweet alert JS-->
    <script src="../../system/vendor/sweet-alert/js/sweetalert.js"></script>
    <!--Croppie-->
    <script src="../../system/vendor/croppie/js/croppie.js"></script>
    
    <!--Custom Js Script-->
    <script src="js/dashboard.js"></script>
    <script src="js/profile-setting.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>