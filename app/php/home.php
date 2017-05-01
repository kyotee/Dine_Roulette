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
_END;

        include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/php/classes/user.php");

        $userSignedIn = new User($_SESSION['username']);
        $username = $_SESSION['username'];
  
        if(isset($_POST['comment1']) || isset($_POST['comment2']))
        {
            $para = $_POST['comment1'];
            $number = $_POST['comment2'];
            $date = $_POST['dateInviter'];

            $userSignedIn->comments($db,$para,$number,$date);       
            $userSignedIn->display($db);
        }
        else if(isset($_POST['noComments']))
        {
            $date = $_POST['dateInviter'];
            
            $userSignedIn->noComments($db,$date); 
            $userSignedIn->display($db);
        }
        else if(isset($_POST['rejectDate']))
        {
            $userSignedIn->rejection($db,$username);
            $userSignedIn->display($db);
        }
        else if (isset($_POST['Paypal']))
        {
            $userSignedIn->paid($db);
            $userSignedIn->display($db);
        }
        else if(isset($_POST['requested']))
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
        else if ($userSignedIn->reflect($username,$db) == true)
        {
            $userSignedIn->reflectForm($username,$db);   //checkout the reflection for the form
        }
        else
            $userSignedIn->display($db);

?>