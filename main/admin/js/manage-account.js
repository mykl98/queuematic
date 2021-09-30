var updateManageAccountFlag = false;
var manageAccountIdx;

function updateManageAccount(){
    if(updateManageAccountFlag == false){
        updateManageAccountFlag = true;
        getAccountList();
        renderStationSelect();
    }
}

function getAccountList(){
    $.ajax({
		type: "POST",
		url: "backend/manage-account/get-account-list.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderAccountList(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
		}
	});
}

function renderAccountList(data){
    var lists = JSON.parse(data);
    var markUp = '<table id="manage-account-table" class="table table-striped table-bordered">\
                        <thead>\
                            <tr>\
                                <th>Image</th>\
                                <th>Name</th>\
                                <th>Access</th>\
                                <th>Status</th>\
                                <th>Action</th>\
                            </tr>\
                        </thead>\
                        <tbody>';
    lists.forEach(function(list){
        var image = list.image;
        if(image == ""){
            image = "../../system/images/blank-profile.png";
        }
        markUp += '<tr>\
                        <td>\
                            <img src="../../system/images/blank-profile.png" class="rounded-circle" width="40px" height="40px">\
                        </td>\
                        <td>'+list.name+'</td>\
                        <td>'+list.access+'</td>\
                        <td>'+list.status+'</td>\
                        <td>\
                            <button class="btn btn-theme" onclick="viewAccount('+ list.idx +','+list.name+')"><i class="fas fa-eye"></i></button>\
                            <button class="btn btn-success" onclick="editAccount('+ list.idx +','+list.name+')"><i class="fa fa-pencil"></i></button>\
                            <button class="btn btn-danger" onclick="deleteAccount('+ list.idx +','+list.name+')"><i class="fas fa-trash"></i></button>\
                        </td>\
                   </tr>';
    })
    markUp += '</tbody></table>';
    $("#manage-account-table-container").html(markUp);
    $("#manage-account-table").DataTable();
}

function renderStationSelect(){
    var markUp = '<div class="form-group" id="account-staion-container" style="display:none;">\
                        <label for="account-station" class="col-form-label">Station:</label>\
                        <select class="form-control" id="account-station">\
                            <option value="1">'+station1Name+'</option>\
                            <option value="2">'+station2Name+'</option>\
                            <option value="3">'+station3Name+'</option>\
                            <option value="4">'+station4Name+'</option>\
                            <option value="5">'+station5Name+'</option>\
                        </select>';
    $("#manage-account-station-list-container").html(markUp);
}

function accountAccessChanged(){
    var access = $("#account-access").val();
    if(access == "station"){
        $("#account-staion-container").show();
    }else{
        $("#account-staion-container").hide();
    }
}

function addAccount(){
    manageAccountIdx = "";
    $("#manage-account-add-edit-account-modal").modal("show");
}

function saveAccount(){
    var name = $("#account-name").val();
    var username = $("#account-username").val();
    var access = $("#account-access").val();
    var station = $("#account-station").val();
    var status = $("#account-status").val();

    if(access != "station"){
        station = "";
    }

    var error;
    if(name == "" || name == undefined){
        error = "*Name field should not be empty.";
    }else if(username == "" || username == undefined){
        error = "*Username field should not be empty.";
    }else{
        $("#manage-account-add-edit-account-modal").modal("hide");
        clearAddEditAccountModal();

        $.ajax({
            type: "POST",
            url: "backend/manage-account/save-account.php",
            dataType: 'html',
            data: {
                idx:manageAccountIdx,
                name:name,
                username:username,
                access:access,
                station:station,
                status:status
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    alert(resp[1]);
                    getAccountList();
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }

    $("#save-account-error").text(error);
}

function clearAddEditAccountModal(){
    $("#account-image").attr("src","../../system/images/blank-profile.png");
    $("#account-name").val("");
    $("#account-username").val("");
    $("#account-access").val("admin");
    $("#account-station").val("1");
    $("#account-status").val("active");
    $(".form-control").attr("disabled",false);
    $("#account-staion-container").hide();
    $("#add-edit-account-modal-save-button").show();
    accountAccessChanged();
}

function viewAccount(idx,name){
    $.ajax({
        type: "POST",
        url: "backend/manage-account/get-account-detail.php",
        dataType: 'html',
        data: {
            idx:idx
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                renderViewAccount(resp[1]);
                $("#manage-account-add-edit-account-modal-title").text("View " + name + "'s Account Details");
                $("#add-edit-account-modal-save-button").hide();
                $(".form-control").attr("disabled", true);
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function renderViewAccount(data){
    var lists = JSON.parse(data);
    var image;
    var name;
    var username;
    var access;
    var station;
    var status;
    lists.forEach(function(list){
       image = list.image;
       name = list.name;
       username = list.username;
       access = list.access;
       station = list.station;
       status = list.status;
    })

    if(image == ""){
        image = "../../system/images/blank-profile.png";
    }

    $("#account-image").attr("src",image);
    $("#account-name").val(name);
    $("#account-username").val(username);
    $("#account-access").val(access);
    $("#account-status").val(status);

    accountAccessChanged();
    
    $("#manage-account-add-edit-account-modal").modal("show");
}

function editAccount(idx,name){
    manageAccountIdx = idx;
    $.ajax({
        type: "POST",
        url: "backend/manage-account/get-account-detail.php",
        dataType: 'html',
        data: {
            idx:idx
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                renderViewAccount(resp[1]);
                $("#manage-account-add-edit-account-modal-title").text("Edit " + name + "'s Account Details");
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function deleteAccount(idx,name){
    if(confirm("Are you sure you want to delete " + name + "'s Account?\n\n This Action cannot be undone!")){
        $.ajax({
            type: "POST",
            url: "backend/manage-account/delete-account.php",
            dataType: 'html',
            data: {
                idx:idx,
                name:name
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    alert(resp[1]);
                    getAccountList();
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }
}