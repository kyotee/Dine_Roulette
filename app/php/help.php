<?php

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
    
    
    
    $xmldata = simplexml_load_file('/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/restaurantList.xml');
    $random = array_rand($xmldata->xpath("resturant"), 1);
    $item = $xmldata->resturant[$random];
    echo $item->address;
    

    
    echo <<<_END
    
       <body>
       
            <div class="inbordermid">
            
            <div class="inbordermidPAD">
                <br/>
                
                <p>$resturant->name</p>
                
                <p class="titles">Resturant of the Week</p>
                <blockquote class="resturantNames">Restaurant 1</blockquote>
                
                <div id="imgContainer">
                    <blockquote><img src='/DineRoulette-tamkylet/app/images/12345dinnerTable.png' style='width:100%' alt='[]' /> </blockquote>
                </div>

                <blockquote>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                         et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                         dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui 
                         officia deserunt mollit anim id est laborum.
                </blockquote>
                
                <br/><br/>
_END;

    echo "<blockquote>";
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/html/googlemaps.html");
    echo "</blockquote>";
 
    echo <<<_END1
                <blockquote>162 Water St, Vancouver, BC</blockquote>

                <br/><br/>
                
            </div>    
            
              <div class="inborderbottom">
              </div>
                
            </div>
            
       </body>
        
    </html>    
        
_END1;


?>