<?php
	require_once ('db_connection.php');
// Single reservation
	function single_invoice(){
		$db_connect = db_connect();
		$submitted_by = $_POST['submitted_by'];
		$hotel = $_POST['hotel'];
		$invoice = $_POST['invoice'];
		$reference = $_POST['reference'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		
		
		$error=[];
		if(empty($hotel) ){
			  $error['hotel'] = 'Hotel Name Is Required';
		}
		if(empty($invoice) ){
			  $error['invoice'] = 'Invoice Number Is Required';
		}
		if(empty($reference) ){
			  $error['reference'] = ' Reference Number Is Required';
		}
		if(empty($date) ){
			  $error['date'] = ' Invoice Date Is Required';
		}
		if(empty($amount) ){
			  $error['amount'] = ' Due Amount is Required';
		}
		
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
			 $sql_insert = "INSERT INTO bank_invoice(type,submitted_by,hotel,invoice, reference, date, amount) VALUES ('single','$submitted_by','$hotel','$invoice','$reference','$date','$amount')";
			
			$result =  mysqli_query ($db_connect,$sql_insert);
			
			if(mysqli_error($db_connect)){
			 	die('Table Error:'.mysqli_error($db_connect));
			 }
			
			  return [
			 	'status' => 'success',
			 	'message' => 'Bank Invoice Successfully Added',
			 ];

	}

	function multi_invoice(){
		$db_connect = db_connect();
		$submitted_by = $_POST['submitted_by'];
		$reference = $_POST['reference'];
		$hotel = $_POST['hotel'];
		$invoice = $_POST['invoice'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$invs = [];
		for ($i = 2; $i <= 4; $i++) {
			if (!empty($_POST["invoice$i"])) {
				$invs["invoice$i"] = $_POST["invoice$i"];
				$invs["date$i"] = $_POST["date$i"]; 
				$invs["amount$i"] = $_POST["amount$i"];
			}
		}

		
		$error=[];
		if(empty($hotel) ){
			  $error['hotel'] = 'Hotel Name Is Required';
		}
		if(empty($invoice) ){
			  $error['invoice'] = 'Invoice Number Is Required';
		}
		if(empty($reference) ){
			  $error['reference'] = ' Reference Number Is Required';
		}
		if(empty($date) ){
			  $error['date'] = ' Invoice Date Is Required';
		}
		if(empty($amount) ){
			  $error['amount'] = ' Due Amount is Required';
		}
		
		if(!empty($invoice2) && empty($date2 )){
			$error['date2'] = 'Invoice Date Is Required';
	   }elseif(!empty($invoice2) && !empty($date2) && empty($amount2 )){
			$error['amount2'] = 'Due Amount is Required ';
	   }
	   if(!empty($invoice3) && empty($date3 )){
			$error['date3'] = 'Invoice Date Is Required';
		}elseif(!empty($invoice3) && !empty($date3) && empty($amount3 )){
			$error['amount3'] = 'Due Amount is Required ';
		}
		if(!empty($invoice4) && empty($date4 )){
			$error['date4'] = 'Invoice Date Is Required';
		}elseif(!empty($invoice4) && !empty($date4) && empty($amount4 )){
			$error['amount4'] = 'Due Amount is Required ';
		}

		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
		$sql_insert = "INSERT INTO bank_invoice (type,submitted_by,hotel,invoice, reference, date, amount";
		$sql_values = "VALUES ('multi','$submitted_by','$hotel','$invoice','$reference','$date','$amount'";

		foreach ($invs as $key => $value) {
			$sql_insert .= ", $key";
			$sql_values .= ", '$value'";
		}

		$sql_insert .= ")";
		$sql_values .= ")";

		$sql_query = $sql_insert . " " . $sql_values;

		
		// Execute SQL query
		$result = mysqli_query($db_connect, $sql_query);
			
			if(mysqli_error($db_connect)){
			 	die('Table Error:'.mysqli_error($db_connect));
			 }
			
			  return [
			 	'status' => 'success',
			 	'message' => 'Bank Invoice Successfully Added',
			 ];

			
	}

	function bank_invoice_view() {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM bank_invoice  ORDER BY id DESC LIMIT 10";
		$bank_invoice_results = mysqli_query($db_connect, $sql_view);
		if (!$bank_invoice_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $bank_invoice_results;
	}
	function all_reservation_view() {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM reservation";
		$reservation_results = mysqli_query($db_connect, $sql_view);
		if (!$reservation_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $reservation_results;
	}

	function bank_invoice_copy_view($id) {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM bank_invoice WHERE id = '$id'";
		$bank_invoice_copy_results = mysqli_query($db_connect, $sql_view);
		if (!$bank_invoice_copy_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		if(mysqli_num_rows($bank_invoice_copy_results) > 0) {
			return $bank_invoice_copy_results;
		} else {
			die('No data found for the provided ID.');
		}
	}
	function bank_invoice_delete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM bank_invoice WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_view);
		
		if(mysqli_num_rows($result) == 0){
			$error['data_delete'] = 'Unknown ID';
		}
		
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
		$sql_delete = "DELETE FROM bank_invoice WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Bank Invoice Successfully Deleted',
			];
		
	}

	function single_invoice_update(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$hotel = $_POST['hotel'];
		$invoice = $_POST['invoice'];
		$reference = $_POST['reference'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		
		$error=[];
		if(empty($hotel) ){
			$error['hotel'] = 'hotel Name Is Required';
		}
		if(empty($invoice) ){
			$error['invoice'] = 'Invoice Number Is Required';
		}
		if(empty($reference) ){
				$error['reference'] = ' Reference Number Is Required';
		}
		if(empty($date) ){
				$error['date'] = ' Invoice Date Is Required';
		}
		if(empty($amount) ){
				$error['amount'] = ' Due Amount is Required';
		}
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		} 
			
			$sql_update = "UPDATE bank_invoice set hotel='$hotel', invoice='$invoice', reference='$reference', date='$date',amount='$amount'   WHERE id= '$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Bank Invoice successfully Updated',
			];
	}

	function multi_invoice_update() {
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$hotel = $_POST['hotel'];
		$reference = $_POST['reference'];
		$invoice = $_POST['invoice'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$invs = [];
			for ($i = 2; $i <= 4; $i++) {
				if (!empty($_POST["invoice$i"])) {
					$invs["invoice$i"] = $_POST["invoice$i"];
					$invs["date$i"] = $_POST["date$i"]; 
					$invs["amount$i"] = $_POST["amount$i"];
				}
			}

		// Validation
		$error = [];
		if(empty($hotel) ){
			$error['hotel'] = 'Hotel Name Is Required';
		}
		if(empty($invoice) ){
			$error['invoice'] = 'Invoice Number Is Required';
		}
		if(empty($reference) ){
				$error['reference'] = ' Reference Number Is Required';
		}
		if(empty($date) ){
				$error['date'] = ' Invoice Date Is Required';
		}
		if(empty($amount) ){
				$error['amount'] = ' Due Amount is Required';
		}
		
		if(!empty($invoice2) && empty($date2 )){
			$error['date2'] = 'Invoice Date Is Required';
		}elseif(!empty($invoice2) && !empty($date2) && empty($amount2 )){
			$error['amount2'] = 'Due Amount is Required ';
		}
		if(!empty($invoice3) && empty($date3 )){
			$error['date3'] = 'Invoice Date Is Required';
		}elseif(!empty($invoice3) && !empty($date3) && empty($amount3 )){
			$error['amount3'] = 'Due Amount is Required ';
		}
		if(!empty($invoice4) && empty($date4 )){
			$error['date4'] = 'Invoice Date Is Required';
		}elseif(!empty($invoice4) && !empty($date4) && empty($amount4 )){
			$error['amount4'] = 'Due Amount is Required ';
		}

		if (count($error) > 0) {
			return [
				'status' => 'error',
				'message' => $error,
			];
		}

		// Check if the record exists
		$check_query = "SELECT * FROM bank_invoice WHERE id='$update_id'";
		$check_result = mysqli_query($db_connect, $check_query);

		if (mysqli_num_rows($check_result) == 0) {
			return [
				'status' => 'error',
				'message' => 'Record not found',
			];
		}

		// Build the UPDATE SQL query
		$sql_update = "UPDATE bank_invoice SET 
			hotel='" . mysqli_real_escape_string($db_connect, $hotel) . "', 
			invoice='" . mysqli_real_escape_string($db_connect, $invoice) . "', 
			reference='" . mysqli_real_escape_string($db_connect, $reference) . "', 
			date='" . mysqli_real_escape_string($db_connect, $date) . "', 
			amount='" . mysqli_real_escape_string($db_connect, $amount) . "'";

		foreach ($invs as $key => $value) {
			$sql_update .= ", $key='" . mysqli_real_escape_string($db_connect, $value) . "'";
		}

		$sql_update .= " WHERE id='" . mysqli_real_escape_string($db_connect, $update_id) . "'";

	

		$result = mysqli_query($db_connect, $sql_update);

		if (mysqli_error($db_connect)) {
			die('Table Error: ' . mysqli_error($db_connect));
		}

		return [
			'status' => 'update_success',
			'message' => 'Bank Invoice successfully updated',
		];
	}




	