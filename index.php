<?php
  
    require_once 'index.php';   
   
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

    echo <<<_END
        <!DOCTYPE html>
          <html>
            <head>
                <noscript>
                    <style>html{display:none;}</style>
                    <meta http-equiv="refresh" content="0.0;url=/html/nojavascript.html">
                </noscript>
                
                <title>Registration</title>
                <script src='/javascript/jquery-3.1.0.min.js'></script>
                <script src="/javascript/signup.js"></script>
            </head>
            
            <body>
                  <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
                    <th colspan="2" align="center">Signup Form</th>

                  <form method="post" action="/app/php/registration.php" onSubmit="return validate(this)">
                    <br>
                    <tr>
                        <td id='signup'></td>
                    </tr>
                    <br>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" maxlength="12" name="username"></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" maxlength="12" name="firstname"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" maxlength="12" name="lastname"></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input type="text" maxlength="40" name="email"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" maxlength="20" name="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Signup"></td>
                    </tr>
                </form>
                </table>
            </body>
            
           </html>
_END;
    
    //-------------------------------------------- Registration -------------------------------------------    

   
   
?>