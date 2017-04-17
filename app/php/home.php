<?php

        require_once 'home.php';
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
    
    echo <<<_END
    
       <body>
     
            <div class="inbordermid">
            
                <div class="inbordermidPAD">
                    <br/>
                    <p class="titles">Member List</p>
                    </br>
_END;

        include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/php/classes/user.php");

        $userSignedIn = new User($_SESSION['username']);
        $username = $_SESSION['username'];
  
        if(isset($_POST['requested']))
        {
            $userRequested = $_POST['requested'];
            
            echo '<script type="text/javascript">alert("Successfully sent request to: '.$userRequested.'");</script>';  
            $userSignedIn->requested($userRequested,$db);
            $userSignedIn->display($db);
        }  
        else if($userSignedIn->invitation($username,$db) == true)
        {
            echo '<script>alert("Someone sent you a request!");</script>';
            $userSignedIn->matched();   
        }
        else
            $userSignedIn->display($db);

?>