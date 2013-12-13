$(function(){
    $('a[rel*=leanModal]').leanModal({top : 50, closeButton: ".modal-close"});

    $(".alert").hide();

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
    $("a[href='#modal-userinfo']").on("click", function(){
        var user = $(this).text();
        $.post("ajax/modal-userinfo.php", {user: user}, function(data){
            $("#modal-userinfo").empty().append(data);
        })
    });
    $("#logout").click(function(){
        closeAlert();
        $.get("util/Logout.php", function(data){
            showAlert(data);
        });
    });
});

function showAlert(data){
    $("#alert-text").empty().append(data);
    $(".alert").slideDown();
    $("#topcontent").animate({
        'padding-top': 40,
        'margin-bottom': -40,
    });
}
function closeAlert(){
    $(".alert").slideUp();
    $("#topcontent").animate({
        'padding-top': 0,
        'margin-bottom': 0,
    });
}