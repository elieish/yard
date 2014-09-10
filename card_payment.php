<?php
    use Tygh\Registry;

	if (!defined('BOOTSTRAP')) { die('Access denied'); }
	
	/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    return;
	}*/
	
	if ($mode == 'payment') {
	    Registry::get('view')->assign('card_payment');
		
		if($_GET['action'] == 'cancelled'){
			session_start();
			$_SESSION['POST_DATA'] 		= $_POST;
			
			$errorMessage				= $_POST['_ERROR_MESSAGE'];
			$result						= $_POST['_RESULT'];
			
			if($result < 0 && $errorMessage != 'Transaction cancelled by user')
				save_transaction();
			
			return header('location:'.fn_url().'index.php?dispatch=card_payment.payment');
		}
		if(!is_array($_SESSION['POST_DATA']))
			$_SESSION['POST_DATA'] = array();
		
		$_REQUEST = array_merge($_REQUEST, $_SESSION['POST_DATA']);
		
		$_SESSION['POST_DATA'] = $_POST;
	}
	
	if ($mode == 'make_payment') {
		//if ($processor_data['processor_params']['mode'] == 'test') {
	        $mygate_url = "https://dev-virtual.mygateglobal.com/PaymentPage.cfm";
	    /*} else {
	        $mygate_url = "https://virtual.mygateglobal.com/PaymentPage.cfm";
	    }*/
	    $fn_url		= fn_url();
		$return_url = "{$fn_url}index.php?dispatch=card_payment.payment_result&action=load_result";
	    $cancel_url = "{$fn_url}index.php?dispatch=card_payment.payment&action=cancelled";
	    $notify_url = "{$fn_url}index.php?dispatch=card_payment.payment";
		
		$post_data['Mode']						= "0";
		$post_data['MerchantID']				= "b887ea48-8e5c-49eb-bc73-934b5dc08058";
		$post_data['ApplicationID']				= "f08c00f3-345a-4a2b-8af6-b62fa2fe347d";
	
		//Currency and price of initial transaction
		$post_data['Currency']					= "ZAR";
		$post_data['Amount']					= $_POST['payment_amount'];
	
		//Redirect Details
		$post_data['RedirectSuccessfulURL']		= $return_url;
		$post_data['RedirectFailedURL']			= $cancel_url;
	
		//RCCB Variables
		//The frequency determines when the transaction will go off.
		$post_data['ACCB_Frequency']			= "M|1";
		//This is the start date of the first reocurring transaction.
		$post_data['ACCB_StartDate']			= date("d-M-Y");
		$post_data['ACCB_EndDate']				=  date("d-M-Y",mktime(0, 0, 0, date("m"),date("d")+1, date("Y")));
		
		//The amount that is to go ff after the initial amount specified above
		$post_data['ACCB_Amount']				= $_POST['payment_amount'];
	
		//Client details are used for reporting features in the MyGate web console
		$post_data['ACCB_ClientName']			= $_POST['company_name'];
		$post_data['MerchantReference']			= $_POST['invoice_id'];
		$post_data['ACCB_ClientAccountNo']		= "0";
		$post_data['ACCB_ClientEmailAddress']	= "";
		$post_data['ACCB_ClientMobileNumber']	= "";
		
		//These flags indicate whether you want MyGate to notify the client of the upcoming transaction via SMS and/or email. 0 = No. 1 = Yes.
		$post_data['ACCB_SendSMS']				= "0";
		$post_data['ACCB_SendEmail']			= "0";
	    
	    fn_create_payment_form($mygate_url, $post_data, 'MyGate server', false);
	}
	
	if($mode == 'payment_result'){
		//print_r($_POST); //Uncomment this line if you want to print out every value MyGate sends back.
		//Populate PHP variables with the POST back variables MyGate sends
		if($_GET['action'] == 'load_result'){
			session_start();
			$_SESSION['POSTDATA'] = $_POST;
			return header('location:'.fn_url().'index.php?dispatch=card_payment.payment_result');
		}
		if(!is_array($_SESSION['POSTDATA'])){
			unset($_POST);
			header('location:'.fn_url().'index.php?dispatch=card_payment.payment');
		}
		else
			$_POST = $_SESSION['POSTDATA'];
		
		if(isset($_POST)){
			$result									= $_POST['_RESULT'];
			$errorCode								= $_POST['_ERROR_CODE'];
			$errorSource							= $_POST['_ERROR_SOURCE'];
			$errorMessage							= $_POST['_ERROR_MESSAGE'];
			$errorDetail							= $_POST['_ERROR_DETAIL'];
			
			$variable1								= $_POST["VARIABLE1"];
			
			$bankErrorCode							= $_POST["_BANK_ERROR_CODE"];
			$bankErrorMessage						= $_POST["_BANK_ERROR_MESSAGE"];
			
			$threedsecure							= $_POST["_3DSTATUS"];
		
			$data									= save_transaction();
			
			//The $_POST['_RESULT'] element of the form post is the transaction result. 0=Successful, 1=Warning (A result of 1 is returned either when the fraud module is providing a flag or if unnecessary parameters were sent to the API in the request message). Note: A result code of 1 is still a successful transaction.
			if($result >= 0) {
				$data['result_message']				= "Successful Transaction";
			}
			else {
				$data['result_message']				= "Failed Transaction";
			}
			
			$data['variable1']						= $variable1;
			$data['error_code']						= $errorCode;
			$data['error_message']					= $errorMessage;
			$data['error_detail']					= $errorDetail;
			$data['bank_error_code']				= $bankErrorCode;
			$data['bank_error_message']				= $bankErrorMessage;
			
			Registry::get('view')->assign('transaction',$data);
		}
	}
	
	function save_transaction() {
		$result									= $_POST['_RESULT'];
		
		$date									= $_POST['TXTACQUIRERDATETIME'];
		$index									= $_POST['_TRANSACTIONINDEX'];
		$reference								= $_POST['_MERCHANTREFERENCE'];
		$payment_method							= $_POST['_PAYMETHOD'];
		$currency_code							= $_POST['_CURRENCYCODE'];
		
		$variable1								= $_POST["VARIABLE1"];
		
		$bankErrorCode							= $_POST["_BANK_ERROR_CODE"];
		$bankErrorMessage						= $_POST["_BANK_ERROR_MESSAGE"];
		$errorMessage							= $_POST['_ERROR_MESSAGE'];
		$errorDetail							= $_POST['_ERROR_DETAIL'];
		
		$cardCountry							= $_POST["_CARDCOUNTRY"];
		$price									= $_POST["TXTPRICE"];
		
		$bankErrorCode							= $_POST["_BANK_ERROR_CODE"];
		$bankErrorMessage						= $_POST["_BANK_ERROR_MESSAGE"];
		
		$data['transaction_index']				= $index;
		$data['transaction_date']				= $date;
		$data['payment_method']					= $payment_method;
		$data['invoice_no']						= $reference;
		$data['currency_code']					= $currency_code;
		$data['payment_amount']					= number_format($price,2);
		$data['card_country']					= $cardCountry;
		$data['transaction_result']				= $result;
		$data['error_message']					= empty($errorMessage)?"":$errorMessage."... ".$bankErrorMessage;
		$data['ip_address']						= $_SERVER['REMOTE_ADDR'];
		
		db_replace_into('card_transactions', $data);
		unset($_SESSION['POSTDATA']);
		
		return $data;
	}
?>