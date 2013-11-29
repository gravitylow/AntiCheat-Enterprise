$(function(){
    $('a[rel*=leanModal]').leanModal({top : 50, closeButton: ".modal-close"});
    $("#login-content").hide();
    $("#login").click(function(){
        $("#login-content").slideToggle();
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