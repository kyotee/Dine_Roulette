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
    
    echo <<<_END
    
       <body>
       
            <div class="inbordermid">
            
            <div class="inbordermidPAD">
                <br/>
                
                <p>$resturant->name</p>
                
                <p class="titles">restaurant of the Week</p>
                <blockquote class="resturantNames">$item->name</blockquote>
                
                <div id="imgContainer">
_END;

                echo "<blockquote><img src='/DineRoulette-tamkylet/app/images/".$item->image.".png' style='width:100%' alt='[]' /> </blockquote>";

    echo <<<_END1
                </div>

                <blockquote>
                    $item->description;
                </blockquote>
                
                <br/><br/>
_END1;

    echo "<blockquote>";
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/html/googlemaps.html");
    echo "</blockquote>";
 
    echo <<<_END1
                <blockquote>$item->address</blockquote>

                <br/><br/>
                
            </div>    
            
              <div class="inborderbottom">
              </div>
                
            </div>
            
       </body>
        
    </html>    
        
_END1;


?>