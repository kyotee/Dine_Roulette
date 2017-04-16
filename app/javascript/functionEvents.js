$(".msg").mouseover(function() { $(this).css("color", "#bbffff"); } )
$(".signout").mouseover(function() { $(this).css("color", "#bbffff"); } )
$(".home").mouseover(function() { $(this).css("color", "#bbffff"); } )
$(".profile").mouseover(function() { $(this).css("color", "#bbffff"); } )
$(".help").mouseover(function() {$ (this).css("color", "#bbffff"); } )

$(".msg").mouseout(function() { $(this).css("color", "white"); } )
$(".signout").mouseout(function() { $(this).css("color", "white"); } )
$(".home").mouseout(function() { $(this).css("color", "white"); } )
$(".profile").mouseout(function() { $(this).css("color", "white"); } )
$(".help").mouseout(function() {$ (this).css("color", "white"); } )


// AJAX calls
$(document).ready(function(){
    $(".profile").click(function(){
        $.ajax({url: "/DineRoulette-tamkylet/app/php/profile.php", success: function(result){
            $("#AJAX").html(result);
        }});
    });
});

$(document).ready(function(){
    $(".help").click(function(){
        $.ajax({url: "/DineRoulette-tamkylet/app/php/help.php", success: function(result){
            $("#AJAX").html(result);
        }});
    });
});
