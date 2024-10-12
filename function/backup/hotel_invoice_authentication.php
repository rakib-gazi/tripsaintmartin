<?php

    require_once ('db_connection.php');

    
    // function createHotelInvoice($hotel, $month, $year) {
    //     // Establish database connection
    //     $db_connect = db_connect();
    
    //     if (!$db_connect) {
    //         return ['status' => 'error', 'message' => 'Database connection failed.'];
    //     }
    
    //     // Convert month and year to start and end date for the query
    //     $startDateFormatted = "01-$month-$year"; // First day of the month
    //     $endDateFormatted = date("t-m-Y", strtotime($startDateFormatted)); // Last day of the month
    
    //     // SQL query to fetch reservations
    //     $sql_view = "SELECT * 
    //                  FROM reservation 
    //                  WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') 
    //                        AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
    //                        AND status = 'Checked In'";
    
    //     // Execute the SQL query
    //     $result = mysqli_query($db_connect, $sql_view);
    
    //     if (!$result) {
    //         return ['status' => 'error', 'message' => 'Error executing query: ' . mysqli_error($db_connect)];
    //     }
    
    //     // Check if any rows were returned
    //     if (mysqli_num_rows($result) > 0) {
    //         $reservations = [];
    
    //         // Fetch all rows
    //         while ($row = mysqli_fetch_assoc($result)) {

    //             $reservations[] = [
    //                 'reservation_no' => $row['reservation_number'],
    //                 'check_in' => $row['check_in'],
    //                 'check_out' => $row['check_out'],
    //                 'guest' => $row['guest'],
    //                 'room' => $row['room'] ?? 'Multiple Type Room',
    //                 'price' => $row['price'],
    //                 'status' => $row['status'],
    //             ];
    //         }
    
    //         // Combine the reservation data into JSON format
    //         $combinedData = json_encode($reservations);
    
    //         // SQL query to insert combined data into invoices table
    //         $sql_insert = "INSERT INTO invoices (hotel, month, year, reservation_data) VALUES (?, ?, ?, ?)";
    //         $stmt = $db_connect->prepare($sql_insert);
    
    //         if (!$stmt) {
    //             return ['status' => 'error', 'message' => 'SQL error: ' . $db_connect->error];
    //         }
    
    //         // Bind parameters for the prepared statement
    //         $stmt->bind_param('ssss', $hotel, $month, $year, $combinedData);
    
    //         // Execute the insert statement
    //         if ($stmt->execute()) {
    //             return ['status' => 'success', 'message' => 'Invoice created successfully!'];
    //         } else {
    //             return ['status' => 'error', 'message' => 'Error creating invoice: ' . $stmt->error];
    //         }
    //     } else {
    //         return ['status' => 'error', 'message' => 'No check-in reservations found for the selected hotel and month.'];
    //     }
    // }

    function createHotelInvoice($hotel, $month, $year) {
        // Establish database connection
        $db_connect = db_connect();
    
        if (!$db_connect) {
            return ['status' => 'error', 'message' => 'Database connection failed.'];
        }
    
        // Convert month and year to start and end date for the query
        $startDateFormatted = "01-$month-$year"; // First day of the month
        $endDateFormatted = date("t-m-Y", strtotime($startDateFormatted)); // Last day of the month
    
        // SQL query to fetch reservations
        $sql_view = "SELECT * 
                     FROM reservation 
                     WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') 
                           AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
                           AND status = 'Checked In'
                           AND hotel = '$hotel'";
    
        // Execute the SQL query
        $result = mysqli_query($db_connect, $sql_view);
        if (!$result) {
            return ['status' => 'error', 'message' => 'Error executing query: ' . mysqli_error($db_connect)];
        }
    
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $reservations = [];
    
            // Fetch all rows
            while ($row = mysqli_fetch_assoc($result)) {
                $reservations[] = [
                    'reservation_no' => $row['reservation_number'],
                    'check_in' => $row['check_in'],
                    'check_out' => $row['check_out'],
                    'guest' => $row['guest'],
                    'room' => $row['room'] ?? 'Multiple Type Room',
                    'price' => $row['price'],
                    'status' => $row['status'],
                ];
            }
           
            // Combine the reservation data into JSON format
            $combinedData = json_encode($reservations);
            
            // Check if an invoice already exists for the same hotel, month, and year
            $sql_check = "SELECT id FROM invoices WHERE hotel = ? AND month = ? AND year = ?";
            $stmt_check = $db_connect->prepare($sql_check);
    
            if (!$stmt_check) {
                return ['status' => 'error', 'message' => 'SQL error: ' . $db_connect->error];
            }
    
            // Bind parameters and execute the query to check if the invoice exists
            $stmt_check->bind_param('sss', $hotel, $month, $year);
            $stmt_check->execute();
            $stmt_check->store_result();
    
            if ($stmt_check->num_rows > 0) {
                // If an invoice exists, perform an update
                $sql_update = "UPDATE invoices SET reservation_data = ? WHERE hotel = ? AND month = ? AND year = ?";
                $stmt_update = $db_connect->prepare($sql_update);
    
                if (!$stmt_update) {
                    return ['status' => 'error', 'message' => 'SQL error: ' . $db_connect->error];
                }
    
                // Bind parameters and execute the update statement
                $stmt_update->bind_param('ssss', $combinedData, $hotel, $month, $year);
    
                if ($stmt_update->execute()) {
                    return ['status' => 'success', 'message' => 'Invoice updated successfully!'];
                } else {
                    return ['status' => 'error', 'message' => 'Error updating invoice: ' . $stmt_update->error];
                }
            } else {
                // If no invoice exists, perform an insert
                $sql_insert = "INSERT INTO invoices (hotel, month, year, reservation_data) VALUES (?, ?, ?, ?)";
                $stmt_insert = $db_connect->prepare($sql_insert);
    
                if (!$stmt_insert) {
                    return ['status' => 'error', 'message' => 'SQL error: ' . $db_connect->error];
                }
    
                // Bind parameters for the prepared statement
                $stmt_insert->bind_param('ssss', $hotel, $month, $year, $combinedData);
    
                // Execute the insert statement
                if ($stmt_insert->execute()) {
                    return ['status' => 'success', 'message' => 'Invoice created successfully!'];
                } else {
                    return ['status' => 'error', 'message' => 'Error creating invoice: ' . $stmt_insert->error];
                }
            }
        } else {
            return ['status' => 'error', 'message' => 'No check-in reservations found for the selected hotel and month.'];
        }
    }
    

    function allInvoiceView() {
        $db_connect = db_connect();
        $sql_view=  "SELECT * FROM invoices";
        $allInvoiceViewResult = mysqli_query( $db_connect,  $sql_view);
        if (!$allInvoiceViewResult) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $allInvoiceViewResult;
    }

    

    
    
