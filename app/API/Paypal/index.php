<?php

    include('apiCallsData.php');
    include('header.php');
    include('paypalConfig.php');
    
    session_start();
    
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/skeletontop.html");
    
    //setting the environment for Checkout script
    if(SANDBOX_FLAG) {
        $environment = SANDBOX_ENV;
    } else {
        $environment = LIVE_ENV;
    }
    
?>

   <body>
   
        <div class="inbordermid">
        
        <div class="inbordermidPAD">
        <br/>
        
            <p class="titles">Dine meetup</p>
            <blockquote class="resturantNames">Restaurant 1</blockquote>
            <blockquote><img src="/DineRoulette-tamkylet/app/images/12345dinnerTable.png" width="100%"/></blockquote>

            </br>
            <h3>Agreement to Dine</h3>
            
            <blockquote>
                 Agree to policies! sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                 et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                 aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                 dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui 
                 officia deserunt mollit anim id est laborum.
            </blockquote>


            <h3> Pricing Details </h3>
            <form id="paypalMid" action="startPayment.php" method="POST">
                 <input type="text" name="csrf" value="<?php echo($_SESSION['csrf']);?>" hidden readonly/>
                 <table>
                    <!-- Item Details - Actual values set in apiCallsData.php -->
                     <tr><td>Camera </td><td><input class="form-control" type="text" name="camera_amount" value="300" readonly></input></td></tr>
                     <tr><td>Tax </td><td><input class="form-control" type="text" name="tax" value="5" readonly></input> </td></tr>
                     <tr><td>Insurance </td><td><input class="form-control" type="text" name="insurance" value="10" readonly></input> </td></tr>
                     <tr><td>Handling Fee </td><td><input class="form-control" type="text" name="handling_fee" value="5" readonly></input> </td></tr>
                     <tr><td>Estimated Shipping </td><td><input class="form-control" type="text" name="estimated_shipping" value="2" readonly></input> </td></tr>
                     <tr><td>Shipping Discount </td><td><input class="form-control" type="text" name="shipping_discount" value="-2" readonly></input> </td></tr>
                     <tr><td>Total Amount </td><td><input class="form-control" type="text" name="total_amount" value="320" readonly></input> </td></tr>
                     <tr><td>Currency</td><td>
                        <select class="form-control" name="currencyCodeType">
                        						<option value="AUD">AUD</option>
                        						<option value="BRL">BRL</option>
                        						<option value="CAD">CAD</option>
                        						<option value="CZK">CZK</option>
                        						<option value="DKK">DKK</option>
                        						<option value="EUR">EUR</option>
                        						<option value="HKD">HKD</option>
                        						<option value="MYR">MYR</option>
                        						<option value="MXN">MXN</option>
                        						<option value="NOK">NOK</option>
                        						<option value="NZD">NZD</option>
                        						<option value="PHP">PHP</option>
                        						<option value="PLN">PLN</option>
                        						<option value="GBP">GBP</option>
                        						<option value="RUB">RUB</option>
                        						<option value="SGD">SGD</option>
                        						<option value="SEK">SEK</option>
                        						<option value="CHF">CHF</option>
                        						<option value="THB">THB</option>
                        						<option value="USD" selected>USD</option>
                     </td></tr>

                 </table>

                <br/>
                
             
                <!--Container for Checkout with PayPal button-->
                <div id="myContainer"></div>
                <br/>
                <span style="margin-left:60px">OR</span>
                <br/><br/>
                <div>
                    <button class="btn btn-primary" formaction="shipping.php" role="button">Proceed to Checkout</button>
                </div>
                
                
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
     
     
<?php
     include('footer.php');
?>

          </div>

          <div class="inborderbottom">
          </div>
            
        </div>
        
   </body>
    
</html>    