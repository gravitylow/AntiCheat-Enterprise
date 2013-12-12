$(function(){
    $('a[rel*=leanModal]').leanModal({top : 50, closeButton: ".modal-close"});
    $("#login-alert").hide();

    $("#loginform").submit(function(e){
        e.preventDefault();
        $("#login-alert").slideUp();

        var input = $("#loginform :input").serializeArray();

        $.post("util/Login.php", input, function(data){
            $("#login-alert").empty().append(data).slideDown();
        });
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
});