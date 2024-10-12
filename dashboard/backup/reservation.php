<?php 
    include('dashboard-header.php');
    include('../function/settings_authentication.php');
    include('../function/reservaton_authentication.php');

    $hotel_name_data = hotel_name_form_view();
    $currency_form_data = currency_form_view();
    $advance_currency_form_data = advance_currency_form_view();
    $source_form_data = source_form_view();
    $payment_method_form_data = payment_method_form_view();
    $hotel_names = [];
    $currency_names = [];
    $advance_currency_names = [];
    $source_names = [];
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
    if (mysqli_num_rows($payment_method_form_data) > 0) {
        while ($payment_method_name = mysqli_fetch_assoc($payment_method_form_data)) {
            $payment_method_names[] = $payment_method_name['payment'];
        }
    }

    if (isset($_POST['single_reservation_submit'])) {
        $old = $_POST;
        $result = single_reservation();
        if ($result['status'] == 'error') {
            $error = $result['message'];
        } else {
            $success = $result['message'];
            header('Refresh: 1; URL=reservation.php');
        }
    }elseif (isset($_POST['multi_reservation_submit'])) {
        $old = $_POST;
        $result = multi_reservation();
        if ($result['status'] == 'error') {
            $error = $result['message'];
        } else {
            $success = $result['message'];
            header('Refresh: 1; URL=reservation.php');
        }
    }
    if (isset($_POST['reservation_delete'])) {
        $result = reservation_delete();
        if ($result['status'] == 'error') {
            $errors = $result['message'];
        } else {
            $success = $result['message'];
            header('Refresh: 1; URL=reservation.php');
        }
    }

    if(isset($_POST['single_reservation_update'])){
		$old=$_POST;
		$result = single_reservation_update();
		if($result['status'] == 'error'){
			$error = $result['message'];
		}else{
			$update_success = $result['message'];
            
            header('Refresh: 3; URL=reservation.php');
		}
	}elseif(isset($_POST['multi_reservation_update'])){
		$old=$_POST;
		$result = multi_reservation_update();
		if($result['status'] == 'error'){
			$error = $result['message'];
		}else{
			$update_success = $result['message'];
            
            header('Refresh: 3; URL=reservation.php');
		}
	}
    
    $reservation_data = reservation_view();
    
?>

