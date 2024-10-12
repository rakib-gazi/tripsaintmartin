<?php 
    include('dashboard-header.php');
    include('../function/settings_authentication.php');
    include('../function/reservaton_authentication.php');
    include('../function/hotel_invoice_authentication.php');

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
    
    $all_Invoice_data = allInvoiceView();
    $all_Invoice_data2 = allInvoiceView();

    $currentMonth = date('F'); 
    $reservationItem = $currentMonth . " Reservations";
    
?>

<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-24">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold  font-serif capitalize">All Hotel Invoices</h1>
            <div class="flex justify-center items-center gap-x-2">
                <a href="reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Reservation
                </a>
            </div>
        </div>
        <hr class="border border-black">  
            <h5 class=" text-xl font-bold font-mono text-blue-900 py-px ">
                <?php 
                    echo $update_success ?? '';
                ?>
            </h5>
            <div class="flex flex-col mt-2">
                <div class="-m-1.5 ">
                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="border border-cyan-950 rounded-lg overflow-hidden">
                            <table class="w-full ">
                                <thead class="bg-cyan-950">
                                    <tr>
                                        <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                        <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">hotel</th>
                                        <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Year</th>
                                        <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Month</th>
                                        <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cyan-950 ">
                                    
                                        <?php 
                                            if(mysqli_num_rows($all_Invoice_data)>0){
                                                $i=1;
                                                while($row = mysqli_fetch_assoc($all_Invoice_data)){
                                                    $months = [
                                                        "01" => "January",
                                                        "02" => "February",
                                                        "03" => "March",
                                                        "04" => "April",
                                                        "05" => "May",
                                                        "06" => "June",
                                                        "07" => "July",
                                                        "08" => "August",
                                                        "09" => "September",
                                                        "10" => "October",
                                                        "11" => "November",
                                                        "12" => "December"
                                                    ];
                                                    $monthResults= $months[$row['month']] ?? "";
                                                    $modaltitle =$monthResults.' '.$row['year'].' '.'Invoice For '.$row['hotel'];
                                                    $reservationData = json_decode($row['reservation_data'], true);
                                        ?>
                                        <tr class="border border-cyan-950">
                                            <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                            <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['hotel'];?></td>
                                            <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['year'];?></td>
                                            <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['month'];?></td>
                                            <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">
                                                <?php include "allhotelInvoiceView.php";?></td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                       
            <!-- <?php 
                // if(mysqli_num_rows($all_Invoice_data2)>0){
                //     $i=1;
                //     while($row = mysqli_fetch_assoc($all_Invoice_data2)){
                //         $reservationData = json_decode($row['reservation_data'], true);
                ?>
                    <div class="flex justify-between items-center">
                        <p class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php //echo $row['hotel']?></p>
                        <p class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php //echo $row['month']?></p>
                        <p class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php //echo $row['year']?></p>


                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-animation-modal" data-hs-overlay="#hs-scale-animation-modal">
                        Open modal
                        </button>

                        <div id="hs-scale-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
                            <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
                                <div class="flex justify-between items-center py-3 px-4 border-b ">
                                    <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 ">
                                    Modal title
                                    </h3>
                                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                    </button>
                                </div>
                                <div class="p-4 overflow-y-auto">
                                <?php 
                                        //if ($reservationData) { ?>
                                            <div class="flex flex-col mt-2">
                                                <div class="-m-1.5">
                                                    <div class="p-1.5 w-full inline-block align-middle">
                                                        <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                                            <table class="w-full">
                                                                <thead class="bg-cyan-950">
                                                                    <tr>
                                                                        <?php
                                                                            // $headersDisplayed = false;

                                                                            // foreach ($reservationData as $reservation) {
                                                                            //     if (is_array($reservation) && !$headersDisplayed) {
                                                                            //         foreach ($reservation as $key => $value) {
                                                                            //             echo '<th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase">' . htmlspecialchars($key) . '</th>';
                                                                            //         }
                                                                            //         $headersDisplayed = true;
                                                                            //     }
                                                                            // }
                                                                        ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-cyan-950">
                                                                    <?php
                                                                        // foreach ($reservationData as $reservation) {
                                                                        //     if (is_array($reservation)) {
                                                                        //         echo '<tr class="border border-cyan-950">';
                                                                        //         foreach ($reservation as $key => $value) {
                                                                        //             echo '<td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">' . htmlspecialchars($value) . '</td>';
                                                                        //         }
                                                                        //         echo '</tr>';
                                                                        //     }
                                                                        // }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        // } else {
                                        //   //  echo '<p>Invalid JSON data.</p>';
                                        // }
                                    ?>
                                </div>
                                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t ">
                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " data-hs-overlay="#hs-scale-animation-modal">
                                    Close
                                    </button>
                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    Save changes
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                //     }
                // }
            ?> -->
        </div>
    </div>
</div>

<?php include('dashboard-footer.php'); ?>
