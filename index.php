<?php
   
   
   //-------------------------------------------- Database Connection ------------------------------------
   
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
    echo "Connected successfully (".$db->host_info.")";
    
    echo "<br>";
    
    //-------------------------------------------- Database Connection ------------------------------------
    
   
   
   
    //-------------------------------------------- Registration -------------------------------------------   
   
    
   
   
    //-------------------------------------------- Registration -------------------------------------------    
   
   
?>