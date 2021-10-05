<?php
    include_once "../../system/backend/config.php";
    $name = "Michael Martin G. Abellana";
    $image = "../../system/images/blank-profile.png";

    session_start();
    $idx = $_SESSION["loginidx"];

    if($_SESSION["isLoggedIn"] == "true" && $_SESSION["access"] == "admin"){
        $table = "account";
        $sql = "SELECT name,image FROM `$table` WHERE idx='$idx'";
        if($result=mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $image = $row["image"];
                $name = $row["name"];
            }
        }
        if($image == ""){
            $image = "../../system/images/blank-profile.png";
        }
        if($name == ""){
            $name = "Michael Martin G. Abellana";
        }
    }else{
        header("location:../../index.php");
        exit();
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
                            <p id="user-global-name" class=""><?php echo $name;?></p>
                        </div>
                        <div class="mr-4">
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="user-global-image" src="<?php echo $image;?>" class="rounded-circle" width="40px" height="40px">
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
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('manage_account')" class=""><i class="fas fa-user-circle mr-3"></i>
                                    <span class="none">Manage Accounts</span>
                                </a>
                            </li>
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('system_settings')" class=""><i class="fas fa-sun mr-3"></i>
                                    <span class="none">System Settings</span>
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
                            <h6 class="mb-2">Currently in Queue</h6>
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

            <div id="manage_account" class="col-sm-9 col-xs-12 content pt-3 pl-0 page">
                <h5 class="mb-3" ><strong>Manage Accounts</strong></h5>
                <!--Datatable-->
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Datatable-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <button class="btn bg-theme mb-2 float-right" onclick="addAccount()"><span class="fa fa-plus"></span> Add Account</button>
                            <h6 class="mb-2">Account List</h6>
                            <div class="table-responsive">
                                <div id="manage-account-table-container"></div>
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

            </div> <!-- Manage Account -->

            <div id="system_settings" class="col-sm-9 col-xs-12 content pt-3 pl-0 page">
                <h5 class="mb-3" ><strong>System Settings</strong></h5>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Default elements-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            
                            <form class="form-horizontal mt-4 mb-5">
                                <div class="mb-4">
                                <input type="file" accept="image/*" onchange="loadClientLogo(event)" style="display:none;" id="load-client-logo-btn">
                                    <img id="system-settings-client-logo" src="../../system/images/logo.png" onclick="$('#load-client-logo-btn').click()" width="150" >
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-client-name">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-client-name" placeholder="SkoolTech Solutions" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-client-color">Color:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-client-color" placeholder="#000080" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-client-ip">IP Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-client-ip" placeholder="192.168.1.10" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-1-name">Station 1 Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-1-name" placeholder="Station 1" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-2-name">Station 2 Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-2-name" placeholder="Station 2" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-3-name">Station 3 Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-3-name" placeholder="Station 3" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-4-name">Station 4 Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-4-name" placeholder="Station 4" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-5-name">Station 5 Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-5-name" placeholder="Station 5" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-1-prefix">Station 1 Prefix:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-1-prefix" placeholder="A" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-2-prefix">Station 2 Prefix:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-2-prefix" placeholder="B" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-3-prefix">Station 3 Prefix:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-3-prefix" placeholder="C" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-4-prefix">Station 4 Prefix:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-4-prefix" placeholder="D" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2" for="system-settings-station-5-prefix">Station 5 Prefix:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="system-settings-station-5-prefix" placeholder="E" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12" align="right">
                                        <button class="form-control btn bg-theme col-sm-2" onclick="saveSettings()">Save</button>
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

            </div> <!-- System Settings -->

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

    <!-- Dashboard Modals -->
    <div class="modal fade" id="delete-queue-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary"><strong>Warning</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete-queue-modal-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Account Modals -->
    <div class="modal fade" id="manage-account-add-edit-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manage-account-add-edit-account-modal-title">Create New Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearAddEditAccountModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div align="center">
                            <img class="rounded-circle" width="150" src="../../system/images/blank-profile.png" id="account-image">
                        </div>
                        <div class="form-group">
                            <label for="account-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="account-name">
                        </div>
                        <div class="form-group">
                            <label for="account-username" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="account-username">
                        </div>
                        <div class="form-group">
                            <label for="account-access" class="col-form-label">Access:</label>
                            <select class="form-control" id="account-access" onchange="accountAccessChanged()">
                                <option value="admin">Admin</option>
                                <option value="station">Station</option>
                                <option value="machine">Machine</option>
                            </select>
                        </div>
                        <div id="manage-account-station-list-container"></div>
                        <div class="form-group">
                            <label for="account-status" class="col-form-label">Status:</label>
                            <select class="form-control" id="account-status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                    <p id="save-account-error" class="text-danger font-italic small"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearAddEditAccountModal()">Close</button>
                    <button type="button" class="btn btn-primary" id="add-edit-account-modal-save-button" onclick="saveAccount()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- System Setting Modals -->
    <div class="modal" id="client-logo-editor-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary"><strong>Client Logo Editor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clientLogoEditorCancel()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="client-logo-editor-buffer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="clientLogoEditorRotate()">Rotate</button>
                    <button type="button" class="btn btn-theme" data-dismiss="modal" id="client-logo-editor-ok-btn">Ok</button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="savePassword()">Change</button>
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
    <script src="js/manage-account.js"></script>
    <script src="js/system-setting.js"></script>
    <script src="js/profile_settings.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>