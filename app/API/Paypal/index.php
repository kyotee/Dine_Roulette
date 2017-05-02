<?php

    include('apiCallsData.php');
    include('header.php');
    include('paypalConfig.php');

    session_start();

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

    $userSignedIn = $_SESSION['username'];

    $query1 = "SELECT *
               FROM user
               WHERE username = '$userSignedIn'";

    $result1 = $db->query($query1);
        if (!$result1) die ("Database access failed." . $db->error);

    $row = $result1->fetch_assoc();

    $inviterName = $row["invitername"];
    $suggestRest = $row["suggestedrestaurant"];

    $_SESSION['inviterName'] = $inviterName;
    $_SESSION['suggestedrestaurant'] = $suggestRest;

    $query2 = "SELECT *
               FROM user
               WHERE username = '$inviterName'";

    $result2 = $db->query($query2);
        if (!$result1) die ("Database access failed." . $db->error);

    $row1 = $result2->fetch_assoc();

    $inviterEmail = $row1["email"];

    $_SESSION['inviterEmail'] = $inviterEmail;

    $xmldata = simplexml_load_file('/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/restaurantList.xml');

    foreach ($xmldata-> resturant as $resturant)
    {
        if($resturant->name == $suggestRest)
        {
            $suggestImg = (string)$resturant->image;
            $suggestDesc = (string)$resturant->description;
            $suggestAddress = (string)$resturant->address;
        }
    }

    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/skeletontop.html");

    //setting the environment for Checkout script
    if(SANDBOX_FLAG) {
        $environment = SANDBOX_ENV;
    } else {
        $environment = LIVE_ENV;
    }

    echo <<<_END

   <body>

            <div class="inbordermid">

            <div class="inbordermidPAD">
            <br/>

                <p class="titles">Dine meetup</p>
                <blockquote class="resturantNames">$suggestRest</blockquote>
                <blockquote><img src="/DineRoulette-tamkylet/app/images/$suggestImg.png" width="100%"/></blockquote>
_END;

    echo "<blockquote>";
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/API/GoogleMaps/html/googlemaps.html");
    echo "</blockquote>";
    echo "<blockquote>$suggestAddress</blockquote>";
?>
            </br>
            <h3>Agreement to Dine</h3>

            <blockquote>
                 Agree to policies! sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                 et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                 aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                 dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                 officia deserunt mollit anim id est laborum.
            </blockquote>

            <h3>Inviter</h3>

            <blockquote>
                <img src='/DineRoulette-tamkylet/app/images/memberPictures/<?php echo "$inviterName" ?>.png' style='width:5.25em;height:5.25em' alt='[]' />
                <p><?php echo "$inviterName" ?></p>
            </blockquote>


            <h3> Pay Restuarant </h3>
            <form id="paypalMid" action="startPayment.php" method="POST">
                 <input type="text" name="csrf" value="<?php echo($_SESSION['csrf']);?>" hidden readonly/>
                 <table>
                    <!-- Item Details - Actual values set in apiCallsData.php -->
                     <tr><td>Fee ($)</td><td><input class="form-control" type="text" name="fee" value="20" readonly></input></td></tr>
                     <tr><td>Currency</td><td>
                        <select class="form-control" name="currencyCodeType">
                        						<option value="CAD">CAD</option>
                     </td></tr>

                 </table>

                <br/>

                <!--Container for Checkout with PayPal button-->
                <div id="myContainer"></div>
                <br/>

            </form>



    <!-- PayPal In-Context Checkout script -->
    <script type="text/javascript">
     window.paypalCheckoutReady = function () {
         paypal.checkout.setup('<?php echo(MERCHANT_ID); ?>', {
             container: 'myContainer', //{String|HTMLElement|Array} where you want the PayPal button to reside
             environment: '<?php echo($environment); ?>' //or 'production' depending on your environment
         });
     };
     </script>
     <script src="//www.paypalobjects.com/api/checkout.js" async></script>

     <h3>Reject this date</h3>

     <form class="requesting" method="post" action="/DineRoulette-tamkylet/app/php/home.php">
        <input type="hidden" name="rejectDate" value="reject">
        <button input type="submit" value="Reject" id="reject">Reject</button>
    </form>

<?php


     include('footer.php');
?>

          </div>

          <div class="inborderbottom">
          </div>

        </div>

   </body>

</html>