//redirect if user already logged in
$.post("authenticate.php", {}, function(data, status){
    if (data == "Login Success"){
        location.href = "AI.html";
    }
});

$(document).ready(function() {
    $("#main-form").submit(function(event){
        event.preventDefault();

        $("#main-form").each(function(){
            var inputs = $(this).find(':input'); //<-- Should return all input elements in that specific form.
            var inputs_dict = {}
            const length = inputs.length - 1;
            for (var i = 0; i < length; i++){
                inputs_dict[inputs[i].name] = inputs[i].value;
            }

            $.post("authenticate.php", inputs_dict, function(data, status){
                if (data == "Login Success"){
                    location.href = "AI.html";
                }
            });
        });
    });

});