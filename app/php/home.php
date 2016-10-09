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

        <button onclick="myFunction()">Logout</button>
        
        <script>
           function myFunction() {
                document.location.href = '/DineRoulette-tamkylet/index.php';
            }
        </script>
            
_END;

?>