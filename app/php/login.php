<?php

    require_once 'login.php';
 
    //credentials for localserver
    $servername = getenv('IP');
    $username = "tamkylet";
    $password = "password";
    $database = "dine";
    $dbport = 3306;
    
    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 

    //--------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $checkusername = $_POST['username'];
        $checkpassword = $_POST['password'];
        
        $query2 = "SELECT * 
                   FROM user
                   WHERE username = '".$checkusername."'";
                   
        $result2 = $db->query($query2);   
        if (!$result2) die($db->error);          
        
        $rows2 = $result2->num_rows;
        
        for ($j = 0 ; $j < $rows2 ; ++$j)
        {                                       
           $result2->data_seek($j); 
           
           $passwordmatch = $result2->fetch_assoc()['password'];
           
         
           $salt1 = "qm&h*";
           $salt2 = "pg!@";
            
           $token = hash('ripemd128',"$salt1$checkpassword$salt2");           
           

           if($token == $passwordmatch)
           {

               echo <<<HOME
                        <script>
                            document.location.href = '/DineRoulette-tamkylet/app/php/home.php';
                        </script>
HOME;
           }
           else
           {
                //under id='login' -> Username and password don't match please try again. - add restrictions
                echo "Credentials didn't match; please try again.";
           }
        }
    }
    else
    {
         echo "Please enter both Username and Password.";
    }


    $db->close();
    
?>