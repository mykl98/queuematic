function getServerData(){
    $.ajax({
		type: "POST",
		url: "backend/dashboard/get-server-data.php",
		dataType: 'html',
		data: {
			dummy:"dummy"
		},
		success: function(response){
			var resp = response.split("*_*");
			if(resp[0] == "true"){
				renderServerData(resp[1]);
			}else if(resp[0] == "false"){
				alert(resp[1]);
			} else{
				alert(response);
			}
            setTimeout(function(){
                getServerData();
            },reCheckServerDelay)
		},
        failure: function(){
            setTimeout(function(){
                getServerData();
            },reCheckServerDelay)
        }
	});
}

function renderServerData(data){
    lists = JSON.parse(data);
    var queue;

    lists.forEach(function(list){
        currStation1Serving = list.station1serving;
        currStation2Serving = list.station2serving;
        currStation3Serving = list.station3serving;
        currStation4Serving = list.station4serving;
        currStation5Serving = list.station5serving;
        queue = list.queue;
    })

    updateSystem();
    renderQueue(queue);
}



function updateSystem(){
    var station;
    var number;
    if(prevStation1Serving != currStation1Serving && currStation1Serving != 0){
        prevStation1Serving = currStation1Serving;
        flashCount = 20;
        station = station1Name;
        number = station1Prefix + prevStation1Serving;
    }

    if(prevStation2Serving != currStation2Serving && currStation2Serving != 0){
        prevStation2Serving = currStation2Serving;
        flashCount = 20;
        station = station2Name;
        number = station2Prefix + prevStation2Serving;
    }

    if(prevStation3Serving != currStation3Serving && currStation3Serving != 0){
        prevStation3Serving = currStation3Serving;
        flashCount = 20;
        station = station3Name;
        number = station3Prefix + prevStation3Serving;
    }

    if(prevStation4Serving != currStation4Serving && currStation4Serving != 0){
        prevStation4Serving = currStation4Serving;
        flashCount = 20;
        station = station4Name;
        number = station4Prefix + prevStation4Serving;
    }

    if(prevStation5Serving != currStation5Serving && currStation5Serving != 0){
        prevStation5Serving = currStation5Serving;
        flashCount = 20;
        station = station5Name;
        number = station5Prefix + prevStation5Serving;
    }

    $("#now_serving_station").text(station);
    $("#now_serving_number").text(number);
}

function renderQueue(data){
    var station1count = 0;
    var station2count = 0;
    var station3count = 0;
    var station4count = 0;
    var station5count = 0;

    var lists = JSON.parse(data);
    var markUp = '<table id="dashboard-table" class="table table-striped table-bordered">\
                        <thead>\
                            <tr>\
                                <th>Queue Number</th>\
                                <th>Name</th>\
                                <th>Purpose</th>\
                                <th>Station</th>\
                                <th>Action</th>\
                            </tr>\
                        </thead>\
                        <tbody>';
    lists.forEach(function(list){
        var bgColor;
        var prefix;
        switch(list.station){
            case 1: 
                station1count += 1;
                bgColor = "theme";
                prefix = station1Prefix;
                break;
            case 2: 
                station2count += 1;
                bgColor = "success";
                prefix = station2Prefix;
                break;
            case 3: 
                station3count += 1;
                bgColor = "primary";
                prefix = station3Prefix;
                break;
            case 4: 
                station4count += 1;
                bgColor = "warning";
                prefix = station4Prefix;
                break;
            case 5: 
                station5count += 1;
                bgColor = "dark";
                prefix = station5Prefix;
                break;        
        }
        markUp +=  '<tr>\
                        <td>' + prefix + list.number +'</td>\
                        <td>' + list.name + '</td>\
                        <td>' + list.purpose + '</td>\
                        <td> <span class=badge badge-'+ bgColor +'>' + list.station + '</span> </td>\
                        <td>\
                            <button class="btn btn-danger" onclick="deleteQueue('+ list.idx +','+list.number+','+list.name+')"><i class="fas fa-trash"></i></button>\
                        </td>\
                    </tr>';
    })
    markUp += '</tbody></table';

    $("#dashboard-table-container").html(markUp);
    $("#dashboard-table").DataTable();

    $("#dashboard_station_1_queue").html(station1count + " Currently in Queue.")
    $("#dashboard_station_2_queue").html(station2count + " Currently in Queue.")
    $("#dashboard_station_3_queue").html(station3count + " Currently in Queue.")
    $("#dashboard_station_4_queue").html(station4count + " Currently in Queue.")
    $("#dashboard_station_5_queue").html(station5count + " Currently in Queue.")

    var total = station1count + station2count + station3count + station4count + station5count;
    $("#dashboard_now_serving_queue").html(total + " Currently in Queue.")
}

function deleteQueue(idx, number, name){
    if(confirm("Are you sure your want to delete " + name + "'s Queue with a queue number of " + number)){
        $.ajax({
            type: "POST",
            url: "backend/dashboard/get-server-data.php",
            dataType: 'html',
            data: {
                dummy:"dummy"
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    renderServerData(resp[1]);
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
                setTimeout(function(){
                    getServerData();
                },reCheckServerDelay)
            }
        });
    }
}