<?php 
    include('dashboard-header.php');
    include('../function/settings_authentication.php');
    include('../function/reservaton_authentication.php');

    $hotel_name_data = hotel_name_form_view();
    $currency_form_data = currency_form_view();
    $advance_currency_form_data = advance_currency_form_view();
    $source_form_data = source_form_view();
    $status_form_data = status_form_view();
    $payment_method_form_data = payment_method_form_view();
    $hotel_names = [];
    $currency_names = [];
    $advance_currency_names = [];
    $source_names = [];
    $status_names = [];
    $payment_method_names = [];
    if (mysqli_num_rows($hotel_name_data) > 0) {
        while ($hotel_name = mysqli_fetch_assoc($hotel_name_data)) {
            $hotel_names[] = $hotel_name['hotel_name'];
        }
    }
    if (mysqli_num_rows($currency_form_data) > 0) {
        while ($currency_name = mysqli_fetch_assoc($currency_form_data)) {
            $currency_names[] = $currency_name['currency'];
        }
    }
    if (mysqli_num_rows($advance_currency_form_data) > 0) {
        while ($advance_currency_name = mysqli_fetch_assoc($advance_currency_form_data)) {
            $advance_currency_names[] = $advance_currency_name['advance_currency'];
        }
    }
    if (mysqli_num_rows($source_form_data) > 0) {
        while ($source_name = mysqli_fetch_assoc($source_form_data)) {
            $source_names[] = $source_name['source'];
        }
    }
    if (mysqli_num_rows($status_form_data) > 0) {
        while ($status_name = mysqli_fetch_assoc($status_form_data)) {
            $status_names[] = $status_name['status'];
        }
    }
    if (mysqli_num_rows($payment_method_form_data) > 0) {
        while ($payment_method_name = mysqli_fetch_assoc($payment_method_form_data)) {
            $payment_method_names[] = $payment_method_name['payment'];
        }
    }

    if (isset($_POST['reservation_delete'])) {
        $result = reservation_delete();
        if ($result['status'] == 'error') {
            $errors = $result['message'];
        } else {
            $success = $result['message'];
            header('Refresh: 1; URL=all_reservation.php');
        }
    }

    if(isset($_POST['single_reservation_update'])){
		$old=$_POST;
		$result = single_reservation_update();
		if($result['status'] == 'error'){
			$error = $result['message'];
		}else{
			$update_success = $result['message'];
            
            header('Refresh: 1; URL=all_reservation.php');
		}
	}elseif(isset($_POST['multi_reservation_update'])){
		$old=$_POST;
		$result = multi_reservation_update();
		if($result['status'] == 'error'){
			$error = $result['message'];
		}else{
			$update_success = $result['message'];
            
            header('Refresh: 1; URL=all_reservation.php');
		}
	}
    
    if(isset($_POST['single_reservation_status'])){
		$old=$_POST;
		$result = single_reservation_status();
	}elseif(isset($_POST['multi_reservation_status'])){
		$old=$_POST;
		$result = multi_reservation_status();
	}
    if(isset($_POST['single_reservation_comment'])){
		$old=$_POST;
		$result = single_reservation_comment();
	}elseif(isset($_POST['multi_reservation_comment'])){
		$old=$_POST;
		$result = multi_reservation_comment();
	}
    
    $all_reservation_data = all_reservation_view();
    

    $note_icons = [ 'fa-solid fa-database','fa-solid  fa-hotel', 'fa-regular fa-circle-check','fa-solid fa-arrow-left',];
    $heading = ['All','Hotel', 'Status','Previous Month',];
    $nlinks = ['allReservationsWise.php','allReservationsHotelWise.php','allReservationsStatusWise.php','previous_reservation.php',]
?>

<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-24">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold  font-serif capitalize">All Reservation</h1>
            <div class="flex justify-center items-center gap-x-2">
                <a href="reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Reservation
                </a>
            </div>
        </div>
            <hr class="border border-black">  
            <div class="grid grid-cols-4 gap-4 mt-12 ps-12">
                <?php
                    foreach ($note_icons as $index => $note_icon) {
                        $hline = $heading[$index];
                        $nlink = $nlinks[$index];
                    ?> 
                    <a href="<?php echo $nlink; ?>" class="rounded-3xl overflow-hidden shadow-xl bg-white group hover:bg-cyan-950 transition duration-700 ease-in-out">
                        <div class="flex flex-col justify-center items-center  py-12 gap-y-2 group-hover:text-white">
                            <i class="<?php echo $note_icon; ?> text-4xl text-amber-700 group-hover:text-white"></i>
                            <h2 class="font-bold text-xl  group-hover:text-white"><?php echo $hline; ?></h2>
                        </div>
                    </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>



<?php include('dashboard-footer.php'); ?>
