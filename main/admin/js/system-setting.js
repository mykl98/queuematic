var updateSystemSettingsFlag = false;

function updateSystemSettings(){
    if(updateSystemSettingsFlag == false){
        updateSystemSettingsFlag = true;
        getSystemSettings();
    }
}

function getSystemSettings(){
    $("#system-settings-client-logo").attr("src", logo);
    $("#system-settings-client-name").val(clientName);
    $("#system-settings-client-color").val(color);

    $("#system-settings-station-1-name").val(station1Name);
    $("#system-settings-station-2-name").val(station2Name);
    $("#system-settings-station-3-name").val(station3Name);
    $("#system-settings-station-4-name").val(station4Name);
    $("#system-settings-station-5-name").val(station5Name);

    $("#system-settings-station-1-prefix").val(station1Prefix);
    $("#system-settings-station-2-prefix").val(station2Prefix);
    $("#system-settings-station-3-prefix").val(station3Prefix);
    $("#system-settings-station-4-prefix").val(station4Prefix);
    $("#system-settings-station-5-prefix").val(station5Prefix);
}

function saveSettings(){
    logo = $('#system-settings-client-logo').attr('src');
    clientName = $("#system-settings-client-name").val();
    color = $("#system-settings-client-color").val();

    station1Name = $("#system-settings-station-1-name").val();
    station2Name = $("#system-settings-station-2-name").val();
    station3Name = $("#system-settings-station-3-name").val();
    station4Name = $("#system-settings-station-4-name").val();
    station5Name = $("#system-settings-station-5-name").val();

    station1Prefix = $("#system-settings-station-1-prefix").val();
    station2Prefix = $("#system-settings-station-2-prefix").val();
    station3Prefix = $("#system-settings-station-3-prefix").val();
    station4Prefix = $("#system-settings-station-4-prefix").val();
    station5Prefix = $("#system-settings-station-5-prefix").val();

    if(clientName  == "" || clientName == undefined){
        alert("Name field should not be empty")
    }else if(color == "" || color == undefined){
        alert("Color field should not be empty!");
    }else if(station1Name == "" || station1Name == undefined){
        alert("Station 1 Name field should not be empty!");
    }else if(station2Name == "" || station2Name == undefined){
        alert("Station 2 Name field should not be empty!");
    }else if(station3Name == "" || station3Name == undefined){
        alert("Station 3 Name field should not be empty!");
    }else if(station4Name == "" || station4Name == undefined){
        alert("Station 4 Name field should not be empty!");
    }else if(station5Name == "" || station5Name == undefined){
        alert("Station 5 Name field should not be empty!");
    }else if(station1Prefix == "" || station1Prefix == undefined){
        alert("Station 1 Prefix field should not be empty!");
    }else if(station2Prefix == "" || station2Prefix == undefined){
        alert("Station 2 Prefix field should not be empty!");
    }else if(station3Prefix == "" || station3Prefix == undefined){
        alert("Station 3 Prefix field should not be empty!");
    }else if(station4Prefix == "" || station4Prefix == undefined){
        alert("Station 4 Prefix field should not be empty!");
    }else if(station5Prefix == "" || station5Prefix == undefined){
        alert("Station 5 Prefix field should not be empty!");
    }else{
        $.ajax({
            type: "POST",
            url: "backend/system-setting/save-setting.php",
            dataType: 'html',
            data: {
                logo: logo,
                name: clientName,
                color: color,
                station1name: station1Name,
                station2name: station2Name,
                station3name: station3Name,
                station4name: station4Name,
                station5name: station5Name,
                station1prefix: station1Prefix,
                station2prefix: station2Prefix,
                station3prefix: station3Prefix,
                station4prefix: station4Prefix,
                station5prefix: station5Prefix
            },
            success: function(response){
                console.log(response);
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    alert(resp[1]);
                    updateGlobalSettings();
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }
}

var clientLogo;
var loadClientLogo = function(event){
	var reader = new FileReader();
	reader.onload = function(e) {
		$('#client-logo-editor-buffer').attr('src', e.target.result);

        if(clientLogo){
            clientLogo.destroy();
        }

		clientLogo = new Croppie($('#client-logo-editor-buffer')[0], {
			viewport: { width: 300, height: 300,type:'circle'},
			boundary: { width: 400, height: 400 },
            enableOrientation: true
		});

        $('#client-logo-editor-modal').modal('show');
		$('#client-logo-editor-ok-btn').on('click', function() {
			clientLogo.result('base64').then(function(dataImg) {
				var data = [{ image: dataImg }, { name: 'myimage.jpg' }];
				$('#system-settings-client-logo').attr('src', dataImg);
			});
		});
	}
	reader.readAsDataURL(event.target.files[0]);
}

function updateLogo(){
    var logo = $('#system-settings-client-logo').attr('src');
    $.ajax({
        type: "POST",
        url: "backend/system-setting/update-logo.php",
        dataType: 'html',
        data: {
            logo: logo
        },
        success: function(response){
            console.log(response);
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                alert(resp[1]);
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function clientLogoEditorCancel(){
	if(clientLogo){
		clientLogo.destroy();
    }
}

function clientLogoEditorRotate(){
	clientLogo.rotate(-90);
}