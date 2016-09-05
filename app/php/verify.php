<?php
    
    require_once 'verify.php';
 
    //credentials for localserver
    $servername = getenv('IP');
    $username = "tamkylet";
    $password = "password";
    $database = "dine";
    $dbport = 3306;
    
    // Create connection
    $db1 = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db1->connect_error) {
        die("Connection failed: " . $db1->connect_error);
    } 
    
    if(isset($_GET['email']) && isset($_GET['token1']))
    {
        $emailtemp = $_GET['email'];
       
        $query1 = "UPDATE user SET active='1' 
                   WHERE email='".$emailtemp."' AND active='0'";
                
        $result1 = $db1->query($query1);   
        if (!$result1) die("Account has already been verified, please login.");        
    }
    else
    {
        // Invalid approach
        echo "Please use the link that has been send to your email.";
    }

    $db1->close();

?>