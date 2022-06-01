$(document).ready(function(){
    setTimeout(function(){
        $("#system-reset-menu").attr("href","#");
        $("#system-reset-menu").addClass("active");
    },100)
})

getProfileSettings();

$(document).on('shown.lte.pushmenu', function(){
    $("#global-department-name").show();
    $("#global-client-logo").attr("width","100px");
})

$(document).on('collapsed.lte.pushmenu', function(){
    $("#global-department-name").hide();
    $("#global-client-logo").attr("width","40px");
})

function getProfileSettings(){
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
                renderProfileSettings(resp[1]);
            }else if(resp[0] == "false"){
                alert(resp[1]);
            } else{
                alert(response);
            }
        }
    });
}

function renderProfileSettings(data){
    var lists = JSON.parse(data);
    lists.forEach(function(list){
        if(list.image != ""){
            $("#profile-settings-picture").attr("src", list.image);
            $("#global-user-image").attr("src", list.image);
        }
        $("#profile-settings-name").val(list.name);
        $("#profile-settings-username").val(list.username);
        $("#global-user-name").text(list.name);
    })
}

function queueReset(){
    if(confirm("Are you sure you want to reset the queue database and counters?\nThis action cannot be undone!")){
        $.ajax({
            type: "POST",
            url: "reset-queue.php",
            dataType: 'html',
            data: {
                dummy:"dummy"
            },
            success: function(response){
                var resp = response.split("*_*");
                if(resp[0] == "true"){
                    alert("Successfully reset queue database and counters!");
                }else if(resp[0] == "false"){
                    alert(resp[1]);
                } else{
                    alert(response);
                }
            }
        });
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