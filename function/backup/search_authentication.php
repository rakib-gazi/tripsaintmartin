<?php
    require_once ('db_connection.php');

    function allSearch() {
        $db_connect = db_connect(); // Get database connection
    
        // Retrieve and escape query parameters
        $type = isset($_GET['type']) ? mysqli_real_escape_string($db_connect, $_GET['type']) : '';
        $start = isset($_GET['start']) ? mysqli_real_escape_string($db_connect, $_GET['start']) : '';
        $end = isset($_GET['end']) ? mysqli_real_escape_string($db_connect, $_GET['end']) : '';
    
        // Check if required parameters are provided
        if (empty($type) || empty($start) || empty($end)) {
            return null; // No results if any parameter is missing
        }
    
        // Construct the SQL query
        $sql_view = "SELECT * FROM `reservation` 
             WHERE STR_TO_DATE($type, '%d-%m-%Y') 
             BETWEEN STR_TO_DATE('$start', '%d-%m-%Y') AND STR_TO_DATE('$end', '%d-%m-%Y')";
    
        // Execute the query
        $allSearchResults = mysqli_query($db_connect, $sql_view);
    
        if (!$allSearchResults) {
            return null; // Return null on query failure
        }
    
        return $allSearchResults; // Return the search results
    }
    function hotelWiseSearch() {
        $db_connect = db_connect(); // Get database connection
    
        // Retrieve and escape query parameters
        $type = isset($_GET['type']) ? mysqli_real_escape_string($db_connect, $_GET['type']) : '';
        $hotel = isset($_GET['hotel']) ? mysqli_real_escape_string($db_connect, $_GET['hotel']) : '';
        $start = isset($_GET['start']) ? mysqli_real_escape_string($db_connect, $_GET['start']) : '';
        $end = isset($_GET['end']) ? mysqli_real_escape_string($db_connect, $_GET['end']) : '';
    
        // Check if required parameters are provided
        if (empty($type) || empty($hotel) || empty($start) || empty($end)) {
            return null; // No results if any parameter is missing
        }
    
        // Construct the SQL query
        $sql_view = "SELECT * FROM `reservation` WHERE hotel = '$hotel' AND `$type` BETWEEN '$start' AND '$end'";
    
        // Execute the query
        $hotelWiseSearchResults = mysqli_query($db_connect, $sql_view);
    
        if (!$hotelWiseSearchResults) {
            return null; // Return null on query failure
        }
    
        return $hotelWiseSearchResults; // Return the search results
    }
    
    function statusWiseSearch() {
        $db_connect = db_connect(); // Get database connection
    
        // Retrieve and escape query parameters
        $type = isset($_GET['type']) ? mysqli_real_escape_string($db_connect, $_GET['type']) : '';
        $start = isset($_GET['start']) ? mysqli_real_escape_string($db_connect, $_GET['start']) : '';
        $end = isset($_GET['end']) ? mysqli_real_escape_string($db_connect, $_GET['end']) : '';
    
        // Check if required parameters are provided
        if (empty($type)  || empty($start) || empty($end)) {
            return null; // No results if any parameter is missing
        }
    
        // Construct the SQL query
            $sql_view = "SELECT * FROM `reservation` WHERE  status = '$type' AND check_in BETWEEN '$start' AND '$end'";
        
    
        // Execute the query
        $statusWiseSearchResults = mysqli_query($db_connect, $sql_view);
    
        if (!$statusWiseSearchResults) {
            return null; // Return null on query failure
        }
    
        return $statusWiseSearchResults; // Return the search results
    }
    

    function current_year_view($starting_limit, $results_per_page) {
        $db_connect = db_connect();
        
        // Get the current year
        $currentYear = date('Y');
        
        // Define the start and end dates for the entire year in 'd-m-Y' format
        $startDate = "01-01-$currentYear"; // Start date: January 1st of the current year
        $endDate = "31-12-$currentYear";   // End date: December 31st of the current year
        
        // Convert dates to match DD-MM-YYYY format
        $startDateFormatted = date('d-m-Y', strtotime($startDate));
        $endDateFormatted = date('d-m-Y', strtotime($endDate));
        
        // Create SQL query to get reservations within the current year and order by check-in date
        $sql_view = "SELECT * FROM reservation 
                     WHERE STR_TO_DATE(check_in, '%d-%m-%Y') 
                     BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
                     ORDER BY STR_TO_DATE(check_in, '%d-%m-%Y') ASC LIMIT $starting_limit, $results_per_page";
        
        // Execute the query
        $reservation_results = mysqli_query($db_connect, $sql_view);
        
        if (!$reservation_results) {
            die('Query failed: ' . mysqli_error($db_connect));
        }
        
        return $reservation_results;
    }

    function previous_month_reservation_view() {
        $db_connect = db_connect();
    
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        // Calculate the previous month and adjust the year if necessary
        $previousMonth = $currentMonth - 1;
        $previousYear = $currentYear;
    
        // If the previous month is less than 1, it means we are in January, so set the previous month to December of the previous year
        if ($previousMonth < 1) {
            $previousMonth = 12;
            $previousYear -= 1;
        }
    
        // Calculate the start and end dates of the previous month in DD-MM-YYYY format
        $startDate = "01-$previousMonth-$previousYear";
        $endDate = date("t-$previousMonth-$previousYear"); // 't' gives the last day of the month
    
        // Convert dates to match DD-MM-YYYY format
        $startDateFormatted = date('d-m-Y', strtotime($startDate));
        $endDateFormatted = date('d-m-Y', strtotime($endDate));
    
        // Create SQL query to get reservations within the previous month and order by check_in date
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
    // function availableInvoicesSearch() {
    //     $db_connect = db_connect(); // Make sure you have the db_connect function properly defined
    
    //     // Get year and month from GET parameters
    //     $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
    //     $month = isset($_GET['month']) ? $_GET['month'] : date('m');
    
    //     // Prepare the start and end dates for the selected month
    //     $startDate = "01-$month-$year";
    //     $endDate = date("t-m-Y", strtotime($startDate)); // 't' gives the last day of the month
    
    //     // Convert dates to match the format for SQL query
    //     $startDateFormatted = date('d-m-Y', strtotime($startDate));
    //     $endDateFormatted = date('d-m-Y', strtotime($endDate));
    
    //     // SQL query to fetch hotel names with 'checked In' status for the selected month
    //     $sql_query = "SELECT *
    //                   FROM reservation 
    //                   WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
    //                   AND status = 'checked In' 
    //                   ORDER BY hotel ASC";
    
    //     // Execute the query
    //     $availableHotelINvoiceSearchresult = mysqli_query($db_connect, $sql_query);
    
    //     if (!$availableHotelINvoiceSearchresult) {
    //         die('Query failed: ' . mysqli_error($db_connect));
    //     }
    
    //     // Return the results
    //     return $availableHotelINvoiceSearchresult;
    // }
    // function availableInvoicesSearch() {
    //     $db_connect = db_connect(); // Ensure your db_connect function is properly defined
    
    //     // Get year, month, and hotel name from GET parameters
    //     $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
    //     $month = isset($_GET['month']) ? $_GET['month'] : date('m');
    //     $hotelName = isset($_GET['hotel']) ? mysqli_real_escape_string($db_connect, $_GET['hotel']) : '';
    
    //     // Prepare the start and end dates for the selected month
    //     $startDate = "01-$month-$year";
    //     $endDate = date("t-m-Y", strtotime($startDate)); // 't' gives the last day of the month
    
    //     // Convert dates to match the format for SQL query
    //     $startDateFormatted = date('d-m-Y', strtotime($startDate));
    //     $endDateFormatted = date('d-m-Y', strtotime($endDate));
    
    //     // SQL query to fetch hotel names with 'checked In' status for the selected month
    //     $sql_query = "SELECT * 
    //                   FROM reservation 
    //                   WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') 
    //                         AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
    //                         AND status = 'Checked In'";
    
    //     // If a hotel name is provided, add it to the query
    //     if ($hotelName) {
    //         $sql_query .= " AND hotel = '$hotelName'";
    //     }
    
    //     $sql_query .= " ORDER BY hotel ASC";
    
    //     // Execute the query
    //     $availableHotelINvoiceSearchresult = mysqli_query($db_connect, $sql_query);
    
    //     if (!$availableHotelINvoiceSearchresult) {
    //         die('Query failed: ' . mysqli_error($db_connect));
    //     }
    

    
    //     // Return the results
    //     return $availableHotelINvoiceSearchresult;
    // }
    
    function availableInvoicesSearch() {
        $db_connect = db_connect(); // Ensure your db_connect function is properly defined
    
        // Get year, month, and hotel name from GET parameters
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $hotelName = isset($_GET['hotel']) ? mysqli_real_escape_string($db_connect, $_GET['hotel']) : '';
    
        // Prepare the start and end dates for the selected month
        $startDate = "01-$month-$year";
        $endDate = date("t-m-Y", strtotime($startDate)); // 't' gives the last day of the month
    
        // Convert dates to match the format for SQL query
        $startDateFormatted = date('d-m-Y', strtotime($startDate));
        $endDateFormatted = date('d-m-Y', strtotime($endDate));
    
        // SQL query to fetch distinct hotel names with 'checked In' status for the selected month
        $sql_query = "SELECT hotel, COUNT(*) as total_reservations
                      FROM reservation 
                      WHERE STR_TO_DATE(check_in, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDateFormatted', '%d-%m-%Y') 
                            AND STR_TO_DATE('$endDateFormatted', '%d-%m-%Y')
                            AND status = 'Checked In'";
    
        // If a hotel name is provided, add it to the query
        if ($hotelName) {
            $sql_query .= " AND hotel = '$hotelName'";
        }
    
        // Group by hotel to ensure one row per hotel
        $sql_query .= " GROUP BY hotel ORDER BY hotel ASC";
    
        // Execute the query
        $availableHotelINvoiceSearchresult = mysqli_query($db_connect, $sql_query);
    
        if (!$availableHotelINvoiceSearchresult) {
            die('Query failed: ' . mysqli_error($db_connect));
        }
    
        // Return the results
        return $availableHotelINvoiceSearchresult;
    }
    
// Function to fetch reservations for a specific hotel
function getReservationsByHotelName($hotel) {
    $db_connect = db_connect(); // Ensure your db_connect function is properly defined

    // Prepare and execute the SQL query to fetch reservations for the specific hotel
    $sql_query = "SELECT * FROM reservation WHERE hotel = ? AND status = 'checked In'";
    $stmt = mysqli_prepare($db_connect, $sql_query);

    // Bind the hotel name parameter to the query
    mysqli_stmt_bind_param($stmt, 's', $hotel);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);



    return $result;
}
?>

    
    
