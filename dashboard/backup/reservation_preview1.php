
<button type="button" class ="" data-hs-overlay="#hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
  <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
</button>

<div id="hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all  sm:w-full m-3 sm:mx-auto h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-full max-h-full overflow-hidden flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
      <div class="flex justify-between items-center py-3 px-4 border-b ">
        <h3 class="font-bold text-black text-xl">
          Update Reservation Information
        </h3>
        <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full" data-hs-overlay="#hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>">
          <span class="sr-only">Close</span>
          <i class="fa-solid fa-xmark text-black text-2xl hover:text-white hover:bg-cyan-950 px-4 py-3 rounded-full"></i>
        </button>
      </div>
        <div class="p-4 overflow-y-auto">
            <form  method="post" class=" ps-4 w-full " enctype="multipart/form-data">
            <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
                <div  class=" mt-6 gap-x-4 flex flex-col justify-center items-center ">
                    <div class="grid grid-cols-3  gap-x-4 gap-y-3 pb-4">
                    
                        <!-- Reservation Numner -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="reservation_number" class="text-black w-auto ps-4  font-serif">Reservation No : </label>
                                <input type="number" name="reservation_number" value="<?php echo $old['reservation_number'] ?? $row['reservation_number'] ??''; ?>" placeholder=" Reservation Number" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['reservation_number'] ?? ''; ?></h5>
                        </div>
                        <!-- Check In Date -->
                        <div>
                            <div class="outline outline-1 outline-black rounded relative flex items-center">
                                <label for="check_in" class="text-black ps-4 font-serif w-auto">Check In:</label>
                                <input id="multi_check_in" type="text" name="check_in" value="<?php echo $old['check_in'] ?? $row['check_in'] ?? ''; ?>" placeholder="Check In Date" 
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
                                <input id="multi_check_out" type="text" name="check_out" value="<?php echo $old['check_out'] ?? $row['check_out'] ?? ''; ?>" placeholder="Check Out Date" 
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
                                <input id="multi_booking" type="text" name="booking_date" value="<?php echo $old['booking_date'] ?? $row['booking_date'] ?? ''; ?>" placeholder="Booking Date" 
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
                                <label for="hotel" class="text-black w-auto   ps-4  font-serif">Hotel Name: </label>
                                <select name="hotel"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                    <option disabled selected>Select Hotel Name</option>
                                    <?php 
                                        foreach ($hotel_names as $hotel_name) {
                                            $selected = '';
                                            if (isset($old['hotel']) && $old['hotel'] == $hotel_name) {
                                                $selected = 'selected';
                                            } elseif (isset($row['hotel']) && $row['hotel'] == $hotel_name) {
                                                $selected = 'selected';
                                            }
                                    ?>
                                        <option value="<?php echo htmlspecialchars($hotel_name); ?>" 
                                            <?php echo $selected; ?> class="bg-cyan-950 text-white ">
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
                                <input type="text" name="guest" value="<?php echo $old['guest'] ?? $row['guest'] ?? ''; ?>" placeholder=" Guest Name" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['guest'] ?? ''; ?></h5>
                        </div>
                        <!-- Total Room -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="total_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                                <input type="number" name="total_room" value="<?php echo $old['total_room'] ?? $row['total_room'] ?? ''; ?>" placeholder=" Total Room" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.5">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_room'] ?? ''; ?></h5>
                        </div>
                        <!-- Total Nights -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="night" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                                <input type="number" name="night" value="<?php echo $old['night'] ?? $row['night'] ?? ''; ?>" placeholder=" Total Night" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.5">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night'] ?? ''; ?></h5>
                        </div>
                        <!-- Total Price -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                <label for="price" class="text-black w-auto ps-4  font-serif">Total Price: </label>
                                <input type="number" name="price" value="<?php echo $old['price'] ?? $row['price'] ?? ''; ?>" placeholder=" Total Price" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['price'] ?? ''; ?></h5>
                        </div>
                        <!-- Currency -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="currency" class="text-black w-auto   ps-4  font-serif">Currency : </label>
                                <select name="currency"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                <option disabled selected>Select Currency </option>
                                <?php 
                                    foreach ($currency_names as $currency_name) {
                                        $selected = '';
                                        if (isset($old['currency']) && $old['currency'] == $currency_name) {
                                            $selected = 'selected';
                                        } elseif (isset($row['currency']) && $row['currency'] == $currency_name) {
                                            $selected = 'selected';
                                        }
                                ?>
                                    <option value="<?php echo htmlspecialchars($currency_name); ?>" 
                                        <?php echo $selected; ?> class="bg-cyan-950 text-white ">
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
                                <input type="number" name="rate" value="<?php echo $old['rate'] ?? $row['rate'] ?? ''; ?>" placeholder="USD Rate" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['rate'] ?? ''; ?></h5>
                        </div>
                        <!-- Total Advance -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                <label for="advance" class="text-black w-auto ps-4  font-serif">Total Advance : </label>
                                <input type="number" name="advance" value="<?php echo $old['advance'] ?? $row['advance'] ?? ''; ?>" placeholder=" Total advance amount" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['advance'] ?? ''; ?></h5>
                        </div>
                        <!-- Advance Currency -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 outline-black rounded">
                                <label for="advance_currency" class="text-black w-auto   ps-4  font-serif">Advance Currency : </label>
                                <select name="advance_currency"  class=" py-px bg-transparent w-full ps-2 text-sm focus:outline-none">
                                    <option disabled selected>Select Advance Currency </option>
                                    <?php 
                                        foreach ($advance_currency_names as $advance_currency_name) {
                                            $selected = '';
                                            if (isset($old['advance_currency']) && $old['advance_currency'] == $advance_currency_name) {
                                                $selected = 'selected';
                                            } elseif (isset($row['advance_currency']) && $row['advance_currency'] == $advance_currency_name) {
                                                $selected = 'selected';
                                            }
                                    ?>
                                        <option value="<?php echo htmlspecialchars($advance_currency_name); ?>" 
                                            <?php echo $selected; ?> class="bg-cyan-950 text-white ">
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
                                <label for="source" class="text-black w-auto   ps-4  font-serif">Source: </label>
                                <select name="source"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                    <option disabled selected>Select Booking Source</option>
                                    <?php 
                                        foreach ($source_names as $source_name) {
                                            $selected = '';
                                            if (isset($old['source']) && $old['source'] == $source_name) {
                                                $selected = 'selected';
                                            } elseif (isset($row['source']) && $row['source'] == $source_name) {
                                                $selected = 'selected';
                                            }
                                    ?>
                                        <option value="<?php echo htmlspecialchars($source_name); ?>" 
                                            <?php echo $selected; ?> class="bg-cyan-950 text-white ">
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
                                <label for="payment_method" class="text-black w-auto   ps-4  font-serif">Payment Method: </label>
                                <select name="payment_method"  class=" py-px bg-transparent w-full ps-2  text-sm focus:outline-none">
                                    <option disabled selected >Select Payment Method </option>
                                    <?php 
                                        foreach ($payment_method_names as $payment_method_name) {
                                            $selected = '';
                                            if (isset($old['payment_method']) && $old['payment_method'] == $payment_method_name) {
                                                $selected = 'selected';
                                            } elseif (isset($row['payment_method']) && $row['payment_method'] == $payment_method_name) {
                                                $selected = 'selected';
                                            }
                                    ?>
                                        <option value="<?php echo htmlspecialchars($payment_method_name); ?>" 
                                            <?php echo $selected; ?> class="bg-cyan-950 text-white ">
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
                                <input type="text" name="phone" value="<?php echo $old['phone'] ?? $row['phone'] ?? ''; ?>" placeholder=" Phone number Or Email" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['phone'] ?? ''; ?></h5>
                        </div>
                        <!-- Comments -->
                        <div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="comment" class="text-black w-auto ps-4  font-serif">Comments : </label>
                                <input type="text" name="comment" value="<?php echo $old['comment'] ?? $row['comment'] ?? ''; ?>" placeholder=" Comments about guest" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['comment'] ?? ''; ?></h5>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" name="multi_reservation_update" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">Submit</button>
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
                            <input type="text" name="room_1" value="<?php echo $old['room_1'] ?? $row['room_1'] ?? ''; ?>" placeholder=" Room 1" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_1'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_1_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_1_room" value="<?php echo $old['total_1_room'] ?? $row['total_1_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_1_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_1" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_1" value="<?php echo $old['night_1'] ?? $row['night_1'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_1'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Price price -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_1_price" class="text-black w-auto ps-4  font-serif">Room 1 Price: </label>
                            <input type="number" name="room_1_price" value="<?php echo $old['room_1_price'] ?? $row['room_1_price'] ?? ''; ?>" placeholder=" Room 1 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_1_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 2 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_2" class="text-black w-auto ps-4  font-serif">Room 2: </label>
                            <input type="text" name="room_2" value="<?php echo $old['room_2'] ?? $row['room_2'] ?? ''; ?>" placeholder=" Room 2" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_2'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_2_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_2_room" value="<?php echo $old['total_2_room'] ?? $row['total_2_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_2_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_2" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_2" value="<?php echo $old['night_2'] ?? $row['night_2'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_2'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Price price -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_2_price" class="text-black w-auto ps-4  font-serif">Room 2 Price: </label>
                            <input type="number" name="room_2_price" value="<?php echo $old['room_2_price'] ?? $row['room_2_price'] ?? ''; ?>" placeholder=" Room 2 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_2_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 3 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_3" class="text-black w-auto ps-4  font-serif">Room 3: </label>
                            <input type="text" name="room_3" value="<?php echo $old['room_3'] ?? $row['room_3'] ?? ''; ?>" placeholder=" Room 3" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_3_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_3_room" value="<?php echo $old['total_3_room'] ?? $row['total_3_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_3_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_3" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_3" value="<?php echo $old['night_3'] ?? $row['night_3'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_3'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Price price -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_3_price" class="text-black w-auto ps-4  font-serif">Room 3 price: </label>
                            <input type="number" name="room_3_price" value="<?php echo $old['room_3_price'] ?? $row['room_3_price'] ?? ''; ?>" placeholder=" Room 3 price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_3_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 4 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_4" class="text-black w-auto ps-4  font-serif">Room 4: </label>
                            <input type="text" name="room_4" value="<?php echo $old['room_4'] ?? $row['room_4'] ?? ''; ?>" placeholder=" Room 4" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_4_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_4_room" value="<?php echo $old['total_4_room'] ?? $row['total_4_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_4_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_4" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_4" value="<?php echo $old['night_4'] ?? $row['night_4'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_4'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price-->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_4_price" class="text-black w-auto ps-4  font-serif">Room 4 Price: </label>
                            <input type="number" name="room_4_price" value="<?php echo $old['room_4_price'] ?? $row['room_4_price'] ?? ''; ?>" placeholder=" Room 4 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_4_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 5 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_5" class="text-black w-auto ps-4  font-serif">Room 5: </label>
                            <input type="text" name="room_5" value="<?php echo $old['room_5'] ?? $row['room_5'] ?? ''; ?>" placeholder=" Room 5" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_5_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_5_room" value="<?php echo $old['total_5_room'] ?? $row['total_5_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_5_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_5" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_5" value="<?php echo $old['night_5'] ?? $row['night_5'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_5'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_5_price" class="text-black w-auto ps-4  font-serif">Room 5 Price: </label>
                            <input type="number" name="room_5_price" value="<?php echo $old['room_5_price'] ?? $row['room_5_price'] ?? ''; ?>" placeholder=" Room 5 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_5_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 6 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_6" class="text-black w-auto ps-4  font-serif">Room 6: </label>
                            <input type="text" name="room_6" value="<?php echo $old['room_6'] ?? $row['room_6'] ?? ''; ?>" placeholder=" Room 6" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_6_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_6_room" value="<?php echo $old['total_6_room'] ?? $row['total_6_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_6_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_6" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_6" value="<?php echo $old['night_6'] ?? $row['night_6'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_6'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price-->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_6_price" class="text-black w-auto ps-4  font-serif">Room 6 price: </label>
                            <input type="number" name="room_6_price" value="<?php echo $old['room_6_price'] ?? $row['room_6_price'] ?? ''; ?>" placeholder=" Room 6 price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_6_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 7 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_7" class="text-black w-auto ps-4  font-serif">Room 7: </label>
                            <input type="text" name="room_7" value="<?php echo $old['room_7'] ?? $row['room_7'] ?? ''; ?>" placeholder=" Room 7" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_7_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_7_room" value="<?php echo $old['total_7_room'] ?? $row['total_7_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_7_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_7" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_7" value="<?php echo $old['night_7'] ?? $row['night_7'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_7'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price-->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_7_price" class="text-black w-auto ps-4  font-serif">Room 7 Price: </label>
                            <input type="number" name="room_7_price" value="<?php echo $old['room_7_price'] ?? $row['room_7_price'] ?? ''; ?>" placeholder=" Room 7 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_7_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 8 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_8" class="text-black w-auto ps-4  font-serif">Room 8: </label>
                            <input type="text" name="room_8" value="<?php echo $old['room_8'] ?? $row['room_8'] ?? ''; ?>" placeholder=" Room 8" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_8_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_8_room" value="<?php echo $old['total_8_room'] ?? $row['total_8_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_8_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_8" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_8" value="<?php echo $old['night_8'] ?? $row['night_8'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_8'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_8_price" class="text-black w-auto ps-4  font-serif">Room 8 Price: </label>
                            <input type="number" name="room_8_price" value="<?php echo $old['room_8_price'] ?? $row['room_8_price'] ?? ''; ?>" placeholder=" Room 8 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_8_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 9 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_9" class="text-black w-auto ps-4  font-serif">Room 9: </label>
                            <input type="text" name="room_9" value="<?php echo $old['room_9'] ?? $row['room_9'] ?? ''; ?>" placeholder=" Room 9" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_9_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_9_room" value="<?php echo $old['total_9_room'] ?? $row['total_9_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_9_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_9" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_9" value="<?php echo $old['night_9'] ?? $row['night_9'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_9'] ?? ''; ?></h5>
                    </div>
                    <!-- Room  price-->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_9_price" class="text-black w-auto ps-4  font-serif">Room 9 price: </label>
                            <input type="number" name="room_9_price" value="<?php echo $old['room_9_price'] ?? $row['room_9_price'] ?? ''; ?>" placeholder=" Room 9 price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_9_price'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 10 -->
                    <!-- Room Name -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_10" class="text-black w-auto ps-4  font-serif">Room 10: </label>
                            <input type="text" name="room_10" value="<?php echo $old['room_10'] ?? $row['room_10'] ?? ''; ?>" placeholder=" Room 10" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                    </div>
                    <!-- Total Room -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="total_10_room" class="text-black w-auto ps-4  font-serif">Total Room: </label>
                            <input type="number" name="total_10_room" value="<?php echo $old['total_10_room'] ?? $row['total_10_room'] ?? ''; ?>" placeholder=" Total Room" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['total_10_room'] ?? ''; ?></h5>
                    </div>
                    <!-- Total Nights -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="night_10" class="text-black w-auto ps-4  font-serif">Total Night: </label>
                            <input type="number" name="night_10" value="<?php echo $old['night_10'] ?? $row['night_10'] ?? ''; ?>" placeholder=" Total Night" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.1">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['night_10'] ?? ''; ?></h5>
                    </div>
                    <!-- Room 10 price-->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="room_10_price" class="text-black w-auto ps-4  font-serif">Room 10 Price: </label>
                            <input type="number" name="room_10_price" value="<?php echo $old['room_10_price'] ?? $row['room_10_price'] ?? ''; ?>" placeholder=" Room 10 Price" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none" step="0.01">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['room_10_price'] ?? ''; ?></h5>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit" name="multi_reservation_update" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">Submit</button>
                </div>
            </form>   
        </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('advance').addEventListener('input', function() {
        var advanceInput = document.getElementById('advance');
        var advanceCurrencySelect = document.getElementById('advance_currency');
        
        if (advanceInput.value === '') {
            advanceCurrencySelect.selectedIndex = 0; // Deselect Advance Currency
        }
    });
</script>