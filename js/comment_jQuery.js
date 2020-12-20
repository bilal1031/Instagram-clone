
$("#sub").click(function(){
    $.post( $("#comment_form").attr("action"), $("#comment_form :input").serializeArray(), function(info){ $("#result").html(info); });
});

$("#comment_form").submit(function(){
    return false;
});