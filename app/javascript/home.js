               $(".homeplace").hover(function(){
                $(this).css("background-color", "#E0FFFF");
                }, function(){
                $(this).css("background-color", "");
                });
                
                $(".placeholder").hover(
                    function()
                    {
                        $(this).css("-webkit-filter", "blur(0.25em)");
                    }, 
                    function()
                    {
                        $(this).css("-webkit-filter", "");
                    }); 
                
                $(".placeholder").hover(function(){
                $(".acdc").css("display", "inline-block");
                }, function(){
                $(".acdc").css("display", "none");
                });