<?php
	require_once('db_connection.php');

	function reservation(){
		$db_connect = db_connect();
		
	$currency = $_POST['currency'] ?? null;
    $advance = $_POST['advance'] ?? null;
    $advance_currency = $_POST['advance_currency'] ?? null;
    $source = $_POST['source'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;
		
		$error=[];
		if(empty($currency)){
			$error['currency'] = 'Payment Currency Required';
		}
		if(!empty($advance) && empty($advance_currency )){
			 $error['advance_currency'] = 'Advance Currency Required';
		}
		if(empty($source)){
			 $error['source'] = 'Revervation Source Required';
		}
		if(empty($payment_method)){
			 $error['payment_method'] = 'Payment Method Required';
		}
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
			
			return [
			 	'status' => 'success',
			 	'message' => 'Reservation Added Success',
			 ];

			
	}
?>