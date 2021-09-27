var station1name;
var station2name;
var station3name;
var station4name;
var station5name;

var station1prefix;
var station2prefix;
var station3prefix;
var station4prefix;
var station5prefix;

var idx;
var number;
var station;

$(document).ready(function(){
    getSettings();
    halfSecTimer();
})

function halfSecTimer(){
    setTimeout(function(){
        halfSecTimer();
        getTimeDate();
    },500)
}

function getSettings(){
    $.ajax({
		type: "POST",
		url: "get-settings.php",
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

    var clientName;
    var logo;
    var color;
    lists.forEach(function(list){
        clientName = list.name;
        logo = list.logo;
        color = list.color;

        station1name = list.counter1name; 
        station2name = list.counter2name;
        station3name = list.counter3name;
        station4name = list.counter4name;
        station5name = list.counter5name;

        station1prefix = list.counter1prefix;
        station2prefix = list.counter2prefix;
        station3prefix = list.counter3prefix;
        station4prefix = list.counter4prefix;
        station5prefix = list.counter5prefix;
    })

    if(logo == ""){
        logo = "../../system/images/logo.png";
    }

    if(clientName == ""){
        clientName = "SkoolTech Solutions";
    }

    if(color == ""){
        color = "#000080";
    }

    $("#header").css("background-color", color);
    $("#station_label").css("color",color);
    $("#station_number").css("color",color);
    $("#footer").css("background-color", color);
    $("#date_time").css("color", color);

    getQueueNumber();
}

function getQueueNumber(){
    $.ajax({
		type: "POST",
		url: "get-queue-number.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderQueueNumber(resp[1]);
			}else if(resp[0] == "false"){
				window.open("http://localhost/queuematic/main/queuemaker","_self");
			} else{
				alert(response);
			}
		}
	});
}

function renderQueueNumber(data){
    var lists = JSON.parse(data);

    lists.forEach(function(list){
        idx = list.idx;
        number = list.number;
        station = list.station;
    })

    var prefix;
    var label;
    switch(station){
        case "1":
            prefix = station1prefix;
            label = station1name;
            break;
        case "2":
            prefix = station2prefix;
            label = station2name;
            break;
        case "3":
            prefix = station3prefix;
            label = station3name;
            break;
        case "4":
            prefix = station4prefix;
            label = station4name;
            break;
        case "5":
            prefix = station5prefix;
            label = station5name;
            break;
    }
    $("#station_label").text(label);
    $("#station_number").text(prefix + number);
}

function getTimeDate(){
    var today = new Date();
    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var date = months[today.getMonth()] + " " + today.getDate() + ", " + today.getFullYear();
    var hh = today.getHours();
    if(hh < 10){
        hh = "0" + hh;
    }
    var mm = today.getMinutes();
    if(mm < 10){
        mm = "0" + mm;
    }
    var ss = today.getSeconds();
    if(ss < 10){
        ss = "0" + ss;
    }
    var time = hh + ":" + mm + ":" + ss;

    $("#date_time").text(date + " " + time);
}

function cancelNumber(){
    if(confirm("Are you sure you want to cancel this queue number? This action cannot be undone...")){
        $.ajax({
            type: "POST",
            url: "delete-queue-number.php",
            dataType: 'html',
            data: {
                dummy:"dummy"
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    alert("Successfully cancelled your queue number.");
                    window.open("http://localhost/queuematic/main/queuemaker","_self");
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }
}