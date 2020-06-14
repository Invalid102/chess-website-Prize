//redirect if user already logged in
$.post("authenticate.php", {}, function(data, status){
    if (data == "Login Failure"){
        location.href = "login.html";
    }
});

$(document).ready(function() {
    $("#logout-button").click(function(event){
        $.post("authenticate.php", {"logout": true}, function(){
            location.href = "index.html";
        });
    });
});
