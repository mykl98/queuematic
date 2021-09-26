var flashFlag = "false";
var flashCount = 0;

var prevCounter1Serving = 0;
var prevCounter2Serving = 0;
var prevCounter3Serving = 0;
var prevCounter4Serving = 0;
var prevCounter5Serving = 0;

var reCheckServerDelay = 2000;

var update;
var clientName;
var logo;
var color;
var counter1name;
var counter2name;
var counter3name;
var counter4name;
var counter5name;
var currCounter1Serving;
var currCounter2Serving;
var currCounter3Serving;
var currCounter4Serving;
var currCounter5Serving;

var baseLink = "http://192.168.1.3/quematic/main/queuemaker/index.php?token=";
var tokenExpireCount = 0;

$(document).ready(function(){
    getSettings();
    runOneSecInterval();
    generateQRCode(generateRandomId(100));
})
            
function generateQRCode() {
    tokenExpireCount = 20;
    $.ajax({
		type: "POST",
		url: "generate-token.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				var text = baseLink + resp[1];
                console.log(text);
                (function() {
                    qr = new QRious({
                        element: document.getElementById('qr_code'),
                        size: 150,
                        value: text
                    });
                })();
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
		}
	});
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
        update = list.update;
        clientName = list.name;
        logo = list.logo;
        color = list.color;
        counter1name = list.counter1name;
        counter2name = list.counter2name;
        counter3name = list.counter3name;
        counter4name = list.counter4name;
        counter5name = list.counter5name;
    })
    if(clientName == ""){
        clientName = "SkoolTech Solutions"
    }
    if(logo == ""){
        logo = "../../system/images/logo.png";
    }
    $("#name").text(clientName);
    $("#logo").attr('src', logo);
    $("body").css('background-color', color);
    $(".station_tag").css('color', color);
    $(".station_number").css('color', color);
    $(".tag_number").css('color', color);

    $("#station_1_tag").text(counter1name);
    $("#station_2_tag").text(counter2name);
    $("#station_3_tag").text(counter3name);
    $("#station_4_tag").text(counter4name);
    $("#station_5_tag").text(counter5name);

    setTimeout(function(){
        getDataFromServer();
    });
}

function updateMachine(){
    if(prevCounter1Serving != currCounter1Serving){
        prevCounter1Serving = currCounter1Serving;
        $("#station_1_number").text(prevCounter1Serving);
        $("#now_serving_number").text(prevCounter1Serving);
        $("#now_serving_counter").text(counter1name);
        flashCount = 10;
        var textToSay = "Attention... Client with. queue number. " + prevCounter1Serving + ". Please proceed to. " + counter1name;
        speak(textToSay);
        speak(textToSay);
        speak(textToSay);
    }
    if(prevCounter2Serving != currCounter2Serving){
        prevCounter2Serving = currCounter2Serving;
        $("#station_2_number").text(prevCounter2Serving);
        $("#now_serving_number").text(prevCounter2Serving);
        $("#now_serving_counter").text(counter2name);
        flashCount = 10;
        var textToSay = "Attention... Client with. queue number. " + prevCounter2Serving + ". Please proceed to. " + counter2name;
        speak(textToSay);
        speak(textToSay);
        speak(textToSay);
    }
    if(prevCounter3Serving != currCounter3Serving){
        prevCounter3Serving = currCounter3Serving;
        $("#station_1_number").text(prevCounter3Serving);
        $("#now_serving_number").text(prevCounter3Serving);
        $("#now_serving_counter").text(counter3name);
        flashCount = 10;
        var textToSay = "Attention... Client with. queue number. " + prevCounter3Serving + ". Please proceed to. " + counter3name;
        speak(textToSay);
        speak(textToSay);
        speak(textToSay);
    }
    if(prevCounter4Serving != currCounter4Serving){
        prevCounter4Serving = currCounter4Serving;
        $("#station_1_number").text(prevCounter4Serving);
        $("#now_serving_number").text(prevCounter4Serving);
        $("#now_serving_counter").text(counter4name);
        flashCount = 10;
        var textToSay = "Attention... Client with. queue number. " + prevCounter4Serving + ". Please proceed to. " + counter4name;
        speak(textToSay);
        speak(textToSay);
        speak(textToSay);
    }
    if(prevCounter5Serving != currCounter5Serving){
        prevCounter5Serving = currCounter5Serving;
        $("#station_1_number").text(prevCounter5Serving);
        $("#now_serving_number").text(prevCounter5Serving);
        $("#now_serving_counter").text(counter5name);
        flashCount = 10;
        var textToSay = "Attention... Client with. queue number. " + prevCounter5Serving + ". Please proceed to. " + counter5name;
        speak(textToSay);
        speak(textToSay);
        speak(textToSay);
    }
}

function speak(msg){
    let speech = new SpeechSynthesisUtterance();

    speech.lang = "en-US";
    speech.text = msg;
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;                

    window.speechSynthesis.speak(speech);
}

function runOneSecInterval(){
    setTimeout(function(){
        runOneSecInterval();
        
        getTimeDate();
        flashNowServing();
        if(tokenExpireCount > 0){
            tokenExpireCount -= 1;
        }else{
            generateQRCode();
        }
    },500);
}

function flashNowServing(){
    if(flashCount > 0){
        flashCount -= 1;
        if(flashFlag == "false"){
            flashFlag = "true";
            $("#now_serving_container").css('visibility','hidden');
        }else{
            flashFlag = "false";
            $("#now_serving_container").css('visibility','visible');
        }
    }
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

    $("#date").text(date);
    $("#time").text(time);
}

function getDataFromServer(){
    $.ajax({
		type: "POST",
		url: "get-data.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderDataFromServer(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
            setTimeout(function(){
                getDataFromServer();
            },reCheckServerDelay)
		}
	});
}

function renderDataFromServer(data){
    var lists = JSON.parse(data);
    lists.forEach(function(list){
        update = list.update;
        currCounter1Serving = list.counter1serving;
        currCounter2Serving = list.counter2serving;
        currCounter3Serving = list.counter3serving;
        currCounter4Serving = list.counter4serving;
        currCounter5Serving = list.counter5serving;
    })

    if(update == 'true'){
        updateMachine();
    }
}