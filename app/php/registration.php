<?php

    require_once 'registration.php';

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

    if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $usernametemp = $_POST['username'];
        $firstnametemp = $_POST['firstname'];
        $lastnametemp = $_POST['lastname'];
        $emailtemp = $_POST['email'];
        $passwordtemp = $_POST['password'];

        $username = sanitizeString($db,$_POST['username']);
        $firstname = sanitizeString($db,$_POST['firstname']);
        $lastname = sanitizeString($db,$_POST['lastname']);
        $email = sanitizeString($db,$_POST['email']);
        $password = sanitizeString($db,$_POST['password']);

        if($usernametemp != $username || $firstnametemp != $firstname || $lastnametemp != $lastname || $emailtemp != $email || $passwordtemp != $password)
        {
           //false error message - suspected hacker
           echo <<<_ERROR
                <script>
                    alert("Input/Inputs are forbidden on this browser. Please attempt to change.");
                    document.location.href = '/DineRoulette-tamkylet/index.php';
                </script>
_ERROR;
        }
        else
        {
            //secure DB input for passwords - salting for our hash function

            $salt1 = "qm&h*";
            $salt2 = "pg!@";
            $token = hash('ripemd128',"$salt1$password$salt2");

            //database insertion happens here
            $query = "INSERT INTO user(username,firstname,lastname,email,password,active,datejoined,datesattended,rating)
               VALUES('$username','$firstname','$lastname','$email','$token','1','2016-08-05','0','0')";

            $result = $db->query($query);
            if (!$result) die ("Database access failed." . $db->error);

            copy('/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/derp.png', '/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/derp.png');
            rename('/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/derp.png', '/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/'.$username.'.png');

            if(!$result)
            {
                setcookie('exists', 'exists', time() + 20, '/');

           echo <<<_MSG
                <script>
                    document.location.href = '/DineRoulette-tamkylet/index.php';
                </script>
_MSG;
            }
            else
            {
                setcookie('success', 'success', time() + 20, '/');

    //--------------------------------------------------------------------------------------------------------------------------


                //-------------------------------verification email --------------------------------------------
                //verification email used only when deployment server is created

                $token1 = hash('ripemd128',"$salt1$email$salt2");

                $to      = $email;
                $subject = 'DineRoulette | Verification';
                $message = '

                Thanks for signing up!
                Your account has been created, you can login with the following username after you have activated your account by pressing the url below.

                ------------------------
                Username: '.$username.'
                ------------------------

                Please click this link to activate your account:
                https://radiant-taiga-47474.herokuapp.com/app/php/verify.php?email='.$email.'&token1='.$token1.'

                ';

                $headers = 'From:noreply@radiant-taiga-47474.herokuapp.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email

                echo <<<_MSG
                <script>
                    document.location.href = '/DineRoulette-tamkylet/index.php';
                </script>
_MSG;
           }
        }

            //-------------------------------verification email --------------------------------------------

    }
    else
    {
        echo "Please enter all credentials.";
    }

    //sanitize input for database - prevent hack attempts
    function sanitizeString($db,$var)
    {
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return $db->real_escape_string($var);
    }

    $db->close();

?>