
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
                <div class="container mx-auto font-nunito" id="booking_print">
                    <div class="max-w-4xl mx-auto bg-white px-4 pt-4 shadow-md rounded-lg">
                        

                    <div class="-m-1.5 ">
                        <div class="p-1.5 w-full inline-block align-middle">
                            <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                <table class="w-full ">
                                    <thead class="bg-cyan-950">
                                        <tr>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">Reser. No</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">check In</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">check out</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">Guest Name</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">Room Name</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">Price (BDT)</th>
                                            <th scope="col" class="px-1 py-1.5 text-start text-sm font-medium text-white uppercase ">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if(mysqli_num_rows($reservation_copy_data)>0){
                                                    $i=1;
                                                    while($row = mysqli_fetch_assoc($reservation_copy_data)){
                                                        //price in usd
                                                        $is_price_usd = (isset($row["price"]) && $row["currency"] == 'USD' ) ? $row["price"] :0.00;
                                                        $price_format = $is_price_usd <= 9 ? '0' . number_format($is_price_usd, 2) : number_format($is_price_usd, 2);

                                                        //price in usd
                                                        $is_exchange_rate = (isset($row["price"]) && $row["currency"] == 'USD' ) ? $row["rate"] :0.00;

                                                        //price in BDT
                                                        $total_price_bdt =  $is_price_usd *  $is_exchange_rate;
                                                        $is_price_bdt = (isset($row["price"]) && $row["currency"] == 'BDT' ) ? $row["price"] : $total_price_bdt;
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['reservation_number'];?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_in'];?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['check_out'];?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['guest'];?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['room']??'Multiple Type Room';?></td>
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo number_format( $is_price_bdt,2) ;?></td>
                                                
                                                <td class="px-1 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['status'];?></td>
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
</html>
