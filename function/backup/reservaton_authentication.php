<?php
	require_once ('db_connection.php');
// Single reservation
	function single_reservation(){
		$db_connect = db_connect();
		$submitted_by = $_POST['submitted_by'];
		$reservation_number = $_POST['reservation_number'];
		$check_in = $_POST['check_in'];
		$check_out = $_POST['check_out'];
		$booking_date = $_POST['booking_date'];
		$hotel =  mysqli_real_escape_string($db_connect, $_POST['hotel']);
		$guest = $_POST['guest'];
		$room = $_POST['room'];
		$total_room = $_POST['total_room'];
		$night = $_POST['night'];
		$price = $_POST['price'];
		$currency = $_POST['currency']?? null;
		$rate = $_POST['rate'];
		$advance = $_POST['advance'];
		$advance_currency = $_POST['advance_currency']?? null;
		$source = $_POST['source']?? null;
		$payment_method = $_POST['payment_method']?? null;
		$phone = $_POST['phone'];
		$comment = mysqli_real_escape_string($db_connect, $_POST['comment']);
		
		
		$error=[];
		if(empty($reservation_number) ){
			  $error['reservation_number'] = 'Reservation Number Required';
		}
		if(empty($check_in) ){
			  $error['check_in'] = ' Check In Date Required';
		}
		if(empty($check_out) ){
			  $error['check_out'] = ' Check Out Date Required';
		}
		if(empty($booking_date) ){
			  $error['booking_date'] = ' Booking Date Required';
		}
		if(empty($hotel) ){
			  $error['hotel'] = ' Hotel Name Required';
		}
		if(empty($guest) ){
			  $error['guest'] = ' Guest Name Required';
		}
		if(empty($room) ){
			  $error['room'] = ' Room Name Required';
		}
		if(empty($total_room) ){
			 $error['total_room'] = 'Total Room Required';
		}elseif(strlen($total_room) >2){
			$error['total_room'] = 'Invalid Room';
		}
		if(empty($night) ){
			 $error['night'] = 'Total Night Required';
		}elseif(strlen($night) >2){
			$error['night'] = 'Invalid Night';
		}
		if(empty($price)){
			 $error['price'] = 'Total Price Required';
		}
		if(empty($currency)){
			$error['currency'] = 'Payment Currency Required';
		}
		if(empty($rate) ){
			 $error['rate'] = 'Exchange Rate Required';
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
		if(empty($phone)){
				$error['phone'] = 'Phone Number Or Email Is Required';
		}
		
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
			 $sql_insert = "INSERT INTO reservation(type,submitted_by,reservation_number, check_in, check_out, booking_date, hotel, guest,room, total_room, night, price, currency, rate, advance,advance_currency, source, payment_method, phone, comment) VALUES ('single','$submitted_by','$reservation_number','$check_in','$check_out','$booking_date','$hotel','$guest','$room','$total_room','$night','$price','$currency','$rate','$advance','$advance_currency','$source','$payment_method','$phone','$comment')";
			
			$result =  mysqli_query ($db_connect,$sql_insert);
			
			if(mysqli_error($db_connect)){
			 	die('Table Error:'.mysqli_error($db_connect));
			 }
			
			  return [
			 	'status' => 'success',
			 	'message' => 'Reservation Added Success',
			 ];

			
	}

	function multi_reservation(){
		$db_connect = db_connect();
		$submitted_by = $_POST['submitted_by'];
		$reservation_number = $_POST['reservation_number'];
		$check_in = $_POST['check_in'];
		$check_out = $_POST['check_out'];
		$booking_date = $_POST['booking_date'];
		$hotel = $_POST['hotel'];
		$guest = $_POST['guest'];
		$total_room = $_POST['total_room'];
		$night = $_POST['night'];
		$price = $_POST['price'];
		$currency = $_POST['currency']?? null;
		$rate = $_POST['rate'];
		$advance = $_POST['advance'];
		$advance_currency = $_POST['advance_currency']?? null;
		$source = $_POST['source']?? null;
		$payment_method = $_POST['payment_method']?? null;
		$phone = $_POST['phone'];
		$comment = $_POST['comment'];
		// multi type room
		$rooms = [];
		for ($i = 1; $i <= 10; $i++) {
			if (!empty($_POST["room_$i"])) {
				$rooms["room_$i"] = $_POST["room_$i"];
				$rooms["total_{$i}_room"] = $_POST["total_{$i}_room"]; // corrected from $i_room to $i
				$rooms["night_$i"] = $_POST["night_$i"];
				$rooms["room_{$i}_price"] = $_POST["room_{$i}_price"];
			}
		}

		
		$error=[];
		if(empty($reservation_number) ){
			  $error['reservation_number'] = 'Reservation Number Required';
		}
		if(empty($check_in) ){
			  $error['check_in'] = ' Check In Date Required';
		}
		if(empty($check_out) ){
			  $error['check_out'] = ' Check Out Date Required';
		}
		if(empty($booking_date) ){
			  $error['booking_date'] = ' Booking Date Required';
		}
		if(empty($hotel) ){
			  $error['hotel'] = ' Hotel Name Required';
		}
		if(empty($guest) ){
			  $error['guest'] = ' Guest Name Required';
		}
		if(empty($total_room) ){
			 $error['total_room'] = 'Total Room Required';
		}elseif(strlen($total_room) >2){
			$error['total_room'] = 'Invalid Room';
		}
		if(empty($night) ){
			 $error['night'] = 'Total Night Required';
		}elseif(strlen($night) >2){
			$error['night'] = 'Invalid Night';
		}
		if(empty($price)){
			 $error['price'] = 'Total Price Required';
		}
		if(empty($currency)){
			$error['currency'] = 'Payment Currency Required';
		}
		if(empty($rate) ){
			 $error['rate'] = 'Exchange Rate Required';
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
		if(empty($phone)){
				$error['phone'] = 'Phone Number Or Email Is Required';
		}
		if(!empty($room_1) && empty($total_1_room )){
			$error['total_1_room'] = 'Total room Is Required';
	   }elseif(!empty($room_1) && !empty($total_1_room) && empty($night_1 )){
			$error['night_1'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_1) && !empty($total_1_room) && !empty($night_1 ) && empty($room_1_price)){
		$error['room_1_price'] = 'Room 1 Price Is Required ';
   		}

		if(!empty($room_2) && empty($total_2_room )){
			$error['total_2_room'] = 'Total room Is Required';
	   }elseif(!empty($room_2) && !empty($total_2_room) && empty($night_2 )){
			$error['night_2'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_2) && !empty($total_2_room) && !empty($night_2 ) && empty($room_2_price)){
		$error['room_2_price'] = 'Room 2 Price Is Required ';
   		}
		if(!empty($room_3) && empty($total_3_room )){
			$error['total_3_room'] = 'Total room Is Required';
	   }elseif(!empty($room_3) && !empty($total_3_room) && empty($night_3 )){
			$error['night_3'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_3) && !empty($total_3_room) && !empty($night_3 ) && empty($room_3_price)){
		$error['room_3_price'] = 'Room 3 Price Is Required ';
   		}
		if(!empty($room_4) && empty($total_4_room )){
			$error['total_4_room'] = 'Total room Is Required';
	   }elseif(!empty($room_4) && !empty($total_4_room) && empty($night_4 )){
			$error['night_4'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_4) && !empty($total_4_room) && !empty($night_4 ) && empty($room_4_price)){
		$error['room_4_price'] = 'Room 4 Price Is Required ';
   		}
		if(!empty($room_5) && empty($total_5_room )){
			$error['total_5_room'] = 'Total room Is Required';
	   }elseif(!empty($room_5) && !empty($total_5_room) && empty($night_5 )){
			$error['night_5'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_5) && !empty($total_5_room) && !empty($night_5 ) && empty($room_5_price)){
		$error['room_5_price'] = 'Room 5 Price Is Required ';
   		}
		
		if(!empty($room_6) && empty($total_6_room )){
			$error['total_6_room'] = 'Total room Is Required';
	   }elseif(!empty($room_6) && !empty($total_6_room) && empty($night_6 )){
			$error['night_6'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_6) && !empty($total_6_room) && !empty($night_6 ) && empty($room_6_price)){
		$error['room_6_price'] = 'Room 6 Price Is Required ';
   		}
		
		if(!empty($room_7) && empty($total_7_room )){
			$error['total_7_room'] = 'Total room Is Required';
	   }elseif(!empty($room_7) && !empty($total_7_room) && empty($night_7 )){
			$error['night_7'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_7) && !empty($total_7_room) && !empty($night_7 ) && empty($room_7_price)){
		$error['room_7_price'] = 'Room 7 Price Is Required ';
   		}
		
		
		if(!empty($room_8) && empty($total_8_room )){
			$error['total_8_room'] = 'Total room Is Required';
	   }elseif(!empty($room_8) && !empty($total_8_room) && empty($night_8 )){
			$error['night_8'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_8) && !empty($total_8_room) && !empty($night_8 ) && empty($room_8_price)){
		$error['room_8_price'] = 'Room 8 Price Is Required ';
   		}
		
		if(!empty($room_9) && empty($total_9_room )){
			$error['total_9_room'] = 'Total room Is Required';
	   }elseif(!empty($room_9) && !empty($total_9_room) && empty($night_9 )){
			$error['night_9'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_9) && !empty($total_9_room) && !empty($night_9 ) && empty($room_9_price)){
		$error['room_9_price'] = 'Room 9 Price Is Required ';
   		}
		
		if(!empty($room_10) && empty($total_10_room )){
			$error['total_10_room'] = 'Total room Is Required';
	   }elseif(!empty($room_10) && !empty($total_10_room) && empty($night_10 )){
			$error['night_10'] = 'Total Nights Is Required ';
	   }elseif(!empty($room_10) && !empty($total_10_room) && !empty($night_10 ) && empty($room_10_price)){
		$error['room_10_price'] = 'Room 10 Price Is Required ';
   		}
		
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
		$sql_insert = "INSERT INTO reservation (type,submitted_by,reservation_number, check_in, check_out, booking_date, hotel, guest, total_room, night, price, currency, rate, advance, advance_currency, source, payment_method, phone, comment";
		$sql_values = "VALUES ('multi','$submitted_by','$reservation_number', '$check_in', '$check_out', '$booking_date', '$hotel', '$guest', '$total_room', '$night', '$price', '$currency', '$rate', '$advance', '$advance_currency', '$source', '$payment_method', '$phone', '$comment'";

		foreach ($rooms as $key => $value) {
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
			 	'message' => 'Reservation Added Success',
			 ];

			
	}

	function reservation_view() {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM reservation  ORDER BY id DESC LIMIT 2";
		$reservation_results = mysqli_query($db_connect, $sql_view);
		if (!$reservation_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $reservation_results;
	}
	function current_reservation_view() {
		$db_connect = db_connect();

		// Get the current year and month
		$currentYear = date('Y');
		$currentMonth = date('m');
		$currentMonthName = date('M'); // Short month name (e.g., Aug for August)
	
		// Calculate the start and end dates of the current month in DD-MM-YYYY format
		$startDate = "01-$currentMonth-$currentYear";
		$endDate = date("t-$currentMonth-$currentYear"); // 't' gives the last day of the month
	
		// Convert dates to match DD-MM-YYYY format
		$startDateFormatted = date('d-m-Y', strtotime($startDate));
		$endDateFormatted = date('d-m-Y', strtotime($endDate));
	
		// Create SQL query to get reservations within the current month and order by check_in date
		$sql_view = "SELECT * FROM reservation 
					 WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
					 ORDER BY STR_TO_DATE(check_in, '%d-%m-%Y') ASC"; // Sorting by check_in date in ascending order
	
		// Execute the query
		$reservation_results = mysqli_query($db_connect, $sql_view);
	
		if (!$reservation_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
	
		return $reservation_results;
		
		
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

	function reservation_copy_view($id) {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM reservation WHERE id = '$id'";
		$reservation_copy_results = mysqli_query($db_connect, $sql_view);
		if (!$reservation_copy_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		if(mysqli_num_rows($reservation_copy_results) > 0) {
			return $reservation_copy_results;
		} else {
			die('No data found for the provided ID.');
		}
	}
	function reservation_delete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$errors=[];
		$sql_view = "SELECT * FROM reservation WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_view);
		
		if(mysqli_num_rows($result) == 0){
			$errors['data_delete'] = 'Unknown ID';
		}
		
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors,
			 ];
		}
		$sql_delete = "DELETE FROM reservation WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Reservation Information Delete Successfull.',
			];
		
	}


	function single_reservation_update(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$reservation_number = $_POST['reservation_number'];
		$check_in = $_POST['check_in'];
		$check_out = $_POST['check_out'];
		$booking_date = $_POST['booking_date'];
		$hotel = mysqli_real_escape_string($db_connect,$_POST['hotel']);
		$guest = $_POST['guest'];
		$room = $_POST['room'];
		$total_room = $_POST['total_room'];
		$night = $_POST['night'];
		$price = $_POST['price'];
		$currency = $_POST['currency']?? null;
		$rate = $_POST['rate'];
		$advance = $_POST['advance'];
		$advance_currency = $_POST['advance_currency']?? null;
		$source = $_POST['source']?? null;
		$payment_method = $_POST['payment_method']?? null;
		$phone = $_POST['phone'];
		$comment = mysqli_real_escape_string($db_connect,$_POST['comment']);
		
		$error=[];
		if(empty($reservation_number) ){
			  $error['reservation_number'] = 'Reservation Number Required';
		}
		if(empty($check_in) ){
			  $error['check_in'] = ' Check In Date Required';
		}
		if(empty($check_out) ){
			  $error['check_out'] = ' Check Out Date Required';
		}
		if(empty($booking_date) ){
			  $error['booking_date'] = ' Booking Date Required';
		}
		if(empty($hotel) ){
			  $error['hotel'] = ' Hotel Name Required';
		}
		if(empty($guest) ){
			  $error['guest'] = ' Guest Name Required';
		}
		if(empty($room) ){
			  $error['room'] = ' Room Name Required';
		}
		if(empty($total_room) ){
			 $error['total_room'] = 'Total Room Required';
		}elseif(strlen($total_room) >2){
			$error['total_room'] = 'Invalid Room';
		}
		if(empty($night) ){
			 $error['night'] = 'Total Night Required';
		}elseif(strlen($night) >2){
			$error['night'] = 'Invalid Night';
		}
		if(empty($price)){
			 $error['price'] = 'Total Price Required';
		}
		if(empty($currency)){
			$error['currency'] = 'Payment Currency Required';
		}
		if(empty($rate) ){
			 $error['rate'] = 'Exchange Rate Required';
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
		if(empty($phone)){
				$error['phone'] = 'Phone Number Or Email Is Required';
		}
		if(!empty($room_2) && empty($room_2_price )){
			$error['room_2_price'] = 'Room 2 price Is  Required';
	   }
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		} 
			
			$sql_update = "UPDATE reservation set reservation_number='$reservation_number', check_in='$check_in',check_out='$check_out' , booking_date='$booking_date',hotel='$hotel', 
			guest='$guest', room='$room',total_room='$total_room' , night='$night',price='$price',currency='$currency', rate='$rate',advance='$advance' , advance_currency='$advance_currency',source='$source',  
			payment_method='$payment_method',phone='$phone',comment='$comment'  WHERE id= '$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Reservation successfully Updated',
			];
	}
	function single_reservation_status(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$status = $_POST['status'];

			$sql_update = "UPDATE reservation set  status='$status'  WHERE id= '$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
	}
	function single_reservation_comment(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$admin_comment = $_POST['admin_comment'];

			$sql_update = "UPDATE reservation set  admin_comment='$admin_comment'  WHERE id= '$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
	}




function multi_reservation_update() {
    $db_connect = db_connect();
    
    // Retrieve POST data
    $update_id = $_POST['update_id'];
    $reservation_number = $_POST['reservation_number'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $booking_date = $_POST['booking_date'];
    $hotel = $_POST['hotel'];
    $guest = $_POST['guest'];
    $total_room = $_POST['total_room'];
    $night = $_POST['night'];
    $price = $_POST['price'];
    $currency = $_POST['currency'] ?? null;
    $rate = $_POST['rate'];
    $advance = $_POST['advance'];
    $advance_currency = $_POST['advance_currency'] ?? null;
    $source = $_POST['source'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    // Gather room data
    $rooms = [];
    for ($i = 1; $i <= 10; $i++) {
        if (!empty($_POST["room_$i"])) {
            $rooms["room_$i"] = $_POST["room_$i"];
            $rooms["total_{$i}_room"] = $_POST["total_{$i}_room"];
            $rooms["night_$i"] = $_POST["night_$i"];
            $rooms["room_{$i}_price"] = $_POST["room_{$i}_price"];
        }
    }

    // Validation
    $error = [];
    if (empty($reservation_number)) $error['reservation_number'] = 'Reservation Number Required';
    if (empty($check_in)) $error['check_in'] = 'Check In Date Required';
    if (empty($check_out)) $error['check_out'] = 'Check Out Date Required';
    if (empty($booking_date)) $error['booking_date'] = 'Booking Date Required';
    if (empty($hotel)) $error['hotel'] = 'Hotel Name Required';
    if (empty($guest)) $error['guest'] = 'Guest Name Required';
    if (empty($total_room)) $error['total_room'] = 'Total Room Required';
    elseif (strlen($total_room) > 2) $error['total_room'] = 'Invalid Room';
    if (empty($night)) $error['night'] = 'Total Night Required';
    elseif (strlen($night) > 2) $error['night'] = 'Invalid Night';
    if (empty($price)) $error['price'] = 'Total Price Required';
    if (empty($currency)) $error['currency'] = 'Payment Currency Required';
    if (empty($rate)) $error['rate'] = 'Exchange Rate Required';
    if (!empty($advance) && empty($advance_currency)) $error['advance_currency'] = 'Advance Currency Required';
    if (empty($source)) $error['source'] = 'Reservation Source Required';
    if (empty($payment_method)) $error['payment_method'] = 'Payment Method Required';
    if (empty($phone)) $error['phone'] = 'Phone Number Or Email Is Required';
    if (!empty($_POST['room_2']) && empty($_POST['room_2_price'])) $error['room_2_price'] = 'Room 2 Price Is Required';

    if (count($error) > 0) {
        return [
            'status' => 'error',
            'message' => $error,
        ];
    }

    // Check if the record exists
    $check_query = "SELECT * FROM reservation WHERE id='$update_id'";
    $check_result = mysqli_query($db_connect, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        return [
            'status' => 'error',
            'message' => 'Record not found',
        ];
    }

    // Build the UPDATE SQL query
    $sql_update = "UPDATE reservation SET 
        reservation_number='" . mysqli_real_escape_string($db_connect, $reservation_number) . "',  
        check_in='" . mysqli_real_escape_string($db_connect, $check_in) . "', 
        check_out='" . mysqli_real_escape_string($db_connect, $check_out) . "', 
        booking_date='" . mysqli_real_escape_string($db_connect, $booking_date) . "', 
        hotel='" . mysqli_real_escape_string($db_connect, $hotel) . "', 
        guest='" . mysqli_real_escape_string($db_connect, $guest) . "', 
        total_room='" . mysqli_real_escape_string($db_connect, $total_room) . "', 
        night='" . mysqli_real_escape_string($db_connect, $night) . "', 
        price='" . mysqli_real_escape_string($db_connect, $price) . "', 
        currency='" . mysqli_real_escape_string($db_connect, $currency) . "', 
        rate='" . mysqli_real_escape_string($db_connect, $rate) . "', 
        advance='" . mysqli_real_escape_string($db_connect, $advance) . "', 
        advance_currency='" . mysqli_real_escape_string($db_connect, $advance_currency) . "', 
        source='" . mysqli_real_escape_string($db_connect, $source) . "', 
        payment_method='" . mysqli_real_escape_string($db_connect, $payment_method) . "', 
        phone='" . mysqli_real_escape_string($db_connect, $phone) . "', 
        comment='" . mysqli_real_escape_string($db_connect, $comment) . "'";

    foreach ($rooms as $key => $value) {
        $sql_update .= ", $key='" . mysqli_real_escape_string($db_connect, $value) . "'";
    }

    $sql_update .= " WHERE id='" . mysqli_real_escape_string($db_connect, $update_id) . "'";

  

    $result = mysqli_query($db_connect, $sql_update);

    if (mysqli_error($db_connect)) {
        die('Table Error: ' . mysqli_error($db_connect));
    }

    return [
        'status' => 'update_success',
        'message' => 'Reservation successfully updated',
    ];
}
function multi_reservation_status() {
    $db_connect = db_connect();
    
    // Retrieve POST data
    $update_id = $_POST['update_id'];
	$status = $_POST['status'];
    
    // Check if the record exists
    $check_query = "SELECT * FROM reservation WHERE id='$update_id'";
    $check_result = mysqli_query($db_connect, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        return [
            'status' => 'error',
            'message' => 'Record not found',
        ];
    }

    // Build the UPDATE SQL query
    $sql_update = "UPDATE reservation SET 
        status='" . mysqli_real_escape_string($db_connect, $status) . "'";

    $sql_update .= " WHERE id='" . mysqli_real_escape_string($db_connect, $update_id) . "'";

  

    $result = mysqli_query($db_connect, $sql_update);

    if (mysqli_error($db_connect)) {
        die('Table Error: ' . mysqli_error($db_connect));
    }

}
function multi_reservation_comment() {
    $db_connect = db_connect();
    
    // Retrieve POST data
    $update_id = $_POST['update_id'];
	$admin_comment = $_POST['admin_comment'];
    
    // Check if the record exists
    $check_query = "SELECT * FROM reservation WHERE id='$update_id'";
    $check_result = mysqli_query($db_connect, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        return [
            'status' => 'error',
            'message' => 'Record not found',
        ];
    }

    // Build the UPDATE SQL query
    $sql_update = "UPDATE reservation SET 
        admin_comment='" . mysqli_real_escape_string($db_connect, $admin_comment) . "'";

    $sql_update .= " WHERE id='" . mysqli_real_escape_string($db_connect, $update_id) . "'";

  

    $result = mysqli_query($db_connect, $sql_update);

    if (mysqli_error($db_connect)) {
        die('Table Error: ' . mysqli_error($db_connect));
    }

}



	