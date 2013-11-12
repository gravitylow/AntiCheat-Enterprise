$(function(){
    $('a[rel*=leanModal]').leanModal({top : 50, closeButton: ".modal-close"});
    $("#login-content").hide();
    $("#login").click(function(){
        $("#login-content").slideToggle();
    });
});