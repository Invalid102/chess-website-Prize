//redirect if user already logged in
$.post("authenticate.php", {}, function(data, status){
    if (data == "Login Failure"){
        location.href = "index.html";
    }
});

$(document).ready(function() {
    $("#logout-button").click(function(event){
        $.post("authenticate.php", {"logout": true}, function(){
            location.href = "index.html";
        });
    });
    

    config = {
        player_colour: "black",
        engine: true,
        game_container: 'game-container',
        size: "600"
    };
    new_game = board_controller(config);

    $("#new-game").click(function(event){
        console.log("resetting the board");
        new_game();
    });

    
});
