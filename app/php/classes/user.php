<?php
    
    //credentials for localserver
    $servername = getenv('IP');
    $username = "tamkylet";
    $password = "password";
    $database = "dine";
    $dbport = 3306;
    session_start();
    
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
          
          <br/>
          <p class="titles">Member List</p>
          </br>
          
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
                    </pre>
                    
                 </div>
                   
            </div>   
     
            <form class="requesting" method="post" action="/DineRoulette-tamkylet/app/php/home.php">
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
            $restName = $_SESSION['restaurant1'];

            //update user datebase to reflect on request
            $query1 = "UPDATE user
                       SET invitername = '$username', invitation = '1', suggestedrestaurant = '$restName'
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
            $query2 = "SELECT invitation
                       FROM user
                       WHERE username = '$checkUser'";
                      
            $result2 = $db->query($query2);
                if (!$result2) die ("Database access failed." . $db->error);  
            
            $row = $result2->fetch_assoc();
            
            if ($row["invitation"] == '1')
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
        
                <script>
                    document.location.href = '/DineRoulette-tamkylet/app/API/Paypal/index.php';
                </script>
                
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
        function paid($db)
        {
            echo '<script>alert("Hello");</script>';
        }
        
        // Rejection - user rejects a date request
        // PRE: user must be signed in
        // POST: user rejects a date and will be redirected back to user list
        // PARAMS: $username = user who wants to reject date; $db = database Connection
        function rejection($db,$username)
        {
            $query3 = "UPDATE user SET invitation='0'
                       WHERE username='".$username."'";

            $result3 = $db->query($query3);   
            if (!$result3) die("Database access failed.");    
        }
        
        // Paid - user paid with Paypal
        // PRE: user must be signed in
        // POST: Paypal deducts $20 from user account
        // PARAMS: $username = user who wants to reject date; $db = database Connection
        function paypalPaid($db,$username)
        {
            $query3 = "UPDATE user SET invitation='0'
                       WHERE username='".$username."'";

            $result3 = $db->query($query3);   
            if (!$result3) die("Database access failed.");
        }
        
        // Date - indicates a date occured
        // PRE: user must be signed in
        // POST: update table to reflect that date occured
        // PARAMS: $username = user who wants to reject date; $db = database Connection
        function updatePaid($db,$username)
        {
            $inviter = $_SESSION['inviterName'];
            $restaurant = $_SESSION['suggestedrestaurant'];

            $query4 = "INSERT INTO restaurant(username1,username2,restaurantname,paid)
               VALUES('$username','$inviter','$restaurant','1')";

            $result4 = $db->query($query4);
            if (!$result4) die("Database access failed.");  
        }
        
        
        function reflect($username,$db)
        {
            $inviter = $_SESSION['inviterName'];
            
            $query5 = "SELECT *
                       FROM restaurant
                       WHERE username1 = '$username' AND username2 = '$inviter'";
                      
            $result5 = $db->query($query5);
                if (!$result5) die ("Database access failed." . $db->error);  
            
            $row = $result5->fetch_assoc();
            
            if ((int)$row["seen"] == '0')
                return true;
            else 
                return false;
        }
        
        function reflectForm($username,$db)
        {
            $inviter = $_SESSION['inviterName'];

echo <<<_END3
                <br/>
                <p class="titles">How was your date with $inviter?</p>
                </br>
                
                <form method="post" action="/DineRoulette-tamkylet/app/php/home.php">
                    <p>Tell us about your date experience:</p>
                    <textarea name="Comment1" rows="4" cols="50" maxlength="50">A big load of text</textarea></br></br>
                    <p>Rating of date:</p>
                    <select name="Comment2">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select></br></br>
                    <button input type="submit" value="PaypalPay">Return back to home page.</button>
                </form>

                <br/><br/><br/>

                <form method="post" action="/DineRoulette-tamkylet/app/php/home.php">
                    <input type="hidden" name="noComments" value="0">
                    <button input type="submit" value="PaypalPay">I don't want to leave comments.</button>
                </form>

                <br/><br/>
                
            </div>   
            
          </div>
            
       </body>
        
    </html>                 
_END3;
        }
    }

?>
