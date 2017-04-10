<?php
    
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
        

    class User
    {    
        // Constructor - creates instance of class
        // PRE: -
        // POST: instantiated object
        // PARAMS: $param1 = username of existing logged in user
    	function __construct($param1)
    	{
    		$username = $param1;
    	}
    
        // Destructor - deletes instance of class
        // PRE: existing object must be present
        // POST: deletes instantiated object
        // PARAMS: &$object1 = reference of object
        function __destruct()
        {
            unset($this);
        }
        
        // Userlist - displays all users of service
        // PRE: user must be signed in
        // POST: users and associated primary information displayed; able to access 
        //       secondary information and request date
        // PARAMS: $db = database Connection
        function display($db)
        {
        
            $username = $_SESSION['username'];
            $username1 = "masteruser";
            
            $query = "SELECT * 
                      FROM user
                      WHERE username != '$username' && username != '$username1'";
                      
            $result = $db->query($query);
            if (!$result) die ("Database access failed." . $db->error);            
            
            
            $rows = $result->num_rows;

            
            for ($j = 0 ; $j < $rows ; ++$j)   // can't execute for-loop
            {
                
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                
                    
        echo <<<_END1
          
          <div class="homeplace">   
                    
            <div class="placeholder">  
            
                <a class="NoColor" href="/DineRoulette-tamkylet/app/php/profile.php">
            
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
                   
            </div>   
     
            <form method="post" action="/DineRoulette-tamkylet/app/php/home.php">
                <input type="hidden" name="requested" value="$row[0]">
                <button input type="submit" value="Request Date" style="display:block; color:white; background-color:#008080; padding:0.25em; margin: 0 auto;">Request Date</button>
            </form>  
     
            <script src='/DineRoulette-tamkylet/app/javascript/home.js'></script>
    
          </div>
            
_END1;
            }           
        
        echo <<<_END2
                
                <br/><br/>
                
            </div>   
            
          </div>
                
            
       </body>
        
    </html>    
_END2;
             
        }

        // Request handling - user has request date with other user
        // PRE: user must be signed in
        // POST: user sucessfully sends request to other user
        // PARAMS: $requestedUser = update credentials of user being requested; $db = database Connection
        function requested($requestedUser,$db)
        {        
            $username = $_SESSION['username'];
            
            //update user datebase to reflect on request
            $query1 = "UPDATE user
                       SET invitername = '$username', invitation = '1', suggestedrestaurant = 'Chipotle'
                       WHERE username = '$requestedUser'";
            
            $result1 = $db->query($query1);
            if (!$result1) die ("Database access failed." . $db->error);  
            
        }
        
        // Invitation checker - check to see if current user has an invite
        // PRE: user must be signed in
        // POST: returns true if user has an invite; otherwise false
        // PARAMS: $checkUser = determine if user was requested; $db = database Connection
        function invitation($checkUser,$db)
        {
            $query2 = "SELECT * 
                       FROM user
                       WHERE username = '$checkUser'";
                      
            $result2 = $db->query($query2);
                if (!$result2) die ("Database access failed." . $db->error);  
            
            $result2->data_seek(0);
            $row = $result2->fetch_array(MYSQLI_NUM);
            
            if ($row[12] == '1')
                return true;
            else 
                return false;
        }
          
        // Date confirmination - both users have agree upon date
        // PRE:
        // POST:
        // PARAMS: 
        function matched()  
        {
            
            
            
        echo <<<_END2
        
            <p>Hello world!</p>
                
                <br/><br/>
                
            </div>   
            
          </div>
            
       </body>
        
    </html>    
_END2;
            
        }
    }

?>