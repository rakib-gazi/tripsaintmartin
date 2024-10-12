<?php 
    include('dashboard-header.php');
    include('../function/settings_authentication.php');
    include('../function/reservaton_authentication.php');
    include('../function/search_authentication.php');

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
    
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $row_count = 0;
    if (isset($_GET['statusWiseSearch'])) {
        $search_data = statusWiseSearch();
    
        if ($search_data && mysqli_num_rows($search_data) > 0) {
            $data_available = true;
            $row_count = mysqli_num_rows($search_data);
        } else {
            $data_available = false;
        }
    } else {
        $data_available = false;
    }
    if ($data_available) {
        $row_count = mysqli_num_rows($search_data);
    }
?>

<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-24">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold  font-serif capitalize">All Reservation</h1>
            <div class="flex justify-center items-center gap-x-4">
                <a href="all_reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
                <a href="current_reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i> <?php echo $currentMonth ;?> Reservations
                </a>
                <a href="reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i> Add Reservation
                </a>
            </div>
        </div>
            <hr class="border border-black">  
                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <strong class="font-bold">Error:</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="GET" class=" py-4 grid grid-cols-12 gap-x-4">
                    <div class="col-span-11">
                        <div class="grid grid-cols-3 gap-x-4">
                            <div class="flex justify-start items-center outline outline-1 outline-black rounded ">
                                <label for="type" class="text-black w-40 ps-4 font-serif ">Search By: </label>
                                <select name="type" class="p-1.5 bg-transparent w-full ps-2 border-none focus:outline-none focus:ring-0 ">
                                    <option value="Checked In" <?php echo isset($_GET['type']) && $_GET['type'] == 'Checked In' ? 'selected' : ''; ?>>Checked In</option>  
                                    <option value="No Show" <?php echo isset($_GET['type']) && $_GET['type'] == 'No Show' ? 'selected' : ''; ?>>No Show</option>  
                                    <option value="Canceled" <?php echo isset($_GET['type']) && $_GET['type'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>  
                                    <option value="Charged" <?php echo isset($_GET['type']) && $_GET['type'] == 'Charged' ? 'selected' : ''; ?>>Charged</option>  
                                </select>
                            </div>
                            <div class="outline outline-1 outline-black rounded relative flex items-center">
                                <label for="start" class="text-black ps-4 font-serif w-32">Start Date:</label>
                                <input id="search_start" type="text" name="start" value="<?php echo isset($_GET['start']) ? $_GET['start'] : ''; ?>" placeholder="Select Date Start" 
                                class="p-1.5 bg-transparent w-full ps-2 border-none focus:outline-none focus:ring-0 custom-date-input" autocomplete="off">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="calender_search_start">
                                    <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                </div>
                            </div>
                            <div class="outline outline-1 outline-black rounded relative flex items-center">
                                <label for="end" class="text-black ps-4 font-serif w-32">End Date:</label>
                                <input id="search_end" type="text" name="end" value="<?php echo isset($_GET['end']) ? $_GET['end'] : ''; ?>" placeholder="Select Date End" 
                                class="p-1.5 bg-transparent w-full ps-2 border-none focus:outline-none focus:ring-0 custom-date-input" autocomplete="off">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="calender_search_end">
                                    <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="statusWiseSearch" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-4 py-1  rounded outline outline-1 outline-black">Search
                    </button>
                </form>
                <?php 
                    if($type == ''){
                        echo '';
                    }else{?>
                        <p class="px-2 py-1.5 whitespace-nowrap text-base font-medium text-green-700">
                            During this time the total number of <?php echo htmlspecialchars($type); ?> is <?php echo $row_count; ?>.
                        </p>
                    <?php } ?>
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
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Reser. No</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">check In</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">C/out</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Guest Name</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Hotel</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Room</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Price</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Contact</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Status</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if($data_available){
                                                    $row_count = mysqli_num_rows($search_data);
                                                    $i=1;
                                                    while($row= mysqli_fetch_assoc($search_data)){
                                                        $roomData = $row['room'];
                                                        $shortenedData = substr($roomData, 0, 20);
                                                        $contactData = $row['phone']??$row['email'];
                                                        $shortenedcontactData = substr($contactData, 0, 20);
                                                        $hotelData = $row['hotel'];
                                                        $shortenedhotelData = substr($hotelData, 0, 24);
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['reservation_number'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_in'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_out'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['guest'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $shortenedhotelData;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $shortenedData ??'Multiple Type Room';?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo ($row['currency']=='USD'?'$':'Tk').' '.$row['price'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $shortenedcontactData;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">
                                                        <div class="flex gap-x-2">
                                                            
                                                            <?php 
                                                                if($row['type']=='multi'){
                                                                    include ('multi_reservation_status.php');
                                                                }else{
                                                                    include ('single_reservation_status.php');
                                                                }
                                                            ?>
                                                            <p class="w-[90%]"><?php echo $row['status'];?></p>
                                                        </div>
                                                </td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <a href="reservation_copy.php?id=<?php echo $row['id']; ?>" 
                                                        class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-cyan-950" 
                                                        target="_blank">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>

                                                    <?php 
                                                        if($row['type']=='multi'){
                                                            include ('reservation_preview1.php');
                                                        }else{
                                                            include ('reservation_preview.php');
                                                        }
                                                        if($row['type']=='multi'){
                                                            include ('multi_reservation_comment.php');
                                                        }else{
                                                            include ('single_reservation_comment.php');
                                                        }
                                                        include ('reservation_info.php');
                                                    ?>
                                                    
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="reservation_delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }else{
                                                    echo '<tr>';
                                                    echo '<td colspan="11" class="text-center py-4"><h5 class="font-serif text-black">No Data Available</h5></td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>



<?php include('dashboard-footer.php'); ?>
