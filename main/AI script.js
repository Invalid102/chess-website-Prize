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

    player_colour = "white";
    config = {
        player_colour: "white",
        engine: true
    };
    board_controller(config);
});
