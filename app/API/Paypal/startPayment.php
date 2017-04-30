<?php
	/*
		* Contains call to create payment object and receive Approval URL to which user is then redirected to.
	*/
	if (session_id() == "")
		session_start();
		

	include('utilFunctions.php');
	include('paypalFunctions.php');

	$access_token = getAccessToken();
	$_SESSION['access_token'] = $access_token;

	if(verify_nonce()){
		$expressCheckoutArray = json_decode($_SESSION['expressCheckoutPaymentData'], true);
		$expressCheckoutArray['transactions'][0]['amount']['details']['subtotal'] = $_POST['fee'];
		$expressCheckoutArray['transactions'][0]['item_list']['items'][0]['price'] = $_POST['fee'];
		$expressCheckoutArray['transactions'][0]['item_list']['items'][0]['currency'] = $_POST['currencyCodeType'];
		$expressCheckoutArray['transactions'][0]['amount']['details']['tax'] = $_POST['tax'];
		$expressCheckoutArray['transactions'][0]['amount']['details']['insurance'] = $_POST['insurance'];
		$expressCheckoutArray['transactions'][0]['amount']['details']['shipping'] = $_POST['estimated_shipping'];
		$expressCheckoutArray['transactions'][0]['amount']['details']['handling_fee'] = $_POST['handling_fee'];
		$expressCheckoutArray['transactions'][0]['amount']['details']['shipping_discount'] = $_POST['shipping_discount'];
		$expressCheckoutArray['transactions'][0]['amount']['total'] = (float)$_POST['fee'] + (float)$_POST['estimated_shipping'] + (float)$_POST['tax'] + (float)$_POST['insurance'] + (float)$_POST['handling_fee'] + (float)$_POST['shipping_discount'];
		$expressCheckoutArray['transactions'][0]['amount']['currency'] = $_POST['currencyCodeType'];
	
		$_SESSION['expressCheckoutPaymentData'] = json_encode($expressCheckoutArray);
		$approval_url = getApprovalURL($access_token, $_SESSION['expressCheckoutPaymentData']);

        	//redirect user to the Approval URL
        	header("Location:".$approval_url);
	}else {
		 die('Session expired');
	}

?>