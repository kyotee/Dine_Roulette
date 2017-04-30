<?php
    /*
        * Payment Confirmation page : has call to execute the payment and displays the Confirmation details
    */
    if (session_id() == "")
        session_start();
        
    session_start();
        
    include('utilFunctions.php');
    include('paypalFunctions.php');


    if( isset($_GET['paymentId']) && isset($_GET['PayerID'])){ //Proceed to Checkout or Mark flow

        //call to execute payment
        $response = doPayment(filter_input( INPUT_GET, 'paymentId', FILTER_SANITIZE_STRING ), filter_input( INPUT_GET, 'PayerID', FILTER_SANITIZE_STRING ), NULL);

    } else { //Express checkout flow

        if(verify_nonce()){
            $expressCheckoutFlowArray = json_decode($_SESSION['expressCheckoutPaymentData'], true);
                    $expressCheckoutFlowArray['transactions'][0]['amount']['total'] = (float)$expressCheckoutFlowArray['transactions'][0]['amount']['total'] + (float)$_POST['shipping_method'] - (float)$expressCheckoutFlowArray['transactions'][0]['amount']['details']['shipping'];
                    $expressCheckoutFlowArray['transactions'][0]['amount']['details']['shipping'] = $_POST['shipping_method'];
                    $transactionAmountUpdateArray = $expressCheckoutFlowArray['transactions'][0];
                    $_SESSION['expressCheckoutPaymentData'] = json_encode($expressCheckoutFlowArray);

                    //call to execute payment with updated shipping and overall amount details
                    $response = doPayment($_SESSION['paymentID'], $_SESSION['payerID'], $transactionAmountUpdateArray);
        } else {
            die('Session expired');
        }
    }
	
	// REST validation; route non-HTTP 200 to error page
	if ($response['http_code'] != 200 && $response['http_code'] != 201) {		
		$_SESSION['error'] = $response;
		header( 'Location: error.php');
		
		// need exit() here to maintain session data after redirect to error page
		exit();
	}
	
	$json_response = $response['json']; 
	
    $paymentID= $json_response['id'];
    $paymentState = $json_response['state'];
    $finalAmount = $json_response['transactions'][0]['amount']['total'];
    $currency = $json_response['transactions'][0]['amount']['currency'];
    $transactionID= $json_response['transactions'][0]['related_resources'][0]['sale']['id'];

    $payerFirstName = filter_var($json_response['payer']['payer_info']['first_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $payerLastName = filter_var($json_response['payer']['payer_info']['last_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $recipientName= filter_var($json_response['payer']['payer_info']['shipping_address']['recipient_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine1= filter_var($json_response['payer']['payer_info']['shipping_address']['line1'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine2 = (isset($json_response['payer']['payer_info']['shipping_address']['line2']) ? filter_var($json_response['payer']['payer_info']['shipping_address']['line2'],FILTER_SANITIZE_SPECIAL_CHARS) :  "" );
    $city= filter_var($json_response['payer']['payer_info']['shipping_address']['city'],FILTER_SANITIZE_SPECIAL_CHARS);
    $state= filter_var($json_response['payer']['payer_info']['shipping_address']['state'],FILTER_SANITIZE_SPECIAL_CHARS);
    $postalCode = filter_var($json_response['payer']['payer_info']['shipping_address']['postal_code'],FILTER_SANITIZE_SPECIAL_CHARS);
    $countryCode= filter_var($json_response['payer']['payer_info']['shipping_address']['country_code'],FILTER_SANITIZE_SPECIAL_CHARS);
	
    include('header.php');
    
?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h4>
                <?php echo($payerFirstName.' '.$payerLastName.', Thank you for your Order!');?><br/><br/>
                Shipping Address: </h4>
                <?php echo($recipientName);?><br/>
                <?php echo($addressLine1);?><br/>
                <?php echo($addressLine2);?><br/>
                <?php echo($city);?><br/>
                <?php echo($state.'-'.$postalCode);?><br/>
                <?php echo($countryCode);?>

                <h4>Payment ID: <?php echo($paymentID);?> <br/>
		Transaction ID : <?php echo($transactionID);?> <br/>
                State : <?php echo($paymentState);?> <br/>
                Total Amount: <?php echo($finalAmount);?> &nbsp;  <?php echo($currency);?> <br/>
            </h4>
            <br/>
    
    
    
            
            <?php
                include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/php/classes/user.php");
            
                $loggedInUser = $_SESSION['username'];
                $userSignedIn = new User($loggedInUser);
                $userSignedIn->paypalPaid($db,$loggedInUser);
                $userSignedIn->updatePaid($db,$loggedInUser);
                $inviterEmail = $_SESSION['inviterEmail'];
                echo "<script>alert('Email has been sent to inviter to pay their fee.');</script>";

                //-------------------------------Notification email --------------------------------------------
                //verification email used only when deployment server is created
                //...right now we will assume every signup was verified => active set to '1'
                
                $inviter = $_SESSION['inviterName'];
                
                $to      = $inviterEmail;
                $subject = 'DineRoulette | Date Notification';
                $message = '
                 
                Hello '.$inviter.'! 
                
                '.$loggedInUser.' has accepted your invitation. 
                
                Please login to DineRoulette and pay the fixed fee to finalize the date.

                ';
                
                $headers = 'From:noreply@radiant-taiga-47474.herokuapp.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email

                
            ?>
            
            <form method="post" action="/DineRoulette-tamkylet/app/php/home.php">
                <button input type="submit" value="PaypalPay">Return back to home page.</button>
            </form>  

        </div>
        <div class="col-md-4"></div>
    </div>
    
<?php
    include('footer.php');
?>

