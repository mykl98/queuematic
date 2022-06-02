$(document).ready(function() {
    setTimeout(function(){
        $("#queue-manager-menu").attr("href","#");
        $("#queue-manager-menu").addClass("active");
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

getQueueList();
getUserDetails();

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

function getQueueList(){
    $.ajax({
		type: "POST",
		url: "get-queue-list.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderQueueList(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
		}
	});
}

function renderQueueList(data){
    var lists = JSON.parse(data);
    var markUp = '<table id="queue-table" class="table table-striped table-bordered table-sm">\
                        <thead>\
                            <tr>\
                                <th>Queue Number</th>\
                                <th>Date</th>\
                                <th>Time</th>\
                                <th>Name</th>\
                                <th>Purpose</th>\
                                <th>Station</th>\
                                <th>Status</th>\
                            </tr>\
                        </thead>\
                        <tbody>';
    lists.forEach(function(list){
        var status = list.status;
        if(status == "001"){
            status = '<span class="badge badge-warning">Waiting</span>';
        }else if(status == "002"){
            status = '<span class="badge badge-success">Called</span>';
        }else if(status == "003"){
            status = '<span class="badge badge-danger">Served</span>';
        }
        markUp += '<tr>\
                        <td>'+list.number+'</td>\
                        <td>'+list.date+'</td>\
                        <td>'+list.time+'</td>\
                        <td>'+list.name+'</td>\
                        <td>'+list.purpose+'</td>\
                        <td>'+list.station+'</td>\
                        <td>'+status+'</td>\
                   </tr>';
    })
    markUp += '</tbody></table>';
    $("#queue-table-container").html(markUp);
    $("#queue-table").DataTable();
}

count = 0;
function refresh(){
    count = 10;
    startCountdown();
    getQueueList();
    $("#refresh-button").attr("disabled", true);
}

function startCountdown(){
    if(count > 0){
        setTimeout(function(){
            $("#refresh-button").text("Refresh in " + count);
            startCountdown();
            count --;
        },1000)
    }else{
        $("#refresh-button").text("Refresh");
        $("#refresh-button").attr("disabled", false);
    }
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
                window.open("../../../index.php","_self")
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}