<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-20">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold  font-serif capitalize">Reservation</h1>
            <div class="flex justify-center items-center gap-x-2">
                <a href="all_reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>All Reservations
                </a>
            </div>
        </div>
            <hr class="border border-black">  
            <h5 class=" text-xl font-semibold font-mono text-black py-px ">
                    <?php 
                        echo $success ?? '';
                    ?>
                </h5>
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
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL No</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Reser. No</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">check In</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Check out</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Booking Date</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Guest Name</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Hotel</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Room</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Price</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Contact</th>
                                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-cyan-950 ">
                                                
                                                    <?php 
                                                        if(mysqli_num_rows($reservation_data)>0){
                                                            $i=1;
                                                            while($row = mysqli_fetch_assoc($reservation_data)){
                                                                //check in date format like 15 july 2024
                                                                $checkin_date = $row['check_in'];
                                                                $date = new DateTime($checkin_date);
                                                                $check_in = $date->format('d F Y');

                                                                //check out date format like 15 july 2024
                                                                $checkout_date = $row['check_out'];
                                                                $date = new DateTime($checkout_date);
                                                                $check_out = $date->format('d F Y');

                                                                //Booking date format like 15 july 2024
                                                                $booking_date = $row['booking_date'];
                                                                $date = new DateTime($booking_date);
                                                                $booking = $date->format('d F Y');
                                                    ?>
                                                    <tr class="border border-cyan-950">
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['reservation_number'];?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $check_in;?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $check_out;?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $booking;?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['guest'];?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['hotel'];?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['room']??'Multiple Type Room';?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo ($row['currency']=='USD'?'USD':'BDT').' '.$row['price'];?></td>
                                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['phone']??$row['email'];?></td>
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
                                                        }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                <nav class="flex justify-center space-x-4 mt-6" aria-label="Tabs" role="tablist">
                    <button type="button" class="hs-tab-active:bg-blue-600 hs-tab-active:text-white hs-tab-active:hover:text-white  py-3 px-4 inline-flex items-center gap-x-2 bg-cyan-950  font-serif font-bold text-center text-white  rounded-lg  active" id="pills-with-brand-color-item-1" data-hs-tab="#pills-with-brand-color-1" aria-controls="pills-with-brand-color-1" role="tab">
                        Single Type Room
                    </button>
                    <button type="button" class="hs-tab-active:bg-blue-600 hs-tab-active:text-white hs-tab-active:hover:text-white  py-3 px-4 inline-flex items-center gap-x-2 bg-cyan-950  font-serif font-bold text-center text-white  rounded-lg" id="pills-with-brand-color-item-2" data-hs-tab="#pills-with-brand-color-2" aria-controls="pills-with-brand-color-2" role="tab">
                        Multiple Type Room
                    </button>
                </nav>
                <div class="mt-3">
                    <!-- Single type Room Reservation -->
                    <div id="pills-with-brand-color-1" role="tabpanel" aria-labelledby="pills-with-brand-color-item-1">
                        <form  method="post" class=" ps-4 w-full " enctype="multipart/form-data">
                            <div  class=" mt-6 gap-x-4 flex flex-col justify-center items-center ">
                                <div class="grid grid-cols-3  gap-x-4 gap-y-3 pb-4">
                                    <!-- Submitted person name -->
                                    <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['auth']['name']?? $_SESSION['auth']['email']; ?>" >
                                    <!-- Reservation Numner -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="reservation_number" class="text-black w-auto ps-4  font-serif">Reservation No : </label>
                                            <input type="number" name="reservation_number" value="<?php echo $old['reservation_number'] ?? ''; ?>" placeholder=" Reservation Number" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['reservation_number'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Check In Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="check_in" class="text-black ps-4 font-serif w-auto">Check In:</label>
                                            <input id="check_in" type="text" name="check_in" value="<?php echo $old['check_in'] ?? ''; ?>" placeholder="Check In Date" 
                                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="calendar-icon-check-in">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['check_in'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Check Out Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="check_out" class="text-black ps-4 font-serif w-auto">Check Out:</label>
                                            <input id="check_out" type="text" name="check_out" value="<?php echo $old['check_out'] ?? ''; ?>" placeholder="Check Out Date" 
                                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="calendar-icon-check-out">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['check_out'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Reservation Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="booking_date" class="text-black ps-4  font-serif w-auto">Reservation Date:</label>
                                            <input id="booking_date" type="text" name="booking_date" value="<?php echo $old['booking_date'] ?? ''; ?>" placeholder="Booking Date" 
                                            class="py-px bg-transparent w-40 px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="calendar-icon-booking-date">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['booking_date'] ?? ''; ?></h5>
                                    </div>
                                        <!-- Hotel Name -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="hotel" class="text-black w-48 ps-4  font-serif">Hotel Name: </label>
                                                <select name="hotel"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                    <option disabled selected>Select Hotel Name</option>
                                                    <?php 
                                                    foreach ($hotel_names as $hotel_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($hotel_name); ?>" 
                                                            <?php echo (isset($old['hotel']) && $old['hotel'] == $hotel_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($hotel_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['hotel'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Guest Name -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="guest" class="text-black w-auto ps-4  font-serif">Guest Name: </label>
                                                <input type="text" name="guest" value="<?php echo $old['guest'] ?? ''; ?>" placeholder=" Guest Name" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['guest'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Room Name -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="room" class="text-black w-auto ps-4  font-serif">Room Name: </label>
                                                <input type="text" name="room" value="<?php echo $old['room'] ?? ''; ?>" placeholder=" Primary Room  Name" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Room -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="total_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                                <input type="number" name="total_room" value="<?php echo $old['total_room'] ?? ''; ?>" placeholder=" Total Room" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_room'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Nights -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="night" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                                <input type="number" name="night" value="<?php echo $old['night'] ?? ''; ?>" placeholder=" Total Night" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Price -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="price" class="text-black w-auto ps-4  font-serif">Total Price: </label>
                                                <input type="number" name="price" value="<?php echo $old['price'] ?? ''; ?>" placeholder=" Total Price" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['price'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Currency -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="currency" class="text-black w-40 ps-4  font-serif">Currency : </label>
                                                <select name="currency"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                <option disabled selected>Select Currency </option>
                                                    <?php 
                                                    foreach ($currency_names as $currency_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($currency_name); ?>" 
                                                            <?php echo (isset($old['currency']) && $old['currency'] == $currency_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($currency_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['currency'] ?? ''; ?></h5>
                                        </div>
                                        <!-- USD Rate -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="rate" class="text-black w-auto ps-4  font-serif">USD Rate : </label>
                                                <input type="number" name="rate" value="<?php echo $old['rate'] ?? ''; ?>" placeholder="USD Rate" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['rate'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Advance -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="advance" class="text-black w-auto ps-4  font-serif">Total Advance : </label>
                                                <input type="number" name="advance" value="<?php echo $old['advance'] ?? ''; ?>" placeholder=" Total advance amount" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['advance'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Advance Currency -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="advance_currency" class="text-black w-80 ps-4  font-serif">Advance Currency : </label>
                                                <select name="advance_currency"  class=" py-px bg-transparent w-full ps-2 text-sm focus:outline-none">
                                                    <option disabled selected>Select Advance Currency </option>
                                                    <?php 
                                                    foreach ($advance_currency_names as $advance_currency_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($advance_currency_name); ?>" 
                                                            <?php echo (isset($old['advance_currency']) && $old['advance_currency'] == $advance_currency_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($advance_currency_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['advance_currency'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Booking Source -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="source" class="text-black w-48 ps-4  font-serif">Source: </label>
                                                <select name="source"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                    <option disabled selected>Select Booking Source</option>
                                                    <?php 
                                                    foreach ($source_names as $source_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($source_name); ?>" 
                                                            <?php echo (isset($old['source']) && $old['source'] == $source_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($source_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['source'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Payment Method -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="payment_method" class="text-black w-72 ps-4  font-serif">Payment Method: </label>
                                                <select  name="payment_method"  class=" py-px bg-transparent w-full ps-2  text-sm focus:outline-none">
                                                    <option disabled selected >Select Payment Method </option>
                                                    <?php 
                                                    foreach ($payment_method_names as $payment_method_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($payment_method_name); ?>" 
                                                            <?php echo (isset($old['payment_method']) && $old['payment_method'] == $payment_method_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($payment_method_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['payment_method'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Phone Number -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="phone" class="text-black w-auto ps-4  font-serif">Phone Or Email : </label>
                                                <input type="text" name="phone" value="<?php echo $old['phone'] ?? ''; ?>" placeholder=" Phone number Or Email" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['phone'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Comments -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="comment" class="text-black w-auto ps-4  font-serif">Comments : </label>
                                                <input type="text" name="comment" value="<?php echo $old['comment'] ?? ''; ?>" placeholder=" Comments about guest" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['comment'] ?? ''; ?></h5>
                                        </div>
                                    </div>
                                    <button type="submit" name="single_reservation_submit" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Multi room type reservation -->
                    <div id="pills-with-brand-color-2" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-2">
                        <form  method="post" class=" ps-4 w-full " enctype="multipart/form-data">
                            <div  class=" mt-6 gap-x-4 flex flex-col justify-center items-center ">
                                <!-- Submitted person name -->
                                <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['auth']['name']?? $_SESSION['auth']['email']; ?>" >
                                <div class="grid grid-cols-3  gap-x-4 gap-y-3 pb-4">
                                    <!-- Reservation Numner -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="reservation_number" class="text-black w-auto ps-4  font-serif">Reservation No : </label>
                                            <input type="number" name="reservation_number" value="<?php echo $old['reservation_number'] ?? ''; ?>" placeholder=" Reservation Number" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['reservation_number'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Check In Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="check_in" class="text-black ps-4 font-serif w-auto">Check In:</label>
                                            <input id="multi_check_in" type="text" name="check_in" value="<?php echo $old['check_in'] ?? ''; ?>" placeholder="Check In Date" 
                                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="multi_calendar-icon-check-in">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['check_in'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Check Out Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="check_out" class="text-black ps-4 font-serif w-auto">Check Out:</label>
                                            <input id="multi_check_out" type="text" name="check_out" value="<?php echo $old['check_out'] ?? ''; ?>" placeholder="Check Out Date" 
                                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="multi_calendar-icon-check-out">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['check_out'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Reservation Date -->
                                    <div>
                                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                                            <label for="booking_date" class="text-black ps-4  font-serif w-auto">Reservation Date:</label>
                                            <input id="multi_booking" type="text" name="booking_date" value="<?php echo $old['booking_date'] ?? ''; ?>" placeholder="Booking Date" 
                                            class="py-px bg-transparent w-40 px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="multi_calendar-icon-booking_date">
                                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                            </div>
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['booking_date'] ?? ''; ?></h5>
                                    </div>
                                        <!-- Hotel Name -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="hotel" class="text-black w-48 ps-4  font-serif">Hotel Name: </label>
                                                <select name="hotel"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                    <option disabled selected>Select Hotel Name</option>
                                                    <?php 
                                                    foreach ($hotel_names as $hotel_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($hotel_name); ?>" 
                                                            <?php echo (isset($old['hotel']) && $old['hotel'] == $hotel_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($hotel_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['hotel'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Guest Name -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="guest" class="text-black w-auto ps-4  font-serif">Guest Name: </label>
                                                <input type="text" name="guest" value="<?php echo $old['guest'] ?? ''; ?>" placeholder=" Guest Name" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['guest'] ?? ''; ?></h5>
                                        </div>
                                        
                                        <!-- Total Room -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="total_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                                <input type="number" name="total_room" value="<?php echo $old['total_room'] ?? ''; ?>" placeholder=" Total Room" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_room'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Nights -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="night" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                                <input type="number" name="night" value="<?php echo $old['night'] ?? ''; ?>" placeholder=" Total Night" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Price -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="price" class="text-black w-auto ps-4  font-serif">Total Price: </label>
                                                <input type="number" name="price" value="<?php echo $old['price'] ?? ''; ?>" placeholder=" Total Price" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['price'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Currency -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="currency" class="text-black w-40 ps-4  font-serif">Currency : </label>
                                                <select name="currency"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                <option disabled selected>Select Currency </option>
                                                    <?php 
                                                    foreach ($currency_names as $currency_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($currency_name); ?>" 
                                                            <?php echo (isset($old['currency']) && $old['currency'] == $currency_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($currency_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['currency'] ?? ''; ?></h5>
                                        </div>
                                        <!-- USD Rate -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="rate" class="text-black w-auto ps-4  font-serif">USD Rate : </label>
                                                <input type="number" name="rate" value="<?php echo $old['rate'] ?? ''; ?>" placeholder="USD Rate" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.001">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['rate'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Total Advance -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="advance" class="text-black w-auto ps-4  font-serif">Total Advance : </label>
                                                <input type="number" name="advance" value="<?php echo $old['advance'] ?? ''; ?>" placeholder=" Total advance amount" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['advance'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Advance Currency -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="advance_currency" class="text-black w-80 ps-4  font-serif">Advance Currency : </label>
                                                <select name="advance_currency"  class=" py-px bg-transparent w-full ps-2 text-sm focus:outline-none">
                                                    <option disabled selected>Select Advance Currency </option>
                                                    <?php 
                                                    foreach ($advance_currency_names as $advance_currency_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($advance_currency_name); ?>" 
                                                            <?php echo (isset($old['advance_currency']) && $old['advance_currency'] == $advance_currency_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($advance_currency_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['advance_currency'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Booking Source -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="source" class="text-black w-48 ps-4  font-serif">Source: </label>
                                                <select name="source"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                    <option disabled selected>Select Booking Source</option>
                                                    <?php 
                                                    foreach ($source_names as $source_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($source_name); ?>" 
                                                            <?php echo (isset($old['source']) && $old['source'] == $source_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($source_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['source'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Payment Method -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                                <label for="payment_method" class="text-black w-72 ps-4  font-serif">Payment Method: </label>
                                                <select name="payment_method"  class=" py-px bg-transparent w-full ps-2  text-sm focus:outline-none">
                                                    <option disabled selected >Select Payment Method </option>
                                                    <?php 
                                                    foreach ($payment_method_names as $payment_method_name) {
                                                    ?>
                                                        <option value="<?php echo htmlspecialchars($payment_method_name); ?>" 
                                                            <?php echo (isset($old['payment_method']) && $old['payment_method'] == $payment_method_name ? 'selected' : ''); ?> class="bg-cyan-950 text-white ">
                                                            <?php echo htmlspecialchars($payment_method_name); ?>
                                                        </option>    
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['payment_method'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Phone Number -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="phone" class="text-black w-auto ps-4  font-serif">Phone Or Email : </label>
                                                <input type="text" name="phone" value="<?php echo $old['phone'] ?? ''; ?>" placeholder=" Phone number Or Email" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['phone'] ?? ''; ?></h5>
                                        </div>
                                        <!-- Comments -->
                                        <div>
                                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                <label for="comment" class="text-black w-auto ps-4  font-serif">Comments : </label>
                                                <input type="text" name="comment" value="<?php echo $old['comment'] ?? ''; ?>" placeholder=" Comments about guest" 
                                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                            </div>
                                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['comment'] ?? ''; ?></h5>
                                        </div>
                                        <div class="flex justify-center">
                                            <button type="submit" name="multi_reservation_submit" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="text-xl font-bold mb-1 text-start">Multiple Type Rooms</h1>
                                <div class="grid grid-cols-4 gap-2">
                                    <!-- Room 1 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_1" class="text-black w-auto ps-4  font-serif">Room 1: </label>
                                            <input type="text" name="room_1" value="<?php echo $old['room_1'] ?? ''; ?>" placeholder=" Room 1" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_1'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_1_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_1_room" value="<?php echo $old['total_1_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_1_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_1" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_1" value="<?php echo $old['night_1'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_1'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Price price -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_1_price" class="text-black w-auto ps-4  font-serif">Room 1 Price: </label>
                                            <input type="number" name="room_1_price" value="<?php echo $old['room_1_price'] ?? ''; ?>" placeholder=" Room 1 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_1_price'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room 2 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_2" class="text-black w-auto ps-4  font-serif">Room 2: </label>
                                            <input type="text" name="room_2" value="<?php echo $old['room_2'] ?? ''; ?>" placeholder=" Room 2" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_2'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_2_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_2_room" value="<?php echo $old['total_2_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_2_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_2" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_2" value="<?php echo $old['night_2'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_2'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Price price -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_2_price" class="text-black w-auto ps-4  font-serif">Room 2 Price: </label>
                                            <input type="number" name="room_2_price" value="<?php echo $old['room_2_price'] ?? ''; ?>" placeholder=" Room 2 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_2_price'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room 3 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_3" class="text-black w-auto ps-4  font-serif">Room 3: </label>
                                            <input type="text" name="room_3" value="<?php echo $old['room_3'] ?? ''; ?>" placeholder=" Room 3" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_3_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_3_room" value="<?php echo $old['total_3_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_3_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_3" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_3" value="<?php echo $old['night_3'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_3'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Price price -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_3_price" class="text-black w-auto ps-4  font-serif">Room 3 price: </label>
                                            <input type="number" name="room_3_price" value="<?php echo $old['room_3_price'] ?? ''; ?>" placeholder=" Room 3 price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_3_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 4 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_4" class="text-black w-auto ps-4  font-serif">Room 4: </label>
                                            <input type="text" name="room_4" value="<?php echo $old['room_4'] ?? ''; ?>" placeholder=" Room 4" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_4_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_4_room" value="<?php echo $old['total_4_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_4_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_4" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_4" value="<?php echo $old['night_4'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_4'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price-->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_4_price" class="text-black w-auto ps-4  font-serif">Room 4 Price: </label>
                                            <input type="number" name="room_4_price" value="<?php echo $old['room_4_price'] ?? ''; ?>" placeholder=" Room 4 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_4_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 5 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_5" class="text-black w-auto ps-4  font-serif">Room 5: </label>
                                            <input type="text" name="room_5" value="<?php echo $old['room_5'] ?? ''; ?>" placeholder=" Room 5" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_5_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_5_room" value="<?php echo $old['total_5_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_5_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_5" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_5" value="<?php echo $old['night_5'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_5'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_5_price" class="text-black w-auto ps-4  font-serif">Room 5 Price: </label>
                                            <input type="number" name="room_5_price" value="<?php echo $old['room_5_price'] ?? ''; ?>" placeholder=" Room 5 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_5_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 6 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_6" class="text-black w-auto ps-4  font-serif">Room 6: </label>
                                            <input type="text" name="room_6" value="<?php echo $old['room_6'] ?? ''; ?>" placeholder=" Room 6" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_6_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_6_room" value="<?php echo $old['total_6_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_6_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_6" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_6" value="<?php echo $old['night_6'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_6'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price-->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_6_price" class="text-black w-auto ps-4  font-serif">Room 6 price: </label>
                                            <input type="number" name="room_6_price" value="<?php echo $old['room_6_price'] ?? ''; ?>" placeholder=" Room 6 price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_6_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 7 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_7" class="text-black w-auto ps-4  font-serif">Room 7: </label>
                                            <input type="text" name="room_7" value="<?php echo $old['room_7'] ?? ''; ?>" placeholder=" Room 7" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_7_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_7_room" value="<?php echo $old['total_7_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_7_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_7" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_7" value="<?php echo $old['night_7'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_7'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price-->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_7_price" class="text-black w-auto ps-4  font-serif">Room 7 Price: </label>
                                            <input type="number" name="room_7_price" value="<?php echo $old['room_7_price'] ?? ''; ?>" placeholder=" Room 7 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_7_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 8 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_8" class="text-black w-auto ps-4  font-serif">Room 8: </label>
                                            <input type="text" name="room_8" value="<?php echo $old['room_8'] ?? ''; ?>" placeholder=" Room 8" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_8_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_8_room" value="<?php echo $old['total_8_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_8_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_8" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_8" value="<?php echo $old['night_8'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_8'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_8_price" class="text-black w-auto ps-4  font-serif">Room 8 Price: </label>
                                            <input type="number" name="room_8_price" value="<?php echo $old['room_8_price'] ?? ''; ?>" placeholder=" Room 8 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_8_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 9 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_9" class="text-black w-auto ps-4  font-serif">Room 9: </label>
                                            <input type="text" name="room_9" value="<?php echo $old['room_9'] ?? ''; ?>" placeholder=" Room 9" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_9_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_9_room" value="<?php echo $old['total_9_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_9_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_9" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_9" value="<?php echo $old['night_9'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_9'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room  price-->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_9_price" class="text-black w-auto ps-4  font-serif">Room 9 price: </label>
                                            <input type="number" name="room_9_price" value="<?php echo $old['room_9_price'] ?? ''; ?>" placeholder=" Room 9 price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_9_price'] ?? ''; ?></h5>
                                    </div>
                                <!-- Room 10 -->
                                    <!-- Room Name -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_10" class="text-black w-auto ps-4  font-serif">Room 10: </label>
                                            <input type="text" name="room_10" value="<?php echo $old['room_10'] ?? ''; ?>" placeholder=" Room 10" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                                        </div>
                                    </div>
                                    <!-- Total Room -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="total_10_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                            <input type="number" name="total_10_room" value="<?php echo $old['total_10_room'] ?? ''; ?>" placeholder=" Total Room" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_10_room'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Total Nights -->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="night_10" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                            <input type="number" name="night_10" value="<?php echo $old['night_10'] ?? ''; ?>" placeholder=" Total Night" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_10'] ?? ''; ?></h5>
                                    </div>
                                    <!-- Room 10 price-->
                                    <div>
                                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                            <label for="room_10_price" class="text-black w-auto ps-4  font-serif">Room 10 Price: </label>
                                            <input type="number" name="room_10_price" value="<?php echo $old['room_10_price'] ?? ''; ?>" placeholder=" Room 10 Price" 
                                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                                        </div>
                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_10_price'] ?? ''; ?></h5>
                                    </div>
                                </div>
                            <div class="flex justify-center mt-4">
                                <button type="submit" name="multi_reservation_submit" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php include('dashboard-footer.php'); ?>
