$(function(){
    $(".alert").each(function(){
        var show = $(this).data("show");
        if(show == undefined || show.length == 0)
            $(this).hide();
    });

    $("#loginform").submit(function(e){
        e.preventDefault();
        closeAlert();

        var input = $("#loginform :input").serializeArray();

        $.post("util/Login.php", input, function(data){
            showAlert(data);
        });
    });

    $("#close-alert").click(function(){
        closeAlert();
    });

    $("a[href='#colorblind']").click(function(){
        var cur = $('#stylesheet').attr("href");
        if(cur == "css/red.css") {
            $('#stylesheet').attr("href", "css/colorblind.css");
        } else {
            $('#stylesheet').attr("href", "css/red.css");
        }
    });

    $("#logout").click(function(){
        closeAlert();
        $.get("util/Logout.php", function(data){
            showAlert(data);
        });
    });

    $("#addgroup").click(function(){
        if($("#new").length == 0){
            $.get("ajax/newgroup.php", function(data){
                $("#groupform").append(data);

                $("a[href='#removenewgroup']").click(function(){
                    if(confirm("Are you sure you want to delete this group? This can't be undone!")){
                        $.post("util/RemoveGroup.php", {id:"new"}, function(data){
                            $("#new").remove();
                            showAlert(data);
                        });
                    }
                });

                $("a[href='#savenewgroup']").click(function(){
                    var input = $("#new :input").serialize();
                    $.post("util/SaveGroup.php", input, function(data){
                        showAlert(data);
                        window.location.reload();
                    });
                });
            });
        }else{
            showAlert("You must save the current new group before adding another one");
        }
    });
    $("a[href='#removegroup']").click(function(){
        if(confirm("Are you sure you want to delete this group? This can't be undone!")){
            var id = $(this).data("id");
            $.post("util/RemoveGroup.php", {id:id}, function(data){
                $("#"+id).remove();
                showAlert(data);
            });
        }
    });
    $("a[href='#savegroup']").click(function(){
        var id = $(this).data("id");
        var input = $("#"+id+" :input").serialize();
        $.post("util/SaveGroup.php", input, function(data){
            showAlert(data);
        });
    });

    $("#addrule").click(function(){
        if($("#new").length == 0){
            $.get("ajax/newrule.php", function(data){
                $("#ruleform").append(data);

                $("a[href='#removenewrule']").click(function(){
                    if(confirm("Are you sure you want to delete this rule? This can't be undone!")){
                        $.post("util/RemoveRule.php", {id:"new"}, function(data){
                            $("#new").remove();
                            showAlert(data);
                        });
                    }
                });

                $("a[href='#savenewrule']").click(function(){
                    var input = $("#new :input").serialize();
                    $.post("util/SaveRule.php", input, function(data){
                        showAlert(data);
                        window.location.reload();
                    });
                });
            });
        }else{
            showAlert("You must save the current new rule before adding another one");
        }
    });
    $("a[href='#removerule']").click(function(){
        if(confirm("Are you sure you want to delete this rule? This can't be undone!")){
            var id = $(this).data("id");
            $.post("util/RemoveRule.php", {id:id}, function(data){
                $("#"+id).remove();
                showAlert(data);
            });
        }
    });
    $("a[href='#saverule']").click(function(){
        var id = $(this).data("id");
        var input = $("#"+id+" :input").serialize();
        $.post("util/SaveRule.php", input, function(data){
            showAlert(data);
        });
    });

    $("#main-body").ready(function(){
        var user = getUrlVar('user');
        $.get("ajax/table.php?user="+user, function(data){
            $("#main-body").empty().append(data).queue(function(){
                $("#main-table").dynatable().queue(function(){
                    $(this).dequeue();
                });
                $("#dynatable-query-search-main-table").addClass("form-control");
                $("#dynatable-per-page-main-table").addClass("form-control");
                $(this).dequeue();
            });
        });
    });

    $("#clearlogs").click(function(){
        if(confirm("Are you sure you want to clear the logs? This cannot be undone!")){
            $.get("util/ClearLogs.php", function(){
                window.location.reload();
            })
        }
    });

    $("#editlevel-link").click(function(){
        $("#editlevel-form").fadeToggle();
    });
    $("#editlevel-form").submit(function(e){
        e.preventDefault();
        var data = $("#editlevel-form :input").serialize();
        $.post("util/ChangeLevel.php", data, function(data){
            showAlert(data);
            window.location.reload();
        });
    });

    $("#changepassword").submit(function(e){
        e.preventDefault();
        var data = $("#changepassword").serialize();
        $.post("util/ChangePassword.php", data, function(data){
            showAlert(data);
        });
    });

    $("#adduser").click(function(){
        $("#newuser-form").fadeToggle();
    });
    $("a[href='#edituser']").click(function(){
        var id = $(this).data("id");
        $.getJSON("ajax/user.php?id="+id, function(data){
            $.each(data, function(key, val){
                $('input[name="'+val.field+'"]').val(val.value);
                if(val.field === "privilege"){
                    $("#privilege option[value=" + val.value +"]").attr('selected', 'selected');
                    if(val.value === "superadmin"){
                        console.log('disabling');
                        $("#privilege option[value=admin]").attr('disabled','disabled');
                        $("#privilege option[value=user]").attr('disabled','disabled');
                    } else {
                        console.log('enabling');
                        $("#privilege option[value=admin]").removeAttr('disabled');
                        $("#privilege option[value=user]").removeAttr('disabled');
                    }
                }
            });
        });
        $("#edituser-form").fadeToggle();
    });
    $("a[href='#removeuser']").click(function(){
        if(confirm("Are you sure you want to delete this user? This can't be undone!")){
            var id = $(this).data("id");
            $.post("util/RemoveUser.php", {id:id}, function(data){
                showAlert(data);
                window.location.reload();
            });
        }
    });
    $("#edituser-form").submit(function(e){
        e.preventDefault();
        var data = $("#edituser-form :input").serialize();
        $.post("util/ChangeUser.php", data, function(data){
            showAlert(data);
            if(data.indexOf("successfully") != -1) {
                window.location.reload();
            }
        });
    });
    $("#newuser-form").submit(function(e){
        e.preventDefault();
        var data = $("#newuser-form :input").serialize();
        $.post("util/AddUser.php", data, function(data){
            showAlert(data);
            if(data.indexOf("successfully") != -1) {
                window.location.reload();
            }
        });
    });
});

function getUrlVar(key){
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
    return result && unescape(result[1]) || "";
}

function showAlert(data){
    $("#alert-text").empty().append(data);
    $(".alert").slideDown();
    $("#topcontent").animate({
        'padding-top': 40,
        'margin-bottom': -40
    });
}
function closeAlert(){
    $(".alert").slideUp();
    $("#topcontent").animate({
        'padding-top': 0,
        'margin-bottom': 0
    });
}
