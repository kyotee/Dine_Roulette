<?php

        session_start();
        if ($_SESSION['userIDmaster'] != 1)
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

    require_once 'userlist.php';

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

    if (isset($_POST['delete']) && isset($_POST['username']))
    {
        $username = get_post($db, 'username');
        $query = "DELETE FROM user
                  WHERE username='$username'";
        $result = $db->query($query);
        if (!$result) echo "DELETE failed: $query<br>" .
        $db->error . "<br><br>";
    }
    if (isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']))
    {
        $username = get_post($db, 'username');
        $firstname = get_post($db, 'firstname');
        $lastname = get_post($db, 'lastname');
        $email = get_post($db, 'email');
        $password = get_post($db, 'password');

        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128',"$salt1$password$salt2");

        $query = "INSERT INTO user(username,firstname,lastname,email,password,active,datejoined,datesattended,rating)
               VALUES('$username','$firstname','$lastname','$email','$token','1','2016-08-05','1','1')";

        $result = $db->query($query);
        if (!$result) echo "INSERT failed: $query<br>" .
        $db->error . "<br><br>";

        copy('/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/derp.png', '/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/derp.png');
        rename('/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/derp.png', '/home/ubuntu/workspace/DineRoulette-tamkylet/app/images/memberPictures/'.$username.'.png');
    }

    echo <<<_END
        <form action="userlist.php" method="post"><pre>
        Username <input type="text" name="username">
        First Name <input type="text" name="firstname">
        Last Name <input type="text" name="lastname">
        E-mail <input type="text" name="email">
        Password <input type="password" name="password">
        <input type="submit" value="ADD RECORD">
        </pre></form>
_END;

    //----------------------------------------------- sorted category -----------------------------------------------

    echo <<<_END1
   <form action="userlist.php" method="post">
   <input type="submit" value="SORT USERNAME ALPHABETICALLY" name="sorted">
   </form>
_END1;

    echo <<<_END1
   <form action="userlist.php" method="post">
   <input type="submit" value="SORT FIRSTNAME ALPHABETICALLY" name="sortedFirst">
   </form>
_END1;

    echo <<<_END1
   <form action="userlist.php" method="post">
   <input type="submit" value="SORT LASTNAME ALPHABETICALLY " name="sortedLast">
   </form>
   </br>
_END1;

    if (isset($_POST['sorted']))
    {
            $query = "SELECT *
                      FROM user
                      ORDER BY username";
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);

            $rows = $result->num_rows;

            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);

                echo <<<_END
                <pre>
                Username: $row[0]
                First Name: $row[1]
                Last Name: $row[2]
                E-mail: $row[3]
                Password: $row[4]
                </pre>
                <form action="userlist.php" method="post">
                <input type="hidden" name="delete" value="yes">
                <input type="hidden" name="username" value="$row[0]">
                <input type="submit" value="DELETE RECORD"></form>
_END;
            }

            $db->close();
    }
    else if(isset($_POST['sortedFirst']))
     {
            $query = "SELECT *
              FROM user
              ORDER BY firstname";
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);

            $rows = $result->num_rows;

            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);

                echo <<<_END
                <pre>
                Username: $row[0]
                First Name: $row[1]
                Last Name: $row[2]
                E-mail: $row[3]
                Password: $row[4]
                </pre>
                <form action="userlist.php" method="post">
                <input type="hidden" name="delete" value="yes">
                <input type="hidden" name="username" value="$row[0]">
                <input type="submit" value="DELETE RECORD"></form>
_END;
            }

            $db->close();
    }
    else if(isset($_POST['sortedLast']))
    {
            $query = "SELECT *
            FROM user
            ORDER BY lastname";
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);

            $rows = $result->num_rows;

            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);

                echo <<<_END
                <pre>
                Username: $row[0]
                First Name: $row[1]
                Last Name: $row[2]
                E-mail: $row[3]
                Password: $row[4]
                </pre>
                <form action="userlist.php" method="post">
                <input type="hidden" name="delete" value="yes">
                <input type="hidden" name="username" value="$row[0]">
                <input type="submit" value="DELETE RECORD"></form>
_END;
            }

            $db->close();
    }
    else
    {
            $query = "SELECT *
                      FROM user";
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);

            $rows = $result->num_rows;

            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);

                echo <<<_END
                <pre>
                Username: $row[0]
                First Name: $row[1]
                Last Name: $row[2]
                E-mail: $row[3]
                Password: $row[4]
                </pre>
                <form action="userlist.php" method="post">
                <input type="hidden" name="delete" value="yes">
                <input type="hidden" name="username" value="$row[0]">
                <input type="submit" value="DELETE RECORD"></form>
_END;
            }

            $db->close();

    }

    function get_post($conn, $var)
    {
        return $conn->real_escape_string($_POST[$var]);
    }

?>