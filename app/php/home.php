<?php

echo <<<_END

        <button onclick="myFunction()">Logout</button>
        
        <script>
           function myFunction() {
                document.location.href = '/DineRoulette-tamkylet/index.php';
            }
        </script>
            
_END;

?>