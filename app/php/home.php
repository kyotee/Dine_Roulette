<?php

        require_once 'home.php';
        
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
                <p class="titles">Member List</p>
                </br>
_END;

            $username = $_SESSION['username'];
            $username1 = "masteruser";

            $query = "SELECT * 
                      FROM user
                      WHERE username != '$username' && username != '$username1'";
                      
            $result = $db->query($query);
            if (!$result) die ("Database access failed: " . $db->error);
            
            $rows = $result->num_rows;
            
            for ($j = 0 ; $j < $rows ; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                
                
                echo <<<_END1
                
      
      <div class="homeplace">   
                
        <div class="placeholder">  
        
                
            <div class="homeimg">    
                
              <img src='/DineRoulette-tamkylet/app/images/memberPictures/$row[0].png' style='width:5.25em;height:5.25em' alt='[]' />
          
            </div>
        
             <div class="hometext">
                <pre class="name">
                $row[0]   
                </pre>
                
                <pre>
                Dates Attended:     $row[7]
                Rating:             $row[8]
                Extreme Resturants: $row[9]
                Accomplished Dares: $row[10]
                </pre>
               </div>
               
                <button class="acdc">Request Date</button>
               
                <script src='/DineRoulette-tamkylet/app/javascript/home.js'></script>
               
            </div>   
        
        </div>
               
            

_END1;
            }
            
    
            
            $db->close();        


                echo <<<_END2
                
                <br/><br/>
                
                
            </div>   
            
            </div>
                
            
       </body>
        
    </html>    
        
        
_END2;




?>