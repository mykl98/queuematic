var ip = "192.168.1.10";
var flashCount;
var flashFlag = false;

var reCheckServerDelay = 2000;

var logo;
var clientName;
var color;

var userImage;
var userName;
var userUsername;

var station1Name;
var station2Name;
var station3Name;
var station4Name;
var station5Name;

var station1Prefix;
var station2Prefix;
var station3Prefix;
var station4Prefix;
var station5Prefix;

var prevStation1Serving;
var prevStation2Serving;
var prevStation3Serving;
var prevStation4Serving;
var prevStation5Serving;

var currStation1Serving;
var currStation2Serving;
var currStation3Serving;
var currStation4Serving;
var currStation5Serving;

$(document).ready(function() {
    
    /*==============Page Loader=======================*/

    $(".loader-wrapper").fadeOut("slow");
    toggle_menu("dashboard");

    /*===============Page Loader=====================*/

    getSettings();
    getUserDetails();
    startHalfSec();
});

function getSettings(){
    $.ajax({
		type: "POST",
		url: "backend/dashboard/get-settings.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderSettings(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
            getServerData();
		},
        failure: function(){
            getServerData();
        }
	});
}

function renderSettings(data){
    var lists = JSON.parse(data);
    lists.forEach(function(list){
        logo = list.logo;
        clientName = list.name;
        color = list.color;

        station1Name = list.station1name;
        station2Name = list.station2name;
        station3Name = list.station3name;
        station4Name = list.station4name;
        station5Name = list.station5name;

        station1Prefix = list.station1prefix;
        station2Prefix = list.station2prefix;
        station3Prefix = list.station3prefix;
        station4Prefix = list.station4prefix;
        station5Prefix = list.station5prefix;

        ip = list.ip;

    })

    updateGlobalSettings();
}

function getUserDetails(){
    $.ajax({
        type: "POST",
        url: "backend/profile-settings/get-profile-settings.php",
        dataType: 'html',
        data: {
            dummy:"dummy"
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                renderUserDetails(resp[1]);
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function renderUserDetails(data){
    var lists = JSON.parse(data);

    lists.forEach(function(list){
        userImage = list.image;
        userName = list.name;
        userUsername = list.username;
    })

    if(userImage == ""){
        userImage = "../../system/images/blank-profile.png";
    }
}

function updateGlobalSettings(){
    if(logo == ""){
        logo = "../../system/images/logo.png";
    }

    if(clientName == ""){
        clientName = "SkoolTech Solutions";
    }

    if(color == ""){
        color = "#000080";
    }

    $("#global-client-logo").attr('src', logo);
    $("#global-client-name").text(clientName);
}

function updateGlobalProfileSettings(){
    $("#user-global-name").text(userName);
    $("#user-global-image").attr("src",userImage);
}

function startHalfSec(){
    setTimeout(function(){
        startHalfSec();
        flasher();
    },500)
}

function flasher(){
    if(flashCount > 0){
        flashCount -= 1;
        if(flashFlag == false){
            flashFlag = true;
            $("#now_serving").css("visibility", "hidden");
        }else{
            $("#now_serving").css("visibility", "visible");
            flashFlag = false;
        }
    }
}

/*========== Toggle Sidebar width ============ */
function toggle_sidebar() {
    $('#sidebar-toggle-btn').toggleClass('slide-in');
    $('.sidebar').toggleClass('shrink-sidebar');
    $('.content').toggleClass('expand-content');
    
    //Resize inline dashboard charts
    $('#incomeBar canvas').css("width","100%");
    $('#expensesBar canvas').css("width","100%");
    $('#profitBar canvas').css("width","100%");
}

/*==============Switch Menu==================*/
function toggle_menu(page) {
    $(".page").hide();
    switch (page){
        case "dashboard":
            $("#dashboard").show();
            break;
        case "manage_account":
            $("#manage_account").show();
            updateManageAccount();
            break;
        case "system_settings":
            $("#system_settings").show();
            updateSystemSettings();
            break;
        case "profile_settings":
            $("#profile_settings").show();
            updateProfileSettings();
            break;
    }
}

function logout(){
    $.ajax({
        type: "POST",
        url: "backend/logout.php",
        dataType: 'html',
        data: {
            dummy:"dummy"
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                window.open("../../index.php","_self")
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}
