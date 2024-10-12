<?php 
include ('dashboard-header.php');
include ('../function/bank_invoice_authentication.php');
if (isset($_POST['single_invoice'])) {
    $old = $_POST;
    $result = single_invoice();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=add_bank_invoice.php');
    }
}elseif (isset($_POST['multi_invoice'])) {
    $old = $_POST;
    $result = multi_invoice();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=add_bank_invoice.php');
    }
}
if(isset($_POST['single_invoice_update'])){
    $old=$_POST;
    $result = single_invoice_update();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $update_success = $result['message'];
        
        header('Refresh: 1; URL=add_bank_invoice.php');
    }
}elseif(isset($_POST['multi_invoice_update'])){
    $old=$_POST;
    $result = multi_invoice_update();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $update_success = $result['message'];
        
        header('Refresh: 1; URL=add_bank_invoice.php');
    }
}
if (isset($_POST['bank_invoice_delete'])) {
    $result = bank_invoice_delete();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=add_bank_invoice.php');
    }
}

$bank_invoice_data = bank_invoice_view()

?>
<div class="flex">  
    <?php include('dashboard-sidebar.php');?>
    <!-- Main Content -->
    <div class="w-4/5 p-4">
        <div class="container mx-auto pt-20">
            
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold  font-serif capitalize">Add Bank Invoices</h1>
                    <div class="flex justify-center items-center gap-x-2">
                        <a href="bank_invoice.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                            <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
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
                <nav class="flex justify-center space-x-4 mt-6" aria-label="Tabs" role="tablist">
                    <button type="button" class="hs-tab-active:bg-blue-600 hs-tab-active:text-white hs-tab-active:hover:text-white  py-3 px-4 inline-flex items-center gap-x-2 bg-cyan-950  font-serif font-bold text-center text-white  rounded-lg  active" id="pills-with-brand-color-item-1" data-hs-tab="#pills-with-brand-color-1" aria-controls="pills-with-brand-color-1" role="tab">
                    Single Invoice
                    </button>
                    <button type="button" class="hs-tab-active:bg-blue-600 hs-tab-active:text-white hs-tab-active:hover:text-white  py-3 px-4 inline-flex items-center gap-x-2 bg-cyan-950  font-serif font-bold text-center text-white  rounded-lg" id="pills-with-brand-color-item-2" data-hs-tab="#pills-with-brand-color-2" aria-controls="pills-with-brand-color-2" role="tab">
                    Multiple Invoice
                    </button>
                </nav>
                <div class="mt-3">
                    <!-- Single type Room Reservation -->
                    <div id="pills-with-brand-color-1" role="tabpanel" aria-labelledby="pills-with-brand-color-item-1">
                        <form  method="post" class="">
                            <!-- Submitted person name -->
                            <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['auth']['name']?? $_SESSION['auth']['email']; ?>" >
                            <div class="mb-4">
                                <div class="outline outline-1 ouline-black rounded">
                                    <label for="hotel" class="text-black ps-4 font-serif w-auto ">Hotel Name: </label>
                                    <input type="text" name="hotel" value="<?php echo $old['hotel'] ?? ''; ?>" placeholder="Hotel Name " 
                                    class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                                </div>
                                <h5 class="text-red-600 font-mono font-xl"><?php echo $error['hotel'] ?? ''; ?></h5>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="invoice" class="text-black ps-4 font-serif w-auto">Invoice No: </label>
                                        <input type="text" name="invoice" value="<?php echo $old['invoice'] ?? ''; ?>" placeholder=" Invoice Number" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="reference" class="text-black ps-4 font-serif w-auto ">Reference No: </label>
                                        <input type="text" name="reference" value="<?php echo $old['reference'] ?? ''; ?>" placeholder="Reference No " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['reference'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 outline-black rounded relative flex items-center">
                                        <label for="date" class="text-black ps-4 font-serif w-auto">Invoice Date:</label>
                                        <input id="date" type="text" name="date" value="<?php echo $old['date'] ?? ''; ?>" placeholder="Invoice Date"  class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date">
                                            <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="amount" class="text-black ps-4 font-serif w-auto">Amount Due: </label>
                                        <input type="text" name="amount" value="<?php echo $old['amount'] ??  ''; ?>" placeholder="Amount Due " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount'] ?? ''; ?></h5>
                                </div>
                            </div>
                            <div class="mb-12 py-4 flex justify-center items-center">
                                <button type="submit" name="single_invoice" class="bg-cyan-950 text-white font-serif text-xl  px-8 py-2 rounded">Add Invoice</button>
                            </div>
                        </form>
                    </div>
                    <!-- Multi room type reservation -->
                    <div id="pills-with-brand-color-2" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-2">
                        <form  method="post" class="">
                            <!-- Submitted person name -->
                            <input type="hidden" name="submitted_by" value="<?php echo $_SESSION['auth']['name']?? $_SESSION['auth']['email']; ?>" >
                            <div class="grid grid-cols-2 mb-4 gap-4">
                                <div class="">
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="reference" class="text-black ps-4 font-serif w-auto ">Reference No: </label>
                                        <input type="text" name="reference" value="<?php echo $old['reference'] ?? ''; ?>" placeholder="Reference No " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['reference'] ?? ''; ?></h5>
                                </div>
                                <div class="">
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="hotel" class="text-black ps-4 font-serif w-auto ">Hotel Name: </label>
                                        <input type="text" name="hotel" value="<?php echo $old['hotel'] ?? ''; ?>" placeholder="Hotel Name " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['hotel'] ?? ''; ?></h5>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="invoice" class="text-black ps-4 font-serif w-auto">Invoice No: </label>
                                        <input type="text" name="invoice" value="<?php echo $old['invoice'] ?? ''; ?>" placeholder=" Invoice Number" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="invoice2" class="text-black ps-4 font-serif w-auto">Invoice No 2: </label>
                                        <input type="text" name="invoice2" value="<?php echo $old['invoice2'] ?? ''; ?>" placeholder=" Invoice Number 2" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice2'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="invoice3" class="text-black ps-4 font-serif w-auto">Invoice No 3: </label>
                                        <input type="text" name="invoice3" value="<?php echo $old['invoice3'] ?? ''; ?>" placeholder=" Invoice Number 3" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice3'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="invoice4" class="text-black ps-4 font-serif w-auto">Invoice No 4: </label>
                                        <input type="text" name="invoice4" value="<?php echo $old['invoice4'] ?? ''; ?>" placeholder=" Invoice Number 4" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice4'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 outline-black rounded relative flex items-center">
                                        <label for="date" class="text-black ps-4 font-serif w-auto">Invoice Date:</label>
                                        <input id="date" type="text" name="date" value="<?php echo $old['date'] ?? ''; ?>" placeholder="Invoice Date" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date">
                                            <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 outline-black rounded relative flex items-center">
                                        <label for="date2" class="text-black ps-4 font-serif w-auto">Invoice Date 2:</label>
                                        <input id="date2" type="text" name="date2" value="<?php echo $old['date2'] ?? ''; ?>" placeholder="Invoice Date 2" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date2">
                                            <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date2'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 outline-black rounded relative flex items-center">
                                        <label for="date3" class="text-black ps-4 font-serif w-auto">Invoice Date3:</label>
                                        <input id="date3" type="text" name="date3" value="<?php echo $old['date3'] ?? ''; ?>" placeholder="Invoice Date 3" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date3">
                                            <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date3'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 outline-black rounded relative flex items-center">
                                        <label for="date4" class="text-black ps-4 font-serif w-auto">Invoice Date4:</label>
                                        <input id="date4" type="text" name="date4" value="<?php echo $old['date4'] ?? ''; ?>" placeholder="Invoice Date 4" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date4">
                                            <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                                        </div>
                                    </div>
                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="amount" class="text-black ps-4 font-serif w-auto">Amount Due: </label>
                                        <input type="text" name="amount" value="<?php echo $old['amount'] ??  ''; ?>" placeholder="Amount Due " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="amount2" class="text-black ps-4 font-serif w-auto">Amount Due2: </label>
                                        <input type="text" name="amount2" value="<?php echo $old['amount2'] ??  ''; ?>" placeholder="Amount Due 2" 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount2'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="amount3" class="text-black ps-4 font-serif w-auto">Amount Due3: </label>
                                        <input type="text" name="amount3" value="<?php echo $old['amount3'] ??  ''; ?>" placeholder="Amount Due 3 " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount3'] ?? ''; ?></h5>
                                </div>
                                <div>
                                    <div class="outline outline-1 ouline-black rounded">
                                        <label for="amount4" class="text-black ps-4 font-serif w-auto">Amount Due4: </label>
                                        <input type="text" name="amount4" value="<?php echo $old['amount4'] ??  ''; ?>" placeholder="Amount Due 4 " 
                                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                                    </div>
                                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount4'] ?? ''; ?></h5>
                                </div>
                            </div>
                            <div class="mb-12 py-4 flex justify-center items-center">
                                <button type="submit" name="multi_invoice" class="bg-cyan-950 text-white font-serif text-xl  px-8 py-2 rounded">Add Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mt-2">
                <div class="-m-1.5 ">
                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="border border-cyan-950 rounded-lg overflow-hidden">
                            <table class="w-full ">
                                <thead class="bg-cyan-950">
                                    <tr>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Invoice No</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Reference No</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Invoice Date</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Amount Due</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Invoice No 2</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Invoice Date 2</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Amount Due 2</th>
                                        <th scope="col" class="p-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-cyan-950 ">
                                    
                                        <?php 
                                            if(mysqli_num_rows($bank_invoice_data)>0){
                                            $i=1;
                                            while($row = mysqli_fetch_assoc($bank_invoice_data)){
                                            //Invoice date format like 15 july 2024
                                            $invoice_date = $row['date'];
                                            $date = new DateTime($invoice_date);
                                            $invoice_date_format = $date->format('d F Y');
                                            

                                            //Invoice date 2 format like 15 july 2024
                                            $inv_date2 = $row['date2'];
                                            $date = new DateTime($inv_date2);
                                            $inv_date2_format = $date->format('d F Y');
                                            if($row['type']== 'multi'){
                                                $date_print= $inv_date2_format;
                                            }else{
                                                $date_print= '';
                                            }

                                        ?>
                                        <tr class="border border-cyan-950">
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['invoice'];?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['reference'];?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $invoice_date_format;?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['amount'];?></td>
                                            
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['invoice2'];?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $date_print;?></td>
                                            <td class="p-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['amount2'];?></td>
                                            <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                <a href="bank_invoice_copy.php?id=<?php echo $row['id']; ?>" 
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-cyan-950" 
                                                    target="_blank">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                <?php 
                                                    if($row['type']=='multi'){
                                                        include ('multi_bank_invoice.php');
                                                    }else{
                                                        include ('single_bank_invoice.php');
                                                    }
                                                ?>
                                                
                                                <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                    <button type="submit" name="bank_invoice_delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
        </div>
    </div>
</div>

<?php include('dashboard-footer.php'); ?>
