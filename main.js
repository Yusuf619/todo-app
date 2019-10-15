$(document).ready(function(){
    $("p").on({
        click: function(){
        $(this).css({"text-decoration": "line-through"});
        }
    });    
});