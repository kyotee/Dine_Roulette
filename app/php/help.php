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
        
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/skeletontop.html");
    
    echo "This is the help page.";

    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/skeletonbottom.html");


?>