
<button type="button"  aria-haspopup="dialog" aria-expanded="false"  data-hs-overlay="#reservation_info<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
    <i class="fa-solid  fa-circle-info text-medium text-blue-600 "></i>
</button>

<div id="reservation_info<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
      <div class="flex justify-between items-center py-3 px-4 border-b ">
        <h3 id="reservation_info<?php echo $row['id']; ?>-label" class="font-bold text-gray-800 ">
        More Information For This Reservaion
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none " aria-label="Close" data-hs-overlay="#reservation_info<?php echo $row['id']; ?>">
          <span class="sr-only">Close</span>
          <i class="fa-solid fa-xmark text-black text-2xl hover:text-white hover:bg-cyan-950 px-4 py-3 rounded-full"></i>
        </button>
      </div>
      <div class="overflow-y-auto">
            <form method="post" class=" ps-4 w-full " enctype="multipart/form-data">
                
                <div class="py-4 flex justify-start items-center gap-x-4 ">
                    <p  class="font-serif font-semibold">Submitted By: </p>
                    <p class="font-rflex "><?php echo $row["submitted_by"] ;?></p>
                </div>
                
            </form>
      </div>
    </div>
  </div>
</div>

