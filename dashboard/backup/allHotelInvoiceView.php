<button type="button" class=" inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-blue-600" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-animation-modal" data-hs-overlay="#hs-scale-animation-modal<?php echo $row['id']; ?>">
    View
</button>

<div id="hs-scale-animation-modal<?php echo $row['id']; ?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-9/12 sm:w-9/12 m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
            <div class="flex justify-between items-center py-3 px-4 border-b ">
                <h3 id="hs-scale-animation-modal<?php echo $row['id']; ?>-label" class="font-bold text-gray-800 text-lg">
                    <?php echo $modaltitle;?>
                </h3>
                <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal<?php echo $row['id']; ?>">
                <span class="sr-only">Close</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
                </button>
            </div>
            <div class="pb-4 px-4 overflow-y-auto">
            <?php 
                    
                    if ($reservationData) { ?>
                        <div class="flex flex-col mt-2">
                            <div class="-m-1.5">
                                <div class="p-1.5 w-full inline-block align-middle">
                                    <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                        <table class="w-full">
                                            <thead class="bg-cyan-950">
                                                <tr>
                                                    <?php
                                                        $headersDisplayed = false;

                                                        foreach ($reservationData as $reservation) {
                                                            if (is_array($reservation) && !$headersDisplayed) {
                                                                foreach ($reservation as $key => $value) {
                                                                    echo '<th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase">' . htmlspecialchars($key) . '</th>';
                                                                }
                                                                $headersDisplayed = true;
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-cyan-950">
                                                
                                                <?php
                                                    
                                                    foreach ($reservationData as $reservation) {
                                                        
                                                        if (is_array($reservation)) {
                                                            echo '<tr class="border border-cyan-950">';
                                                            foreach ($reservation as $key => $value) {
                                                                echo '<td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">' . htmlspecialchars($value) . '</td>';
                                                            }
                                                            echo '</tr>';
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '<p>Invalid JSON data.</p>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>