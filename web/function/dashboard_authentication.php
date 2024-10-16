<?php
	require_once ('db_connection.php');

    function lifetime_reservaton(){
        $db_connect = db_connect();
		$sql_view = "SELECT COUNT(*) as total FROM reservation ";
		$lifetime_reservaton_results = mysqli_query($db_connect, $sql_view);
		if (!$lifetime_reservaton_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $lifetime_reservaton_results;
    }