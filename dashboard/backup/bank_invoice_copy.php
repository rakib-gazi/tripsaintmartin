<?php 
    include ('dashboard-header.php');
    include ('../function/bank_invoice_authentication.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo "ID received: " . $id; 
        $bank_invoice_copy_data = bank_invoice_copy_view($id);
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
                    <h1 class="text-3xl font-bold  font-serif capitalize">Bank Invoice Preview</h1>
                    <div class="flex justify-center items-center gap-x-2">
                        <button class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black" onclick="downloadPDF()">
                            <i class="fa-solid fa-download me-4"></i> PDF
                        </button>
                        <a href="all_reservation.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                            <i class="fa-solid fa-long-arrow-alt-left me-4"></i>All Invoices
                        </a>
                        <a href="add_bank_invoice.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                            <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                        </a>
                    </div>
                </div>
                <hr class="border border-black">
                <!-- Bank Invoice Preview -->
                <div class="container mx-auto " id="booking_print">
                    <div class="max-w-4xl mx-auto bg-white px-4 py-4 shadow-md rounded-lg">
                        <?php 
                            if(mysqli_num_rows($bank_invoice_copy_data)>0){
                                
                                while ($row = mysqli_fetch_assoc($bank_invoice_copy_data)) {
                                    $amount= $row['amount'];
                                    // date format
                                    $date1 = $row['date'];
                                    $date = new DateTime($date1);
                                    $date1_format = $date->format('d F Y');
                                    // date 2 format
                                    $date2 = $row['date2'];
                                    $date = new DateTime($date2);
                                    $date2_format = $date->format('d F Y');
                                    // date format
                                    $date3 = $row['date3'];
                                    $date = new DateTime($date3);
                                    $date3_format = $date->format('d F Y');
                                    // date format
                                    $date4 = $row['date4'];
                                    $date = new DateTime($date4);
                                    $date4_format = $date->format('d F Y');

                                    
                                    if($row['amount2']  && $row['amount3'] && $row['amount4'] ){
                                        $p = 'p-1.5';
                                    }elseif($row['amount2']  && $row['amount3'] ){
                                        $p = 'p-2';
                                    }else{
                                        $p = 'p-4';
                                    }

                                    if($row['amount']  && $row['amount2']  && $row['amount3'] && $row['amount4'] ){
                                        $total_amount = $row['amount']  + $row['amount2']  + $row['amount3'] + $row['amount4'];
                                    }elseif($row['amount']  && $row['amount2']  && $row['amount3'] ){
                                        $total_amount = $row['amount']  + $row['amount2']  + $row['amount3'];
                                    }elseif($row['amount']  && $row['amount2'] ){
                                        $total_amount = $row['amount']  + $row['amount2'];
                                    }else{
                                        $total_amount = $row['amount'] ;
                                    }

                                    $hotel= $row['hotel'];


                                ?>
                                    <!-- Header -->
                                    <div class="bg-cyan-950 p-4 rounded-t-lg mb-4  flex justify-between items-center">
                                        <img src="../images/logo.png" alt="Logo" class="h-16">
                                        <h1 class="text-3xl font-semibold text-white font-obeo">INVOICE</h1>
                                    </div>
                                    <!-- Bank Invoice  Details -->
                                    <div class="grid grid-cols-2 gap-4 mt-12">
                                        <!-- Bill to Infor -->
                                        <div class="p-4 rounded-lg  border-2 border-cyan-950">
                                            <h3 class="font-semibold text-medium font-obeo mb-2">Bill to</h3>
                                            <h3 class="font-semibold text-medium font-obeo">Travelscape, LLC</h3>
                                            <p>5000 W Kearney Street,<br>Springfield, MO 65803 US.</p>
                                        </div>
                                        <!-- Invoie info -->
                                        <div class="p-4 rounded-lg  border-2 border-cyan-950">
                                            <table class="w-full ">
                                                <tr class="text-left">
                                                    <th class="w-1/2 font-serif text-sm">Invoice No</th>
                                                    <td class="w-1/2 text-black font-rflex text-sm">
                                                        <?php 
                                                            if($row['invoice']  && $row['invoice2'] && $row['invoice3'] && $row['invoice4'] ){
                                                                echo $row['invoice'].', '.$row['invoice2'].', '.$row['invoice3'].', '.$row['invoice4'] ;
                                                            }elseif($row['invoice']  && $row['invoice2'] && $row['invoice3'] ){
                                                                echo $row['invoice'].', '.$row['invoice2'].', '.$row['invoice3'] ;
                                                            }elseif($row['invoice']  && $row['invoice2'] ){
                                                                echo $row['invoice'].', '.$row['invoice2']  ;
                                                            }else{
                                                                echo $row['invoice'] ;
                                                            }
                                                        ?> 
                                                    </td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-1/2 font-serif text-sm">Reference Number</th>
                                                    <td class="w-1/2 text-black font-rflex text-sm"><?php echo $row['reference'] ;?></td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-1/2 font-serif text-sm">Invoice Date</th>
                                                    <td class="w-1/2 text-black font-rflex text-sm">
                                                        <?php 
                                                             if($row['date']  && $row['date2'] && $row['date3'] && $row['date4'] ){
                                                                echo $date1_format.', '.$date2_format.', '.$date3_format.', '.$date4_format ;
                                                            }elseif($row['date']  && $row['date2'] && $row['date3'] ){
                                                                echo $date1_format.', '.$date2_format.', '.$date3_format;
                                                            }elseif($row['date']  && $row['date2'] ){
                                                                echo $date1_format.', '.$date2_format;
                                                            }else{
                                                                echo $date1_format ;
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-1/2 font-serif text-sm">Amount Due (USD)</th>
                                                    <td class="w-1/2 text-black font-rflex text-sm">$<?php echo $total_amount ;?> </td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-1/2 font-serif text-sm">Printing Time</th>
                                                    <td class="w-1/2 text-black font-rflex text-sm"><?php date_default_timezone_set('Asia/Dhaka'); echo date('d-m-Y h:i:s A'); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mt-12">
                                        <div class="-m-1.5 ">
                                            <div class="p-1.5 w-full inline-block align-middle">
                                                <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                                    <table class="w-full ">
                                                        <thead class="bg-cyan-950">
                                                            
                                                            <tr>
                                                                <th scope="col" class="<?php echo $p; ?> text-start text-sm font-medium text-white uppercase ">SL</th>
                                                                <th scope="col" class="<?php echo $p; ?> text-start text-sm font-medium text-white uppercase ">ITEMS </th>
                                                                <th scope="col" class="<?php echo $p; ?> text-start text-sm font-medium text-white uppercase ">QT</th>
                                                                <th scope="col" class="<?php echo $p; ?> text-start text-sm font-medium text-white uppercase ">PRICE</th>
                                                                <th scope="col" class="<?php echo $p; ?> text-start text-sm font-medium text-white uppercase ">AMOUNT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-cyan-950 ">
                                                                <tr class="border border-cyan-950">
                                                                    <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                    <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                    <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                    <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount'];?></td>
                                                                    <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount'];?></td>
                                                                </tr>
                                                                <?php 
                                                                    if($row['amount2']  && $row['amount3'] && $row['amount4'] ){
                                                                    ?>
                                                                    <tr class="border border-cyan-950">
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">02</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                    </tr>
                                                                    <tr class="border border-cyan-950">
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">03</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount3'];?></td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount3'];?></td>
                                                                    </tr>
                                                                    <tr class="border border-cyan-950">
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">04</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount4'];?></td>
                                                                        <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount4'];?></td>
                                                                    </tr>
                                                                    <?php
                                                                    }elseif($row['amount2']  && $row['amount3'] ){
                                                                        ?>
                                                                        <tr class="border border-cyan-950">
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">02</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                        </tr>
                                                                        <tr class="border border-cyan-950">
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">03</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount3'];?></td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount3'];?></td>
                                                                        </tr>
                                                                        <?php
                                                                    }elseif($row['amount2']  ){
                                                                        ?>
                                                                        <tr class="border border-cyan-950">
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">02</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">Web listing Bill</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">01</td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                            <td class="<?php echo $p; ?> whitespace-nowrap text-sm font-medium text-black">$<?php echo $row['amount2'];?></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                <tr class="border border-cyan-950">
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">Total </td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">$<?php echo $total_amount;?></td>
                                                                </tr>
                                                                <tr class="border border-cyan-950">
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">Paid </td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">$0.00</td>
                                                                </tr>
                                                                <tr class="border border-cyan-950">
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class=""></td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">Total Due</td>
                                                                    <td class="<?php echo $p; ?> text-start text-sm font-medium text-black uppercase">$<?php echo $total_amount;?></td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 mt-12 mb-12">
                                        <div>
                                            <p class="font-serif text-xl pb-4 text-left font-semibold">Payment Details </p>
                                            <table class="w-full ">
                                                <tr class="text-left">
                                                    <th class="w-auto font-serif">Account Name</th>
                                                    <td class="w-autotext-black font-rflex">Obeo Limited </td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-auto font-serif" >Account Number</th>
                                                    <td class="w-auto text-black font-rflex">1802101000007299</td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-auto font-serif">Bank Name</th>
                                                    <td class="w-auto text-black font-rflex">United Commercial Bank PLC</td>
                                                </tr>
                                                <tr class="text-left">
                                                    <th class="w-auto font-serif">Branch Name</th>
                                                    <td class="w-auto text-black font-rflex">Shyamoli Ring Road Branch </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="flex justify-center items-center">
                                            <div class="flex flex-col justify-center items-center">
                                                <p class="font-serif text-xl font-semibold pb-2">Account Manager</p>
                                                <p class="font-serif text-xl font-semibold text-blue-obeo ">Obeo Limited</p>
                                                <img src="../images/sign2.png" alt="Logo" class="h-8">
                                                <p class="font-serif font-semibold text-blue-obeo ">Managing Director</p>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- Footer -->
                                    <div class="bg-cyan-950 px-8 py-4 rounded-b-lg my-4 shadow shadow-black grid grid-cols-2">
                                        <div>
                                            <div class="flex justify-start items-center gap-x-4">
                                                <p class=""><i class="fa-solid fa-phone-flip text-white text-medium"></i></p>
                                                <p class=" text-white font-semibold text-sm">+880-181 000 4180</p>
                                            </div>
                                            <div class="flex justify-start items-center gap-x-4">
                                                <p class=""><i class="fa-solid fa-globe text-white text-medium"></i></p>
                                                <p class=" text-white font-semibold text-sm">obeorooms.com</p>
                                            </div>
                                            <div class="flex justify-start items-center gap-x-4">
                                                <p class=""><i class="fa-solid fa-envelope text-white text-medium"></i></p>
                                                <p class=" text-white font-semibold text-sm">contact@obeorooms.com</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex flex-col justify-center items-start">
                                                <p class=" text-white font-semibold text-sm">Office Address </p>
                                                <p class=" text-white font-semibold text-sm">House-514, Suite#A/1, Road#07,<br>Avenue#3, Mirpur DOHS,Dhaka-1216</p>
                                            </div>
                                        </div>
                                    </div> 
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
                filename: 'UCBL Invoice_ <?php echo $hotel;?>_$<?php echo $amount;?>.pdf',
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
