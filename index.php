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
    
    echo "<br>";
    
    //-------------------------------------------- Database Connection ------------------------------------
    
   
   
   
    //-------------------------------------------- Registration -------------------------------------------   

    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/layout.html");
    
    if (isset($_COOKIE['exists']))
    {
    echo <<<_END
         <script>
             var message = "Username already exists, try another username.";
             alert(message);
         </script>
_END;
        setcookie('exists', 'exists', time() - 20, '/');
    }
    else
    {}
    

    echo <<<_END
        
            <head>
                <noscript>
                    <style>html{display:none;}</style>
                    <meta http-equiv="refresh" content="0.0;url=/app/html/nojavascript.html">
                </noscript>
                
                <script src='/DineRoulette-tamkylet/app/javascript/jquery-3.1.0.min.js'></script>
                <script src='/DineRoulette-tamkylet/app/javascript/signup.js'></script>                
                <script src='/DineRoulette-tamkylet/app/javascript/login.js'></script>
                
                <link href="/DineRoulette-tamkylet/app/css/signup.css" rel="stylesheet" type="text/css"/>
            </head>
            
            <body>
                <div id="signup1" style="display:none">
                
                  <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee" width="400">
                    <th colspan="2" align="center">DineRoulette</th>

                  <form method="post" action="/DineRoulette-tamkylet/app/php/registration.php" onSubmit="return validate(this)">
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
               </div>
_END;
    
    //-------------------------------------------- Registration -------------------------------------------    

    if (isset($_COOKIE['success']))
    {
    echo <<<_END
         <script>
             var message = "Registration successful, please see e-mail to verify.";
             alert(message);
         </script>
_END;
        setcookie('success', 'success', time() - 20, '/');
    }
    else
    {}   
   
 
    if (isset($_COOKIE['mismatch']))
    {
    echo <<<_END
         <script>
             var message = "Invalid credentials, please try again.";
             alert(message);
         </script>
_END;
        setcookie('mismatch', 'mismatch', time() - 20, '/');
    }
    else
    {}      
    //----------------------------------------------- Login -----------------------------------------------   

   
    echo <<<_END1

                <div id="login1">
                  <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee" width="400">
                    <th colspan="2" align="center">DineRoulette</th>
        
                  <form method="post" action="/DineRoulette-tamkylet/app/php/login.php" onSubmit="return validate1(this)">
                    <br>
                    <tr>
                        <td id='login'></td>
                    </tr>
                    <br>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" maxlength="12" name="username"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" maxlength="20" name="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Login"></td>
                    </tr>
                </form>
                </table>    
                
                <button id="link">Register</button>
                <script>
                    $('#link').click( function() { $("#signup1").show(); $("#login1").hide(); });
                </script>
              </div>
_END1;
    

    //----------------------------------------------- Login -----------------------------------------------    
   
   
   
   echo "</body>";
   echo "</html>";
?>