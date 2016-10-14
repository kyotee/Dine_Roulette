<?php


        require_once 'profile.php';
        
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
                <p class="titles">Your Profile</p>
_END;

            $username = $_SESSION['username'];

            $query = "SELECT * 
                      FROM user
                      WHERE username = '$username'";
                      
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);
            
            $rows = $result->num_rows;
            
            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                
                echo <<<_END1
<blockquote>

        <div id="profilepic">
        
                <img src='/DineRoulette-tamkylet/app/images/derp.png' style='width:28%;height:28%' alt='[]' />
                
                <div id="profilepic1">
        
                        <pre>
                        Username:  $row[0]      
                        Firstname: $row[1]      
                        Lastname:  $row[2]      
                        E-mail:    $row[3]   
                        
                        Dates Attended:     $row[7]
                        Rating:             $row[8]
                        Extreme Resturants: $row[9]
                        Accomplished Dares: $row[10]
                        
                        </pre>
                        
                        <pre>
                        <ul>

                        </ul>
                        </pre>
                        
                </div>
        
        </div>

</blockquote>
_END1;
            }
            
    
            
            $db->close();        


                echo <<<_END2
                
                <br/><br/>
                
            </div>    
                
                <div class="inborderbottom1">
                </div>
                
            </div>
            
       </body>
        
    </html>    
        
        
_END2;



?>