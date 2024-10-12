
<button type="button"  aria-haspopup="dialog" aria-expanded="false"  data-hs-overlay="#multi_reservation_comment<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
    <i class="fa-solid fa-comment text-cyan-600 "></i>
</button>

<div id="multi_reservation_comment<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
      <div class="flex justify-between items-center py-3 px-4 border-b ">
        <h3 id="multi_reservation_comment<?php echo $row['id']; ?>-label" class="font-bold text-gray-800 ">
        Update Reservaion Comment
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none " aria-label="Close" data-hs-overlay="#multi_reservation_comment<?php echo $row['id']; ?>">
          <span class="sr-only">Close</span>
          <i class="fa-solid fa-xmark text-black text-2xl hover:text-white hover:bg-cyan-950 px-4 py-3 rounded-full"></i>
        </button>
      </div>
      <div class="px-4 pt-4 overflow-y-auto">
            <form method="post" class=" ps-4 w-full " enctype="multipart/form-data">
                <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
                <!-- Reservation comments -->
                <div>
                    <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                        <label for="admin_comment" class="text-black w-auto ps-4  font-serif">Add comment : </label>
                        <input type="text" name="admin_comment" value="" placeholder=" Add admin comment" 
                        class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                    </div>
                </div>
                <div class="py-4 flex justify-start items-center gap-x-4 ">
                    <p  class="font-serif font-semibold">Admin Comment: </p>
                    <p class="font-rflex "><?php echo $row["admin_comment"] ;?></p>
                </div>
                <div class="col-span-3 flex justify-center items-center">
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 ">
                        <button type="button" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black" data-hs-overlay="#multi_reservation_comment<?php echo $row['id']; ?>">
                            Close
                        </button>
                        <button type="submit" name="multi_reservation_comment" class="bg-cyan-950 hover:bg-slate-800  text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5  rounded outline outline-1 outline-black">
                            Update Comment
                        </button>
                    </div>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

