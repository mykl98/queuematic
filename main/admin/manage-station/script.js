$(document).ready(function() {
    setTimeout(function(){
        $("#manage-station-menu").attr("href","#");
        $("#manage-station-menu").addClass("active");
    },100)
})

$(document).on('shown.lte.pushmenu', function(){
    $("#global-department-name").show();
    $("#global-client-logo").attr("width","100px");
})

$(document).on('collapsed.lte.pushmenu', function(){
    $("#global-department-name").hide();
    $("#global-client-logo").attr("width","40px");
})

$(".modal").on("hidden.bs.modal",function(){
    $(this).find("form").trigger("reset");
})

$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal.show').length && $(document.body).addClass('modal-open');
});

getStationList();
getUserDetails();
var stationIdx;

function getUserDetails(){
    $.ajax({
        type: "POST",
        url: "get-profile-settings.php",
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
        if(list.image != ""){
            $("#global-user-image").attr("src", list.image);
        }
        $("#global-user-name").text(list.name);
    })

}

function getStationList(){
    $.ajax({
		type: "POST",
		url: "get-station-list.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderStationList(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
		}
	});
}

function renderStationList(data){
    var lists = JSON.parse(data);
    var markUp = '<table id="station-table" class="table table-striped table-bordered table-sm">\
                        <thead>\
                            <tr>\
                                <th>Name</th>\
                                <th>Prefix</th>\
                                <th>Status</th>\
                                <th style="max-width:50px;min-width:50px;"></th>\
                            </tr>\
                        </thead>\
                        <tbody>';
    lists.forEach(function(list){
        var status = list.status;
        if(status == "active"){
            status = '<span class="badge badge-success">Active</span>';
        }else if(status == "inactive"){
            status = '<span class="badge badge-danger">Inactive</span>';
        }
        markUp += '<tr>\
                        <td>'+list.name+'</td>\
                        <td>'+list.prefix+'</td>\
                        <td>'+status+'</td>\
                        <td>\
                            <button class="btn btn-success btn-sm" onclick="editStation(\''+ list.idx +'\')"><i class="fa fa-pencil"></i></button>\
                            <button class="btn btn-danger btn-sm" onclick="deleteStation(\''+ list.idx +'\')"><i class="fas fa-trash"></i></button>\
                        </td>\
                   </tr>';
    })
    markUp += '</tbody></table>';
    $("#station-table-container").html(markUp);
    $("#station-table").DataTable();
}

function addStation(){
    stationIdx = "";
    $("#add-edit-station-modal").modal("show");
    $("#add-edit-violation-modal-title").text("Add New Station");
    $("#add-edit-violation-modal-error").text("");
}

function saveStation(){
    var image = $("#station-image").attr("src");
    var name = $("#station-name").val();
    var prefix = $("#station-prefix").val();
    var status = $("#station-status").val();
    var error = "";

    if(name == "" || name == undefined){
        error = "*Name field should not be empty!";
    }else if(prefix == "" || prefix == undefined){
        error = "*Prefix field should not be empty!";
    }else{
        $.ajax({
            type: "POST",
            url: "save-station.php",
            dataType: 'html',
            data: {
                idx:stationIdx,
                image:image,
                name:name,
                prefix:prefix,
                status:status
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    $("#add-edit-station-modal").modal("hide");
                    getStationList();
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }

    $("#add-edit-station-modal-error").text(error);
}

function editStation(idx){
    stationIdx = idx;
    $.ajax({
        type: "POST",
        url: "get-station-detail.php",
        dataType: 'html',
        data: {
            idx:stationIdx
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                renderEditStation(resp[1]);
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function renderEditStation(data){
    var lists = JSON.parse(data);
    lists.forEach(function(list){
        if(list.image != ""){
            $("#station-image").attr("src",list.image);
        }
        $("#station-name").val(list.name);
        $("#station-prefix").val(list.prefix);
        $("#station-status").val(list.status);
    })
    $("#add-edit-station-modal-title").text("Edit Station Details");
    $("#add-edit-station-modal-error").text("");
    $("#add-edit-station-modal").modal("show");
}

function deleteStation(idx){
    if(confirm("Are you sure you want to delete this Station?\nThis Action cannot be undone!")){
        $.ajax({
            type: "POST",
            url: "delete-station.php",
            dataType: 'html',
            data: {
                idx:idx
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    getStationList();
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
    }
}

var profileImage;
var loadProfileImage= function(event){
	var reader = new FileReader();
	reader.onload = function(e) {
		$('#profile-image-editor-buffer').attr('src', e.target.result);

        if(profileImage){
            profileImage.destroy();
        }

		profileImage = new Croppie($('#profile-image-editor-buffer')[0], {
			viewport: { width: 300, height: 300,type:'square'},
			boundary: { width: 400, height: 400 },
            enableOrientation: true
		});

        $('#profile-image-editor-modal').modal('show');
		$('#profile-image-editor-ok-btn').on('click', function() {
			profileImage.result('base64').then(function(dataImg) {
				var data = [{ image: dataImg }, { name: 'myimage.jpg' }];
				$('#station-image').attr('src', dataImg);
			});
		});
	}
	reader.readAsDataURL(event.target.files[0]);
}

function profileImageEditorCancel(){
	if(profileImage){
		profileImage.destroy();
    }
}

function profileImageEditorRotate(){
	profileImage.rotate(-90);
}

function logout(){
    $.ajax({
        type: "POST",
        url: "logout.php",
        dataType: 'html',
        data: {
            dummy:"dummy"
        },
        success: function(response){
            var resp = response.split("*_*");
            if(resp[0] == "true"){
                window.open(baseUrl + "/index.php","_self")
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}