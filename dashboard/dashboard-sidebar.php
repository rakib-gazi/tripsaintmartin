<!-- Sidebar -->
 <?php 
    $currentMonth = date('F'); 
    $reservationItem = $currentMonth . " Reservations";
    
    $items = ['Dashboard','Categories', $reservationItem,'All Reservations','Hotel Invoice','Bank Invoice','Profile','Blog Posts'];
    $icons = ['fa-solid fa-list-ul','fa-solid fa-calendar-plus','fa-solid fa-clock','fa-solid fa-calendar-check','fa-solid fa-building-circle-arrow-right','fa-solid fa-pencil-alt','fa-regular fa-user','fa-solid fa-gear'];
    $links = ['dashboard','categories','current_reservation','all_reservation','hotelInvoice','bank_invoice','profile','blog'];
 ?>
<div class="w-1/6 bg-slate-800 h-screen p-4 text-white  pt-20 sticky top-0 font-nunito">
    <ul class="ms-4">
        <?php
            foreach ($items as $index => $item) {
                $icon = $icons[$index];
                $link = $links[$index];
        ?> 
            <li>
                <a href="<?php echo $baseurl?>dashboard/<?php echo $link; ?>.php" class="block py-2 px-4 rounded hover:bg-gray-700">
                    <i class="<?php echo $icon; ?> me-4 text-lg"></i><?php echo $item;?>
                </a>
            </li>
        <?php
            }
        ?>
        <li>
            <form  method="post" class=" ">
                <button type="submit" name="logout" class=" block py-2 px-4 rounded hover:bg-gray-700" >
                <i class="fa-solid fa-arrow-right-from-bracket me-4"></i>Sign out
                </button>
            </form>
        </li>
    </ul>
</div>
