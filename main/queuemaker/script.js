var ip = "192.168.1.10";
var reCheckServerDelay = 2000;
var flash1Count = 0;
var flash2Count = 0;
var flash3Count = 0;
var flash4Count = 0;
var flash5Count = 0;
var station1FlashFlag = false;
var station2FlashFlag = false;
var station3FlashFlag = false;
var station4FlashFlag = false;
var station5FlashFlag = false;

var prevCounter1Serving;
var prevCounter2Serving;
var prevCounter3Serving;
var prevCounter4Serving;
var prevCounter5Serving;

var currCounter1Serving;
var currCounter2Serving;
var currCounter3Serving;
var currCounter4Serving;
var currCounter5Serving;

var update;
var clientName;
var logo;
var color;
var counter1name;
var counter2name;
var counter3name;
var counter4name;
var counter5name;

var counter1prefix;
var counter2prefix;
var counter3prefix;
var counter4prefix;
var counter5prefix;

var station;

$(document).ready(function(){
    getSettings();
    halfSecTimer();
})

function halfSecTimer(){
    setTimeout(function(){
        halfSecTimer();
        flasher();
    },500)
}

function getServerUpdate(){
    $.ajax({
		type: "POST",
		url: "get-server-update.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderServerUpdate(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
            setTimeout(function(){
                getServerUpdate();
            },reCheckServerDelay)
		},
        failure: function(){
            setTimeout(function(){
                getServerUpdate();
            },reCheckServerDelay)
        }
	});
}

function renderServerUpdate(data){
    var lists = JSON.parse(data);
    lists.forEach(function(list){
        currCounter1Serving = list.counter1serving;
        currCounter2Serving = list.counter2serving;
        currCounter3Serving = list.counter3serving;
        currCounter4Serving = list.counter4serving;
        currCounter5Serving = list.counter5serving;
    })
    updateSystem();
}

function updateSystem(){
    if(prevCounter1Serving != currCounter1Serving && currCounter1Serving != 0){
        prevCounter1Serving = currCounter1Serving;
        $("#station_1_number").text(counter1prefix + prevCounter1Serving);
        flash1Count = 20;
    }

    if(prevCounter2Serving != currCounter2Serving && currCounter2Serving != 0){
        prevCounter2Serving = currCounter2Serving;
        $("#station_2_number").text(counter2prefix + prevCounter2Serving);
        flash2Count = 20;
    }

    if(prevCounter3Serving != currCounter3Serving && currCounter3Serving != 0){
        prevCounter3Serving = currCounter3Serving;
        $("#station_3_number").text(counter3prefix + prevCounter3Serving);
        flash3Count = 20;
    }

    if(prevCounter4Serving != currCounter4Serving && currCounter4Serving != 0){
        prevCounter4Serving = currCounter4Serving;
        $("#station_4_number").text(counter4prefix + prevCounter4Serving);
        flash4Count = 20;
    }

    if(prevCounter5Serving != currCounter5Serving && currCounter5Serving != 0){
        prevCounter5Serving = currCounter5Serving;
        $("#station_5_number").text(counter5prefix + prevCounter5Serving);
        flash5Count = 20;
    }
}

function flasher(){
    if(flash1Count > 0){
        flash1Count -= 1;
        if(station1FlashFlag == false){
            station1FlashFlag = true;
            $("#station_1").css("visibility", "hidden");
        }else{
            station1FlashFlag = false;
            $("#station_1").css("visibility", "visible");
        }
    }
    if(flash2Count > 0){
        flash2Count -= 1;
        if(station2FlashFlag == false){
            station2FlashFlag = true;
            $("#station_2").css("visibility", "hidden");
        }else{
            station2FlashFlag = false;
            $("#station_2").css("visibility", "visible");
        }
    }
    if(flash3Count > 0){
        flash3Count -= 1;
        if(station3FlashFlag == false){
            station3FlashFlag = true;
            $("#station_3").css("visibility", "hidden");
        }else{
            station3FlashFlag = false;
            $("#station_3").css("visibility", "visible");
        }
    }
    if(flash4Count > 0){
        flash4Count -= 1;
        if(station4FlashFlag == false){
            station4FlashFlag = true;
            $("#station_4").css("visibility", "hidden");
        }else{
            station4FlashFlag = false;
            $("#station_4").css("visibility", "visible");
        }
    }
    if(flash5Count > 0){
        flash5Count -= 1;
        if(station5FlashFlag == false){
            station5FlashFlag = true;
            $("#station_5").css("visibility", "hidden");
        }else{
            station5FlashFlag = false;
            $("#station_5").css("visibility", "visible");
        }
    }
}

function getSettings(){
    $.ajax({
		type: "POST",
		url: "get-setting.php",
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
		}
	});
}

function renderSettings(data){
    var lists = JSON.parse(data);

    lists.forEach(function(list){
        clientName = list.name;
        logo = list.logo;
        counter1name = list.counter1name;
        counter2name = list.counter2name;
        counter3name = list.counter3name;
        counter4name = list.counter4name;
        counter5name = list.counter5name;

        counter1prefix = list.counter1prefix;
        counter2prefix = list.counter2prefix;
        counter3prefix = list.counter3prefix;
        counter4prefix = list.counter4prefix;
        counter5prefix = list.counter5prefix;
        color = list.color;

        ip = list.ip;
    })
    if(logo == ""){
        logo = "../../system/images/logo.png";
    }
    if(clientName == ""){
        clientName = "SkoolTech Solutions";
    }
    $("#logo").attr("src",logo);
    $("#name").text(clientName);
    $("#station_1_label").text(counter1name);
    $("#station_2_label").text(counter2name);
    $("#station_3_label").text(counter3name);
    $("#station_4_label").text(counter4name);
    $("#station_5_label").text(counter5name);

    $(".station").css("border", "2px solid " + color);
    $(".station_label").css("background-color", color);
    $(".station_number").css("color",color);
    $("#modal_1_submit_button").css("background-color", color);
    $("#modal_1_header_text").css("color", color);

    getServerUpdate();
}

function showModal(stationNumber){
    var text;
    station = stationNumber;
    switch(stationNumber){
        case "1":
            text = counter1name;
            break;
        case "2":
            text = counter2name;
            break;
        case "3":
            text = counter3name;
            break;
        case "4":
            text = counter4name;
            break;
        case "5":
            text = counter5name;
            break;
    }
    $("#add-queue-modal-header").text("Add queue to " + text);
    $("#add-queue-modal").modal("show");
}

function addQueue(){
    var name = $("#add-queue-modal-client_name").val();
    var purpose = $("#add-queue-modal-client-purpose").val();
    if(name == "" || name == undefined){
        $("#add-queue-error").text("*Name field should not be empty.")
    }else if(purpose == "" || purpose == undefined){
        $("#add-queue-error").text("*Purpose field should not be empty.");
    }else{
        $("#add-queue-error").text("");
        $("#add-queue-modal").modal("hide");

        $.ajax({
            type: "POST",
            url: "set-appointment.php",
            dataType: 'html',
            data: {
                station:station,
                name: name,
                purpose: purpose
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    var idx = resp[1];
                    var link = "http://" + ip + "/queuematic/main/que-number/index.php";
                    //alert(link);
                    window.open(link,"_self")
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }
}