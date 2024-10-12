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

    
    
    $currentMonth = date('F'); 
    $hotel_headline = '';
    // Check if the hotel name is provided in the URL
    if (isset($_GET['hotel'])) {
        $hotel = $_GET['hotel']; // Get the hotel name from URL parameters

        // Call the function to fetch the reservation data for the specified hotel
        $reservations = getReservationsByHotelName($hotel);
        if (mysqli_num_rows($reservations) > 0) {
            $first_reservation = mysqli_fetch_assoc($reservations);
            $hotel_headline = $first_reservation['hotel'];

            // Move the result pointer back to the beginning of the result set
            mysqli_data_seek($reservations, 0); 
        }
    } else {
        // Handle the case where no hotel name is provided
        echo "<h3 class='font-serif text-black'>No Hotel Selected</h3>";
    }
    
?>

<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-24">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold  font-serif capitalize">
                <?php 
                        echo $hotel_headline;
                ?>
            </h1>
            <div class="flex justify-center items-center gap-x-4">
                <a href="createHotelInvoice.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
                <a href="hotelInvoice.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i> Hotel Invoice
                </a>
                <a href="allHotelInvoice.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i> All Hotel Invoices
                </a>
            </div>
        </div>
            <hr class="border border-black">  
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
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Room</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Price</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if(mysqli_num_rows($reservations)>0){
                                                    $i=1;
                                                    while($row = mysqli_fetch_assoc($reservations)){
                                                        $hotel_headline = $row['hotel'];
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['reservation_number'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_in'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_out'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['guest'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['room']??'Multiple Type Room';?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo ($row['currency']=='USD'?'$':'Tk').' '.$row['price'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['status'];?></td>
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
        </div>
    </div>
</div>



<?php include('dashboard-footer.php'); ?>
