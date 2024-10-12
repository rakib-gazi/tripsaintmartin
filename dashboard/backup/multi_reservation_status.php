
<button type="button"  aria-haspopup="dialog" aria-expanded="false"  data-hs-overlay="#hs-scale-animation-modal<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
    <i class="fa-regular fa-pen-to-square text-emerald-800 "></i>
</button>

<div id="hs-scale-animation-modal<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
      <div class="flex justify-between items-center py-3 px-4 border-b ">
        <h3 id="hs-scale-animation-modal<?php echo $row['id']; ?>-label" class="font-bold text-gray-800 ">
        Update Reservaion Status
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none " aria-label="Close" data-hs-overlay="#hs-scale-animation-modal<?php echo $row['id']; ?>">
          <span class="sr-only">Close</span>
          <i class="fa-solid fa-xmark text-black text-2xl hover:text-white hover:bg-cyan-950 px-4 py-3 rounded-full"></i>
        </button>
      </div>
      <div class="px-4 pt-4 overflow-y-auto">
            <form method="post" class=" ps-4 w-full " enctype="multipart/form-data">
                <div class="">
                    <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
                    <!-- Reservation Status -->
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="status" class="text-black w-auto   ps-4  font-serif">Reservaion Status : </label>
                            <select name="status" class="py-px bg-transparent w-full ps-2 focus:outline-none">
                            <option disabled selected>Select Status</option>
                            <?php 
                                foreach ($status_names as $status_name) {
                                    $selected = '';
                                    if (isset($old['status']) && $old['status'] == $status_name) {
                                        $selected = 'selected';
                                    } elseif (isset($row['status']) && $row['status'] == $status_name) {
                                        $selected = 'selected';
                                    }
                            ?>
                                <option value="<?php echo htmlspecialchars($status_name); ?>" 
                                    <?php echo $selected; ?> class="bg-cyan-950 text-white ">
                                    <?php echo htmlspecialchars($status_name); ?>
                                </option>    
                            <?php
                                }
                            ?>
                        </select>
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['status'] ?? ''; ?></h5>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t ">
                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none " data-hs-overlay="#hs-scale-animation-modal<?php echo $row['id']; ?>">
                        Close
                        </button>
                        <button type="submit" name="multi_reservation_status" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Update Status
                        </button>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

