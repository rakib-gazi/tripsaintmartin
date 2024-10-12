
<?php 
    include ('dashboard-header.php');
    include ('../function/reservaton_authentication.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo "ID received: " . $id; 
        $reservation_copy_data = reservation_copy_view($id);
    } else {
        die('Reservation ID not provided.');
    }

?>
   <!-- Sidebar and Content -->
   <div class="flex">
    <?php include('dashboard-sidebar.php');?>

        <!-- Main Content -->

        <div class="w-4/5 p-4">
            <div class="container mx-auto mt-12">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold  font-serif capitalize">Reservation Preview</h1>
                    <div class="flex justify-center items-center gap-x-2">
                        <button class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black" onclick="downloadPDF()">
                            <i class="fa-solid fa-download me-4"></i> PDF
                        </button>
                        <a href="all_reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                            <i class="fa-solid fa-long-arrow-alt-left me-4"></i>All Reservaions
                        </a>
                        <a href="reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                            <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                        </a>
                    </div>
                </div>
                <hr class="border border-black">
                <!-- reservation preview -->
                <div class="container mx-auto " id="booking_print">
                    <div class="max-w-4xl mx-auto bg-white px-4 pt-4 shadow-md rounded-lg">
                        <?php 
                            if(mysqli_num_rows($reservation_copy_data)>0){
                                while ($row = mysqli_fetch_assoc($reservation_copy_data)) {

                                    // Start Booking Source
                                    if(isset($row["source"]) && $row["source"] == 'Booking.com'){
                                        $is_source = '<img src="../images/booking.png" alt="Booking" class="h-8">';
                                    }else if(isset($row["source"]) && $row["source"] == 'Expedia'){
                                        $is_source = '<img src="../images/expedia.png" alt="Booking" class="h-[34px] w-40 ">';
                                    }else if(isset($row["source"]) && $row["source"] == 'Airbnb'){
                                        $is_source = '<img src="../images/airbnb.png" alt="Booking" class="h-8">';
                                    }else if(isset($row["source"]) && $row["source"] == 'Ctrip.com'){
                                        $is_source = '<img src="../images/ctrip.png" alt="Booking" class="h-8 w-32">';
                                    }else if(isset($row["source"]) && $row["source"] == 'Makemytrip.com'){
                                        $is_source = '<img src="../images/make.png" alt="Booking" class="h-8 w-40">';
                                    }else if(isset($row["source"]) && $row["source"] == 'Direct Booking'){
                                        $is_source = '<h2 class="text-2xl font-serif text-center font-bold text-cyan-950">Direct Booking</h2>';
                                    }
                                    // end Booking Source


                                    //------start reservation information-----------//

                                        //check in date format like 15 july 2024
                                    $checkin_date = $row['check_in'];
                                    $date = new DateTime($checkin_date);
                                    $check_in = $date->format('d F Y');

                                     //check out date format like 15 july 2024
                                    $checkout_date = $row['check_out'];
                                    $date = new DateTime($checkout_date);
                                    $check_out = $date->format('d F Y');

                                     //Booking  date format like 15 july 2024
                                    $booking_date = $row['booking_date'];
                                    $date = new DateTime($booking_date);
                                    $booking_date = $date->format('d F Y');

                                    // room format
                                    if($row['total_room']<=9){
                                        $room_format = '0'.$row['total_room'];
                                    }else{
                                        $room_format = $row['total_room'];
                                    }

                                    //night format
                                    if($row['night']<=9){
                                        $night_format = '0'.$row['night'];
                                    }else{
                                        $night_format = $row['night'];
                                    }
                                    //------end  reservation information-----------//


                                    //----- start  payment & pricing part -----------//

                                    //price in usd
                                    $is_price_usd = (isset($row["price"]) && $row["currency"] == 'USD' ) ? $row["price"] :0.00;
                                    $price_format = $is_price_usd <= 9 ? '0' . number_format($is_price_usd, 2) : number_format($is_price_usd, 2);

                                    //price in usd
                                    $is_exchange_rate = (isset($row["price"]) && $row["currency"] == 'USD' ) ? $row["rate"] :0.00;

                                    //price in BDT
                                    $total_price_bdt =  $is_price_usd *  $is_exchange_rate;
                                    $is_price_bdt = (isset($row["price"]) && $row["currency"] == 'BDT' ) ? $row["price"] : $total_price_bdt;

                                     //total advance price
                                    $advance = isset($row['advance']) ? floatval($row['advance']) : 0.00;
                                    $rate = isset($row['rate']) ? floatval($row['rate']) : 0.00;
                                    $total_advance = $advance * $rate;
                                    $is_advance_usd = (isset($row["advance"]) && $row["advance_currency"] == 'USD' ) ? $total_advance : $advance;

                                    //total payable in hotel
                                    $hotel_pay =  $is_price_bdt- $is_advance_usd;
                                    //----- end  payment & pricing part -----------//

                                
                                    // start room wise information & price details

                                    //infromation for single type room
                                    $price_per_night_single_type_room = $is_price_bdt/$row['night'];
                                    $price_one_single_type_room_one_night =  $price_per_night_single_type_room / $row['total_room'];
                                    $total_full_price_single_type_room = ($price_one_single_type_room_one_night * $row['night'])* $row['total_room'];
                                    
                                   //infromation for Multiple type room
                                    $rooms = [];
                                    $total_rooms =[];
                                    $total_nights =[];
                                    $room_prices = [];
                                    
                                    for ($i = 1; $i <= 10; $i++) {
                                        $room_key = "room_" . $i;
                                        $total_room_key = "total_" . $i . "_room";
                                        $total_night_key = "night_" . $i ;
                                        $price_key = "room_" . $i . "_price";

                                        if (!empty($row[$room_key]) && !empty($row[$total_room_key]) && !empty($row[$price_key])) {
                                            $rooms[] = $row[$room_key];
                                            $total_rooms []=$row[$total_room_key];
                                            $total_nights []=$row[$total_night_key];
                                            $room_prices[] = $row[$price_key];
                                        }
                                    }
                                    $room_count = count($rooms);
                                    if($row['type']=='multi'){
                                         // Calculate Total Multi Room Price
                                        $total_multi_room_Price = 0;
                                        for ($j = 0; $j < $room_count; $j++) {
                                            $total_multi_room_Price += $room_prices[$j];
                                            $total_multi_room_price_bdt = $total_multi_room_Price*$row["rate"];
                                        }
                                        // Calculate Total Multi Room 
                                        $total_multi_room = 0;
                                        for ($j = 0; $j < $room_count; $j++) {
                                            $total_multi_room += $total_rooms[$j];
                                        }
                                        // Calculate Total Multi Room night 
                                        $total_multi_room_nights = 0;
                                        for ($j = 0; $j < $room_count; $j++) {
                                            $total_multi_room_nights += $total_nights[$j];
                                        }

                                   
                                    
                                    // error message
                                    $price_error= '<h2 class="text-xl font-semibold mb-1 text-red-600 font-obeo text-center py-12">
                                                Wrong Input: Your total price & multiple room price is not equal. Your total price is '.
                                                number_format( $is_price_bdt,2).' tk, but total multiple room price is '.number_format( $total_multi_room_price_bdt,2).' tk. Total price & multiple price must be equal. Please recheck & update your total & multiple room prices.</h2>';
                                    $room_error= '<h2 class="text-xl font-semibold mb-1 text-red-600 font-obeo text-center py-12">
                                                Wrong Input: Your total rooms & multiple rooms  is not equal. Your total rooms is '.
                                                $room_format.', but total multiple room is '.$total_multi_room.'. Total rooms & multiple rooms must be equal. Please recheck & update your rooms & multiple room.</h2>';
                                    $night_error= '<h2 class="text-xl font-semibold mb-1 text-red-600 font-obeo text-center py-12">
                                                Wrong Input: Your total nights & multiple room nights is not equal. Your total night is '.
                                                $night_format.', but total multiple room nights is '.$total_multi_room_nights.'. Total nights & multiple room nights must be equal. Please recheck & update your total nights & multiple room night.</h2>';
                                    }
                                    // file name
                                    $file_name= ucwords($row["guest"]) ;
                                    $payment_method=$row["payment_method"] ;
                                    // end file name

                                ?>
                                    <!-- Header -->
                                    <div class="bg-cyan-950 p-4 rounded-t-lg mb-4  flex justify-between items-center">
                                        <img src="../images/logo.png" alt="Logo" class="h-16">
                                        <h1 class="text-3xl font-semibold text-white font-obeo">Hotel Reservation</h1>
                                    </div>
                                    <?php
                                        if($row['type']=='multi'){
                                            if( $total_multi_room_price_bdt != $is_price_bdt && $total_multi_room!=$row['total_room'] && $total_multi_room_nights!=$row['night'] ){
                                                echo $price_error;
                                                echo $room_error;
                                                echo $night_error;
                                             }elseif($total_multi_room_price_bdt == $is_price_bdt && $total_multi_room!=$row['total_room'] && $total_multi_room_nights!=$row['night']){
                                                echo $room_error;
                                                echo $night_error;
                                             }elseif($total_multi_room_price_bdt == $is_price_bdt && $total_multi_room==$row['total_room'] && $total_multi_room_nights!=$row['night']){
                                                 echo $night_error;
                                              }elseif($total_multi_room_price_bdt != $is_price_bdt && $total_multi_room!=$row['total_room'] && $total_multi_room_nights==$row['night']){
                                                 echo $price_error;
                                                echo $room_error;
                                              }elseif($total_multi_room_price_bdt != $is_price_bdt && $total_multi_room==$row['total_room'] && $total_multi_room_nights==$row['night']){
                                                 echo $price_error;
                                              }elseif($total_multi_room_price_bdt != $is_price_bdt && $total_multi_room==$row['total_room'] && $total_multi_room_nights!=$row['night']){
                                                 echo $price_error;
                                                 echo $night_error;
                                              }elseif($total_multi_room_price_bdt != $is_price_bdt ){
                                                 echo $price_error;
                                              }elseif($total_multi_room!=$row['total_room']){
                                                 echo $room_error;
                                              }elseif($total_multi_room_nights!=$row['night']){
                                                 echo $night_error;
                                              }else{ ?>
                                                      <!-- Reservation Details -->
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <!-- Left Column -->
                                                        <div>
                                                            <!-- Booking Source -->
                                                            <div class="p-4 rounded-lg flex justify-center items-center border-2 border-cyan-950">
                                                                <?php echo $is_source; ?>
                                                            </div>
                                                            <div class="bg-gray-100 p-4 rounded-lg mt-4 shadow shadow-black min-h-[347px]">
                                                                <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Reservation Information</h2>
                                                                <hr class="border border-black">
                                                                <table class="w-full mt-2  ">
                                                                    <tr class=" ">
                                                                        <th class="w-1/2 font-serif text-left">Booking Number</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo $row["reservation_number"] ;?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left">Check In</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo $check_in ?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left">Check Out</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo$check_out?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-seri text-left">Booking Date</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo $booking_date ;?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left align-top">Guest Name</th>
                                                                        <td class="w-1/2 text-black font-serif text-left align-top capitalize"><?php echo $row["guest"] ;?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left align-top">Room Name</th>
                                                                        <td class="w-1/2 text-black font-serif text-left align-top"><?php echo $row["room"] ??'Multiple Type Room';?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left">Total Room</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo $room_format ;?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left">Total Night</th>
                                                                        <td class="w-1/2 text-black font-rflex text-left"><?php echo $night_format ;?></td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-left">Booking Source</th>
                                                                        <td class="w-1/2 text-black font-serif text-left"><?php echo $row["source"] ;?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- Right Column -->
                                                        <div>
                                                            <!-- Hotel Name -->
                                                            <div class="bg-cyan-950 p-4 rounded-lg mb-4">
                                                                <h3 class="text-xl font-serif text-center font-bold text-white py-1"><?php echo $row["hotel"] ;?></h3>
                                                            </div>
                                                            <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow shadow-black">
                                                                <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Payment & Pricing</h2>
                                                                <hr class="border border-black">
                                                                <table class="w-full mt-2">
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2 font-serif">Price (USD)</th>
                                                                        <td class="w-1/2 text-black font-rflex"><?php echo $price_format ;?> USD</td>
                                                                    </tr>
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2">Exchange Rate</th>
                                                                        <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_exchange_rate,2) ;?> TK</td>
                                                                    </tr>
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2 font-serif">Total Price (BDT)</th>
                                                                        <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_price_bdt,2) ;?> TK</td>
                                                                    </tr>
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2 font-serif">Total Advance</th>
                                                                        <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_advance_usd,2) ;?> TK</td>
                                                                    </tr>
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2 font-serif">Total Pay In Hotel</th>
                                                                        <td class="w-1/2 text-black font-rflex"><?php echo number_format( $hotel_pay,2) ;?> TK</td> 
                                                                    </tr>
                                                                    <tr class="text-left">
                                                                        <th class="w-1/2 font-serif">Payment Method</th>
                                                                        <td class="w-1/2 text-black font-serif"><?php echo $row["payment_method"] ;?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!-- Contact Information -->
                                                            <div class="mt-4 bg-gray-100 p-4 rounded-lg shadow shadow-black">
                                                                <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Contact Information</h2>
                                                                <hr class="border border-black">
                                                                <table class="w-full mt-2">
                                                                    <tr class="">
                                                                        <th class="w-3/5 font-serif text-left text-medium">Phone Number</th>
                                                                        <td class="w-2/5 text-black font-rflex text-center text-sm"><?php echo $row["phone"] ;?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Room Wise Payment Details -->
                                                    <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                                                        <h2 class="text-xl font-semibold  text-cyan-950 font-obeo">Room Wise  Information & Price Details</h2>
                                                    </div>
                                                        <?php
                                                            
                                                            if ($room_count > 0) {
                                                                echo '
                                                                    <div class="mt-4 grid grid-cols-2  gap-4">
                                                                    ';
                                                                    
                                                                        for ($j = 0; $j < $room_count; $j++) {
                                                                            //multiple type rooms format
                                                                            if($total_rooms [$j]<=9){
                                                                                $rooms_format='0'.$total_rooms [$j];
                                                                            }else{
                                                                                $rooms_format=$total_rooms [$j];
                                                                            }
                                                                            //multiple type nights format
                                                                            if($total_nights[$j]<=9){
                                                                                $nights_format='0'.$total_nights[$j];
                                                                            }else{
                                                                                $nights_format=$total_nights[$j];
                                                                            }
                                                                            //Multiple type price format
                                                                            if( $row["currency"] == 'USD'){
                                                                            $multi_price_format= $room_prices[$j]*$row['rate'];
                                                                            }else{
                                                                                $multi_price_format= $room_prices[$j];
                                                                            }


                                                                                echo'
                                                                                <div class="bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                                                                                    <table class="w-full mt-2">
                                                                                        <tr class="text-left">
                                                                                            <th class="w-2/3 font-serif">' . ucwords($rooms[$j]) . '</th>
                                                                                            <td class="w-1/3 text-black font-rflex">'.$rooms_format.'</td>
                                                                                        </tr>
                                                                                        <tr class="text-left">
                                                                                            <th class="w-2/3 font-serif">Total Night</th>
                                                                                            <td class="w-1/3 text-black font-rflex">'.$nights_format.'</td>
                                                                                        </tr>
                                                                                        <tr class="text-left">
                                                                                            <th class="w-2/3 font-serif">Price Per Night</th>
                                                                                            <td class="w-1/3 text-black font-rflex">' . floatval($multi_price_format) . ' TK</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>';
                                                                        }
                                                                echo' </div>';
                                                                }else{
                                                                echo'
                                                        
                                                                        <div class="bg-gray-100 px-4 py-2 rounded-lg mt-4 shadow shadow-black">
                                                                            <table class="w-full mt-2">
                                                                                <tr class="">
                                                                                    <th class="w-1/2 font-serif text-start">'.$row["room"] .'</th>
                                                                                    <td class="w-1/2 text-black font-rflex text-start">'.$room_format.'</td>
                                                                                </tr>
                                                                                <tr class="">
                                                                                    <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">1</span> Room)</th>
                                                                                    <td class="w-1/2 text-black font-rflex text-start">'.number_format($price_one_single_type_room_one_night,2).'TK</td>
                                                                                </tr>';
                                                                                if($row['total_room']>1){
                                                                                    echo'<tr class="">
                                                                                    <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">'.$row['total_room'].'</span> Room)</th>
                                                                                    <td class="w-1/2 text-black font-rflex text-start">'.number_format( $price_one_single_type_room_one_night*$row['total_room'] ,2).'TK</td>
                                                                                </tr>';
                                                                                }
                                                                                
                                                                            echo' <tr class="">
                                                                                    <th class="w-1/2 font-serif text-start">Total (<span class="font-rflex">'.$row['total_room'].'</span> Room <span class="font-rflex">'.$row['night'].'</span> Night)</th>
                                                                                    <td class="w-1/2 text-black font-rflex text-start">'.number_format( $total_full_price_single_type_room ,2).'TK</td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                ';
                                                            }
                                                        ?>
                                                    <!-- Comments -->
                                                    <div class="bg-gray-200 p-4 rounded-lg mt-4 shadow shadow-black">
                                                        <table class="w-full mt-2">
                                                            <tr class="flex justify-center items-start">
                                                                <th class="w-1/6 font-serif">Comments</th>
                                                                <td class="w-5/6 text-black font-serif"><?php echo $row["comment"] ;?></td>
                                                            </tr>
                                                        </table>
                                                    </div><?php } 
                                        }else{ ?>
                                            <!-- Reservation Details -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Left Column -->
                                            <div>
                                                <!-- Booking Source -->
                                                <div class="p-4 rounded-lg flex justify-center items-center border-2 border-cyan-950">
                                                    <?php echo $is_source; ?>
                                                </div>
                                                <div class="bg-gray-100 p-4 rounded-lg mt-4 shadow shadow-black min-h-[347px]">
                                                    <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Reservation Information</h2>
                                                    <hr class="border border-black">
                                                    <table class="w-full mt-2  ">
                                                        <tr class=" ">
                                                            <th class="w-1/2 font-serif text-left">Booking Number</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo $row["reservation_number"] ;?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left">Check In</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo $check_in ?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left">Check Out</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo$check_out?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-seri text-left">Booking Date</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo $booking_date ;?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left align-top">Guest Name</th>
                                                            <td class="w-1/2 text-black font-serif text-left align-top capitalize"><?php echo $row["guest"] ;?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left align-top">Room Name</th>
                                                            <td class="w-1/2 text-black font-serif text-left align-top"><?php echo $row["room"] ??'Multiple Type Room';?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left">Total Room</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo $room_format ;?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left">Total Night</th>
                                                            <td class="w-1/2 text-black font-rflex text-left"><?php echo $night_format ;?></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th class="w-1/2 font-serif text-left">Booking Source</th>
                                                            <td class="w-1/2 text-black font-serif text-left"><?php echo $row["source"] ;?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Right Column -->
                                            <div>
                                                <!-- Hotel Name -->
                                                <div class="bg-cyan-950 p-4 rounded-lg mb-4">
                                                    <h3 class="text-xl font-serif text-center font-bold text-white py-1"><?php echo $row["hotel"] ;?></h3>
                                                </div>
                                                <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow shadow-black">
                                                    <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Payment & Pricing</h2>
                                                    <hr class="border border-black">
                                                    <table class="w-full mt-2">
                                                        <tr class="text-left">
                                                            <th class="w-1/2 font-serif">Price (USD)</th>
                                                            <td class="w-1/2 text-black font-rflex"><?php echo $price_format ;?> USD</td>
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th class="w-1/2">Exchange Rate</th>
                                                            <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_exchange_rate,2) ;?> TK</td>
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th class="w-1/2 font-serif">Total Price (BDT)</th>
                                                            <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_price_bdt,2) ;?> TK</td>
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th class="w-1/2 font-serif">Total Advance</th>
                                                            <td class="w-1/2 text-black font-rflex"><?php echo number_format( $is_advance_usd,2) ;?> TK</td>
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th class="w-1/2 font-serif">Total Pay In Hotel</th>
                                                            <td class="w-1/2 text-black font-rflex"><?php echo number_format( $hotel_pay,2) ;?> TK</td> 
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th class="w-1/2 font-serif">Payment Method</th>
                                                            <td class="w-1/2 text-black font-serif"><?php echo $row["payment_method"] ;?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!-- Contact Information -->
                                                <div class="mt-4 bg-gray-100 p-4 rounded-lg shadow shadow-black">
                                                    <h2 class="text-xl font-semibold mb-1 text-cyan-950 font-obeo">Contact Information</h2>
                                                    <hr class="border border-black">
                                                    <table class="w-full mt-2">
                                                        <tr class="">
                                                            <th class="w-3/5 font-serif text-left text-medium">Phone Number</th>
                                                            <td class="w-2/5 text-black font-rflex text-center text-sm"><?php echo $row["phone"] ;?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Room Wise Payment Details -->
                                        <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                                            <h2 class="text-xl font-semibold  text-cyan-950 font-obeo">Room Wise  Information & Price Details</h2>
                                        </div>
                                            <?php
                                                
                                                if ($room_count > 0) {
                                                    echo '
                                                        <div class="mt-4 grid grid-cols-2  gap-4">
                                                        ';
                                                        
                                                            for ($j = 0; $j < $room_count; $j++) {
                                                                //multiple type rooms format
                                                                if($total_rooms [$j]<=9){
                                                                    $rooms_format='0'.$total_rooms [$j];
                                                                }else{
                                                                    $rooms_format=$total_rooms [$j];
                                                                }
                                                                //multiple type nights format
                                                                if($total_nights[$j]<=9){
                                                                    $nights_format='0'.$total_nights[$j];
                                                                }else{
                                                                    $nights_format=$total_nights[$j];
                                                                }
                                                                //Multiple type price format
                                                                if( $row["currency"] == 'USD'){
                                                                $multi_price_format= $room_prices[$j]*$row['rate'];
                                                                }else{
                                                                    $multi_price_format= $room_prices[$j];
                                                                }


                                                                    echo'
                                                                    <div class="bg-gray-100 px-4 py-2 rounded-lg shadow shadow-black">
                                                                        <table class="w-full mt-2">
                                                                            <tr class="text-left">
                                                                                <th class="w-2/3 font-serif">' . ucwords($rooms[$j]) . '</th>
                                                                                <td class="w-1/3 text-black font-rflex">'.$rooms_format.'</td>
                                                                            </tr>
                                                                            <tr class="text-left">
                                                                                <th class="w-2/3 font-serif">Total Night</th>
                                                                                <td class="w-1/3 text-black font-rflex">'.$nights_format.'</td>
                                                                            </tr>
                                                                            <tr class="text-left">
                                                                                <th class="w-2/3 font-serif">Price Per Night</th>
                                                                                <td class="w-1/3 text-black font-rflex">' . floatval($multi_price_format) . ' TK</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>';
                                                            }
                                                    echo' </div>';
                                                    }else{
                                                    echo'
                                            
                                                            <div class="bg-gray-100 px-4 py-2 rounded-lg mt-4 shadow shadow-black">
                                                                <table class="w-full mt-2">
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-start">'.$row["room"] .'</th>
                                                                        <td class="w-1/2 text-black font-rflex text-start">'.$room_format.'</td>
                                                                    </tr>
                                                                    <tr class="">
                                                                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">1</span> Room)</th>
                                                                        <td class="w-1/2 text-black font-rflex text-start">'.number_format($price_one_single_type_room_one_night,2).'TK</td>
                                                                    </tr>';
                                                                    if($row['total_room']>1){
                                                                        echo'<tr class="">
                                                                        <th class="w-1/2 font-serif text-start">Price Per Night (<span class="font-rflex">'.$row['total_room'].'</span> Room)</th>
                                                                        <td class="w-1/2 text-black font-rflex text-start">'.number_format( $price_one_single_type_room_one_night*$row['total_room'] ,2).'TK</td>
                                                                    </tr>';
                                                                    }
                                                                    
                                                                echo' <tr class="">
                                                                        <th class="w-1/2 font-serif text-start">Total (<span class="font-rflex">'.$row['total_room'].'</span> Room <span class="font-rflex">'.$row['night'].'</span> Night)</th>
                                                                        <td class="w-1/2 text-black font-rflex text-start">'.number_format( $total_full_price_single_type_room ,2).'TK</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                    ';
                                                }
                                            ?>
                                        <!-- Comments -->
                                        <div class="bg-gray-200 p-4 rounded-lg mt-4 shadow shadow-black">
                                            <table class="w-full mt-2">
                                                <tr class="flex justify-center items-start">
                                                    <th class="w-1/6 font-serif">Comments</th>
                                                    <td class="w-5/6 text-black font-serif"><?php echo $row["comment"] ;?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    
                                    <?php } ?>

                                    
                                    <!-- Footer -->
                                    <?php 
                                    if ($room_count <2) {
                                        ?>
                                            <div class="bg-cyan-950 px-4 py-8 rounded-b-lg my-4 shadow shadow-black flex items-center">
                                                <p class="flex-1 text-center text-white font-semibold text-lg">&copy; <?php echo date("Y"); ?> Obeo Limited. All rights reserved.</p>
                                                <p class="text-end text-white font-semibold text-sm"><?php date_default_timezone_set('Asia/Dhaka'); echo date('d-m-Y h:i:s A'); ?></p>
                                            </div> 
                                        <?php
                                    }elseif ($room_count>1 && $room_count < 6) {
                                            ?>
                                                <div class="bg-cyan-950 p-4 rounded-b-lg my-4 shadow shadow-black flex items-center">
                                                    <p class="flex-1 text-center text-white font-semibold text-lg">&copy; <?php echo date("Y"); ?> Obeo Limited. All rights reserved.</p>
                                                    <p class="text-end text-white font-semibold text-sm"><?php date_default_timezone_set('Asia/Dhaka'); echo date('d-m-Y h:i:s A'); ?></p>
                                                </div> 
                                            <?php
                                        }else{
                                            ?>
                                                <div class="bg-cyan-950 px-4 py-2 rounded-b-lg mt-2 shadow shadow-black flex items-center">
                                                    <p class=" flex-1 text-center text-white font-semibold text-lg">&copy; <?php echo date("Y"); ?> Obeo Limited. All rights reserved.</p>
                                                    <p class="text-end text-white font-semibold text-sm">  <?php date_default_timezone_set('Asia/Dhaka'); echo date('d-m-Y h:i:s A'); ?> </p>
                                                </div>
                                           <?php
                                        }
                                    ?>
                              <?php 
                               }
                               
                               ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function downloadPDF() {
            var element = document.getElementById('booking_print');
            var opt = {
                margin: 0,
                filename: '<?php echo $file_name.' ('.$payment_method.' Payment )' ;?>.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }
    </script>
</body>
<?php
    }
 ?>
</html>
