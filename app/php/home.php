<?php

        session_start();
        if ($_SESSION['userID'] != 1)
        {
                
                echo <<<_MSG
                <script>
                    document.location.href = '/DineRoulette-tamkylet/index.php';
                </script>
_MSG;
        }
        else
        {}
        

echo <<<_END
 
         <!DOCTYPE html>
        <html>
            <head>
                <title>DineRoulette</title>
                <link href="/DineRoulette-tamkylet/app/css/loggedin.css" rel="stylesheet" type="text/css"/>
            </head>
            
            <body>
                
                    <div class="inborder">
                        <a class="msg" href="/DineRoulette-tamkylet/app/php/home.php">DineRoulette</a>
                        <a class="signout" href="/DineRoulette-tamkylet/index.php">Signout</a>
                        <a class="profile" href="/DineRoulette-tamkylet/app/php/profile.php">Profile</a>
                        <a class="help" href="/DineRoulette-tamkylet/app/php/help.php">Help</a>
                    </div>
                    
                    
    
                    
                    <div class="inborderbottom">
                    </div>
            
                    
        
            </body>
        </html>
 

_END;

?>