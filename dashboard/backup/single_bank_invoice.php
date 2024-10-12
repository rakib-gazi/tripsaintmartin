
<button type="button" class ="" data-hs-overlay="#hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
  <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
</button>

<div id="hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all  sm:w-full m-3 sm:mx-auto h-[calc(100%-3.5rem)] min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-[70%] mx-auto max-h-full overflow-hidden flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto  dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <h3 class="font-bold text-black text-xl">
          Update Bank Invoice
        </h3>
        <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full" data-hs-overlay="#hs-vertically-centered-scrollable-modal<?php echo $row['id']; ?>">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark text-black text-2xl hover:text-white hover:bg-cyan-950 px-4 py-3 rounded-full"></i>
        </button>
      </div>
        <div class="p-4 overflow-y-auto">
            <form  method="post" class="">
                <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
                <div class="mb-4">
                    <div class="outline outline-1 ouline-black rounded flex justify-start">
                        <label for="hotel" class="text-black ps-4 font-serif w-auto ">Hotel Name: </label>
                        <input type="text" name="hotel" value="<?php echo $old['hotel'] ?? $row['hotel']?? ''; ?>" placeholder="Hotel Name " 
                        class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                    </div>
                    <h5 class="text-red-600 font-mono font-xl"><?php echo $error['hotel'] ?? ''; ?></h5>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <div class="outline outline-1 ouline-black rounded">
                            <label for="invoice" class="text-black ps-4 font-serif w-auto">Invoice No: </label>
                            <input type="text" name="invoice" value="<?php echo $old['invoice'] ?? $row['invoice']?? ''; ?>" placeholder=" Invoice Number" 
                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                        </div>
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['invoice'] ?? ''; ?></h5>
                    </div>
                    <div>
                        <div class="outline outline-1 ouline-black rounded">
                            <label for="reference" class="text-black ps-4 font-serif w-auto ">Reference No: </label>
                            <input type="text" name="reference" value="<?php echo $old['reference'] ?? $row['reference']?? ''; ?>" placeholder="Reference No " 
                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10" autocomplete="off">
                        </div>
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['reference'] ?? ''; ?></h5>
                    </div>
                    <div>
                        <div class="outline outline-1 outline-black rounded relative flex items-center">
                            <label for="date" class="text-black ps-4 font-serif w-auto">Invoice Date:</label>
                            <input id="date" type="text" name="date" value="<?php echo $old['date'] ?? $row['date']?? ''; ?>" placeholder="Invoice Date"  class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10 custom-date-input" autocomplete="off">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="date">
                                <i class="fa-solid fa-calendar-days text-blue-700 text-lg"></i>
                            </div>
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['date'] ?? ''; ?></h5>
                    </div>
                    <div>
                        <div class="outline outline-1 ouline-black rounded">
                            <label for="amount" class="text-black ps-4 font-serif w-auto">Amount Due: </label>
                            <input type="text" name="amount" value="<?php echo $old['amount'] ?? $row['amount']?? ''; ?>" placeholder="Amount Due " 
                            class="py-px bg-transparent w-auto px-4 focus:outline-none pr-10">
                        </div>
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['amount'] ?? ''; ?></h5>
                    </div>
                </div>
                <div class=" py-4 flex justify-center items-center">
                    <button type="submit" name="single_invoice_update" class="bg-cyan-950 text-white font-serif text-xl  px-8 py-2 rounded">Update Invoice</button>
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
            advanceCurrencySelect.selectedIndex = 0; 
        }
    });
</script>