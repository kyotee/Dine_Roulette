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

    session_start();
    $restName = $_SESSION['restaurant1'];
    $restImg = $_SESSION['restaurant2'];
    $restDesc = $_SESSION['restaurant3'];
    $restAddress = $_SESSION['restaurant4'];

    echo <<<_END
       <body>
            <div class="inbordermid">
            <div class="inbordermidPAD">
                <br/>
                <p>$resturant->name</p>
                <p class="titles">restaurant of the Week</p>
                <blockquote class="resturantNames">$restName</blockquote>
                <div id="imgContainer">
_END;

                echo "<blockquote><img src='/DineRoulette-tamkylet/app/images/".$restImg.".png' style='width:100%' alt='[]' /> </blockquote>";

    echo <<<_END1
                </div>
                <blockquote>
                    $restDesc;
                </blockquote>
                <br/><br/>
_END1;

    echo "<blockquote>";
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/html/googlemaps.html");
    echo "</blockquote>";

    echo <<<_END1
                <blockquote>$restAddress</blockquote>
                <br/><br/>
            </div>
              <div class="inborderbottom">
              </div>
            </div>
       </body>
    </html>
_END1;

?>